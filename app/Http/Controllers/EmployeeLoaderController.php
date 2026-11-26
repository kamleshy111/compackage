<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Http\Helpers\CSVHelper;
use App\Http\Controllers\BenefitsController;
use Illuminate\{ Http\Request, Support\Facades\Validator};

/* use stdClass;
use Exception;
use Illuminate\Database\QueryException;
use App\Imports\BenefitsImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\ImportEmployeesAndBenefits;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat; */

class EmployeeLoaderController extends Controller
{
    private $fixedColumns_withkey = [
        "firstname" =>  "First Name",
        "lastname" =>  "Last Name",
        "employee_id" =>  "Employee ID",
        "supervisor" => "Supervisor",
        "address_line_1" =>  "Address Line 1",
        "address_line_2" =>  "Address Line 2",
        //"address" =>  "Address",
        "city" =>  "City",
        "state" =>  "State",
        "zip" =>  "ZIP",
        "group" =>  "Group/Department",
        "email" =>  "Email",
        "phone" =>  "Phone",
        "hourly" => "Hourly",
        "digital_delivery" => "Digital Delivery",
        "digital_delivery_value" => "Digital Delivery ID",
        "mid_year_event"        => "Descriptive Qualifier"
    ];

    public function index() {
        $benfitController = new BenefitsController();
        $compackage_benefits = $benfitController->getCompanyBenefits();
        // dd($compackage_benefits);
        $bene = [];
        $last_key = 0;

        foreach( $this->fixedColumns_withkey as $wkey => $emp_field ) {
            $bene[ $last_key ][ 'name' ] = $emp_field;
            $bene[ $last_key ][ 'id' ] = $wkey;
            $bene[ $last_key ][ 'csv_heading' ] = $emp_field;
            $bene[ $last_key ][ 'benefit_custom_name' ] = $emp_field;
            $last_key++;
        }
        
        foreach( $compackage_benefits as $key => $benefit ) {
            if($benefit->benefit_type_id == 4) {
                continue;
            }

            // echo '<pre>';print_r($benefit);echo '</pre>';

            $bene[ $last_key ][ 'name' ] = $benefit->name;
            $bene[ $last_key ][ 'id' ] = $benefit->id;
            $bene[ $last_key ][ 'csv_heading' ] = (! empty($benefit->pivot->benefit_custom_name)) ? $benefit->pivot->benefit_custom_name : $benefit->name;
            $bene[ $last_key ][ 'benefit_custom_name' ] = ! empty($benefit->pivot->benefit_custom_name) ? $benefit->pivot->benefit_custom_name : $benefit->name;
            $bene[ $last_key ][ 'category_id' ] = $benefit->pivot_category_id;
            $bene[ $last_key ][ 'employee_co_pay' ] = ! empty($benefit->pivot->employee_co_pay) ? true : false;
            $bene[ $last_key ][ 'employee_default_value' ] = 0;
            $last_key++;
        }

        $compackage_benefits = $bene;

        return view('webapp.employee-loader.employeeloader', compact('compackage_benefits'));
    }

    public function readCsv( Request $request ) {
        
        $validator = Validator::make($request->all(), [
                'csv'   =>  'required|mimes:csv,txt',
            ], [
                'csv.required'  => 'Please upload a CSV file.',
                'csv.mimes'     => 'File type should be CSV.',
            ]
        );

        if($validator->fails()) {
			$error_msg = $validator->errors()->first();
			return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => $error_msg, 
                    "key" => $validator->errors()->keys()[0]
                ]
            ]);
		}

        $file = $request->file('csv');
        // $real_path = $file->getRealPath();

        $csv = new CSVHelper($file);

        if( ! auth()->user()->defaultCompany()->canCompanyPrintReports() ) {
            $errors[] = [
                "msg"       => 'Your plan has expired.',
                "column"    => '',
                "row"       => '',
                "heading"   => '',
                "value"     => '',
            ];
            return response()->json([ "success" => false, "data" =>  ["errors" => $errors] ]);
        }

        $row_count = $csv->csvRowCount();
        $emp_count = auth()->user()->defaultCompanyEmployees('acitve')->count();
        $uncommitted_emp_count = auth()->user()->defaultCompanyEmployees('no')->count();
        
        if( ! in_array(auth()->user()->defaultCompany()->getActivePlan(), ['professional', 'unlimited'] ) ) {
            $reports_left = auth()->user()->reportCount() - $uncommitted_emp_count;
        } else {
            $reports_left = auth()->user()->reportCount();
        }
        
        $total_reports = auth()->user()->totalReportCount();
        //dd($reports_left);
        //dd(var_dump($row_count));
        if( ! auth()->user()->canCreateEmployee() ) {
            if( (int)$row_count > $reports_left ) {
                $errors[] = [
                    "msg"       => 'You can upload ' . $reports_left . ' employees. Please remove ' . ((int)$row_count - $reports_left) . ' employees and try again.',
                    "column"    => '',
                    "row"       => '',
                    "heading"   => '',
                    "value"     => '',
                ];
                return response()->json([ "success" => false, "data" =>  ["errors" => $errors] ]);
            }
            /*
            $errors[] = [
                "msg"       => 'You can upload ' . ($emp_count - (int)$row_count) . ' employees.', // Please remove ' . ((int)$row_count - $reports_left) . ' employees and try again.
                "column"    => '',
                "row"       => '',
                "heading"   => '',
                "value"     => '',
            ];
            return response()->json([ "success" => false, "data" =>  ["errors" => $errors] ]);
            */
        } else if( $reports_left < 10000 && (int)$row_count > $reports_left ) {
            
            $errors[] = [
                "msg"       => 'You can upload ' . $reports_left . ' employees. Please remove ' . ((int)$row_count - $reports_left) . ' employees and try again.',
                "column"    => '',
                "row"       => '',
                "heading"   => '',
                "value"     => '',
            ];
            return response()->json([ "success" => false, "data" =>  ["errors" => $errors] ]);
        }/*  else if( $reports_left < 10000 && ! ( $total_reports >= ($emp_count + (int)$row_count) ) ) {
            $errors[] = [
                "msg"       => 'You can upload ' . abs(($total_reports - $emp_count)) . ' employees. Please remove ' . abs(($total_reports - ($emp_count + (int)$row_count))) . ' employees.',
                "column"    => '',
                "row"       => '',
                "heading"   => '',
                "value"     => '',
            ];
            return response()->json([ "success" => false, "data" =>  ["errors" => $errors] ]);
        } else if( $reports_left < 10000 && ($emp_count + (int)$row_count) > $total_reports ) {
            $errors[] = [
                "msg"       => 'You can upload ' . abs(($total_reports - $emp_count)) . ' employees. Please remove ' . abs( (int)$row_count - ($total_reports - $emp_count)) . ' employees.',
                "column"    => '',
                "row"       => '',
                "heading"   => '',
                "value"     => '',
            ];
            return response()->json([ "success" => false, "data" =>  ["errors" => $errors] ]);
        } */

        $headings = $csv->csvHeadings();
         $headings = array_map('trim', $headings);
        $csvRows = $csv->csvSlice(1, 100000);
        foreach ($csvRows as &$object) {
            $object = (array) $object; // Convert stdClass object to array
            $trimmedArray = [];

            foreach ($object as $key => $value) {
                $trimmedKey = trim($key); // Trim whitespace from key
                $trimmedArray[$trimmedKey] = $value; // Add trimmed key and value to new array
            }

            $object = (object) $trimmedArray; // Convert array back to stdClass object
        }
        
        $stringColms = [
            'first name',
            "middle name",
            'last name',
            'employee id',
            'email',
            'phone',
            'address line 1',
            'address line 2',
            //'address',
            'supervisor',
            'digital delivery',
            'digital delivery id',
            'city',
            'state',
            'zip',
            'group/department',
            'descriptive qualifier'
        ];
         

        $errors = [];

        foreach( $csvRows as $row_number => $row ) {
            $col_number = 1;

            foreach( $row as $heading => $col ) {
                $normalized_heading = trim(strtolower($heading));

                // Skip processing if the heading is 'descriptive qualifier'
                if ($normalized_heading === 'descriptive qualifier') {
                    continue;
                }
                if( ! in_array(trim($normalized_heading), $stringColms)) {
                    $col = str_replace(['$', ','], ['', ''], $col);
                    if( is_numeric($col) ) {

                    } else if( ! empty($col) ) {
                        $errors[] = [
                            // "msg"       => getNameFromNumber( $col_number ) . ($row_number+2) . " Column: \"".$heading."\" Value: \"". $col ."\" Cell value should be a vaild Number/Doller value/Empty value",
                            "msg"       => "The value for ". getNameFromNumber( $col_number ) . ($row_number+2) . " Column(".$heading.": value: \"". $col ."\") must be a number, dollars, or empty.",
                            "column"    => getNameFromNumber( $col_number ),
                            "row"       => ($row_number+2),
                            "heading"   => $heading,
                            "value"     => $col,
                        ];
                    }
                    
                } else {
                    $col = str_replace(['$', ','], ['', ''], $col);
                    if( is_numeric($col) ) {
                        if( 
                            trim(strtolower($heading)) == 'first name' || 
                            trim(strtolower($heading)) == 'middle name' || 
                            trim(strtolower($heading)) == 'last name' || 
                            trim(strtolower($heading)) == 'email' || 
                            trim(strtolower($heading)) == 'phone' || 
                            trim(strtolower($heading)) == 'supervisor' || 
                            trim(strtolower($heading)) == 'city' || 
                            trim(strtolower($heading)) == 'state' || 
                            trim(strtolower($heading)) == 'group/department' || 
                            trim(strtolower($heading)) == 'employee id' || 
                            trim(strtolower($heading)) == 'zip' || 
                            trim(strtolower($heading)) == 'phone' || 
                            trim(strtolower($heading)) == 'address line 1' || 
                            //trim(strtolower($heading)) == 'address' || 
                            trim(strtolower($heading)) ==  'address line 2' || 
                            trim(strtolower($heading)) == 'digital delivery id' ||
                            trim(strtolower($heading)) ==  'Descriptive Qualifier'
                        ) {
                            
                        } else if( trim(strtolower($heading)) == 'digital delivery' ) {
                            $col = ! empty( $col ) ? 1 : 0;
                            if( $col == 1 && ( empty($csvRows[$row_number]->{'Email'}) || empty($csvRows[$row_number]->{'Digital Delivery ID'}) ) ) {
                                if( empty($csvRows[$row_number]->{'Email'}) ) {
                                    $errors[] = [
                                        // "msg"       => getNameFromNumber( $col_number ) . ($row_number+2) . " Column: \"".$heading."\" Digital Delivery requires Email and Digital Delivery ID.",
                                        "msg"       => getNameFromNumber( $col_number ) . ($row_number+2) . " Column: \"".$heading."\" For Digital Delivery you must have an Email.",
                                        "column"    => getNameFromNumber( $col_number ),
                                        "row"       => ($row_number+2),
                                        "heading"   => $heading,
                                        "value"     => $col,
                                    ];
                                } else if( empty($csvRows[$row_number]->{'Digital Delivery ID'}) ) {
                                    $errors[] = [
                                        // "msg"       => getNameFromNumber( $col_number ) . ($row_number+2) . " Column: \"".$heading."\" Digital Delivery requires Email and Digital Delivery ID.",
                                        "msg"       => getNameFromNumber( $col_number ) . ($row_number+2) . " Column: \"".$heading."\" For Digital Delivery you must have a Digital Delivery ID.",
                                        "column"    => getNameFromNumber( $col_number ),
                                        "row"       => ($row_number+2),
                                        "heading"   => $heading,
                                        "value"     => $col,
                                    ];
                                }
                            }
                        } else {
                            // dd(trim(strtolower($heading)) == 'digital delivery id');
                            $errors[] = [
                                // "msg"       => getNameFromNumber( $col_number ) . ($row_number+2) . " Column: \"".$heading."\" Value: \"". $col ."\" Cell value should be a vaild Number/Doller value/Empty value",
                                "msg"       => "The value for ". getNameFromNumber( $col_number ) . ($row_number+2) . " Column(".$heading.": value: \"". $col ."\") must be a number, dollars, or empty.",
                                "column"    => getNameFromNumber( $col_number ),
                                "row"       => ($row_number+2),
                                "heading"   => $heading,
                                "value"     => $col,
                            ];
                        }
                    }
                }

                $col_number++;

            }

        }

        if( ! empty( $errors ) ) {
            return response()->json([ "success" => false, "data" =>  ["errors" => $errors] ]);
        }
        // dd($csvRows);
        return send_success(["cols" => $headings, "csv_data" => $csvRows, "prev_csv" => $csvRows]);

    }

    public function commitImport(Request $request) {
        // Managing array to use while creating employees and benefits.
        try {
            
            $response = ["imported" => 0, "failed" => 0];
            // dd($request->all());
            if( ! empty($request->mapping) ) {
                $benefit_files_new = [];
                foreach( $request->csv as $csv_record ) {

                    $args = [
                        "firstname"                 => ! empty($csv_record['First Name'])? trim($csv_record['First Name']): '',
                        "lastname"                  => ! empty($csv_record['Last Name'])? trim($csv_record['Last Name']): '',
                        "email"                     => ! empty($csv_record['Email'])? trim($csv_record['Email']): '',
                        "phone"                     => ! empty($csv_record['Phone'])? trim($csv_record['Phone']): '',
                        "address_line_1"            => ! empty($csv_record['Address Line 1'])? trim($csv_record['Address Line 1']): '',
                        "address_line_2"            => ! empty($csv_record['Address Line 2'])? trim($csv_record['Address Line 2']): '',
                        "hourly_pay_functionality"  => ! empty($csv_record['Hourly'])? trim($csv_record['Hourly']): '',
                        "supervisor"                => ! empty($csv_record['Supervisor'])? trim($csv_record['Supervisor']): '',
                        "employee_id"               => ! empty($csv_record['Employee ID'])? trim($csv_record['Employee ID']): '',
                        "is_digital_delivery"       => ! empty($csv_record['Digital Delivery'])? trim($csv_record['Digital Delivery']): 0,
                        "is_middle_wages_top_box"       => ! empty($csv_record['Include Middle Wages Top Box Score'])? trim($csv_record['Include Middle Wages Top Box Score']): 0,
                        "digital_delivery_value"    => ! empty($csv_record['Digital Delivery ID'])? trim($csv_record['Digital Delivery ID']): 0,
                        "city"                      => ! empty($csv_record['City'])? trim($csv_record['City']): '',
                        "state"                     => ! empty($csv_record['State'])? trim($csv_record['State']): '',
                        "zip"                       => ! empty($csv_record['ZIP'])? str_replace('"','', $csv_record['ZIP']) : '',
                        "group"                     => ! empty($csv_record['Group/Department'])? trim($csv_record['Group/Department']): '',
                        "mid_year_event"            => ! empty($csv_record['Descriptive Qualifier'])? trim($csv_record['Descriptive Qualifier']): ''
                    ];
                                        
                    // Creating employee
                    $employee = (new Employee())->create( $args );
                    
                    // Cerating a separate array for benefits
                    foreach( $request->mapping as $mapping_key => $mapping_record ) {
                        
                        $benefit_files_new[$employee->id][$mapping_record['id']] = [
                            'value' => ! empty($csv_record[$mapping_record['csv_heading']]) ? $csv_record[$mapping_record['csv_heading']] : '',
                            'employee_default_value' => (! empty($mapping_record['employee_default_value']) && ! empty($csv_record[$mapping_record['employee_default_value']])) ? $csv_record[$mapping_record['employee_default_value']] : '',
                            'benefit_custom_name' => ! empty($mapping_record['benefit_custom_name']) ? $mapping_record['benefit_custom_name'] : '',
                            'name' => ! empty($mapping_record['name']) ? $mapping_record['name'] : '',
                            'show' => 1,
                        ];
                    }
                }

                $res = $employee->updateEmployeeBenefits( $benefit_files_new );
                if( ! empty( $res ) && ! empty($res['success']) ) {
                    $response["imported"] = $response["imported"] + count($request->csv);
                } else {
                    $response["failed"] = $response["failed"] + count($request->csv);
                    $response["failed_record"] = $csv_record;
                    $response["failed_msg"] = $res["col"];
                }
            }
            return send_success(["msg"=> count($request->csv) . " Employees created and benefits imported.", "count" => count($request->csv), "res" => $response]);
        } catch(\Exception $e) {
            dd($e);
            return send_error(["msg" => $e->getMessage()]);
        }
    }
}
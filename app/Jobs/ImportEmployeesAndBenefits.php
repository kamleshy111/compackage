<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportEmployeesAndBenefits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this->request = $data['data'];
        $this->user = $data['user'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        // Managing array to use while creating employees and benefits.
        try {
            $response = ["imported" => 0, "failed" => 0];
            
            if( ! empty($this->request->mapping) ) {
                
                $benefit_files_new = [];
                foreach( $this->request->csv as $csv_record ) {
    
                    $args = [
                        "firstname"         => ! empty($csv_record['First Name'])? $csv_record['First Name']: '',
                        "lastname"          => ! empty($csv_record['Last Name'])? $csv_record['Last Name']: '',
                        "email"             => ! empty($csv_record['Email'])? $csv_record['Email']: '',
                        "phone"             => ! empty($csv_record['Phone'])? $csv_record['Phone']: '',
                        "address_line_1"    => ! empty($csv_record['Address Line 1'])? $csv_record['Address Line 1']: '',
                        "address_line_2"    => ! empty($csv_record['Address Line 2'])? $csv_record['Address Line 2']: '',
                        "supervisor"        => ! empty($csv_record['Supervisor'])? $csv_record['Supervisor']: '',
                        "employee_id"       => ! empty($csv_record['Employee ID'])? $csv_record['Employee ID']: '',
                        "is_digital_delivery"=> ! empty($csv_record['Digital Delivery'])? $csv_record['Digital Delivery']: 0,
                        "city"              => ! empty($csv_record['City'])? $csv_record['City']: '',
                        "state"             => ! empty($csv_record['State'])? $csv_record['State']: '',
                        "zip"               => ! empty($csv_record['ZIP'])? $csv_record['ZIP']: '',
                        "group"             => ! empty($csv_record['Group/Department'])? $csv_record['Group/Department']: '',
                        "user"              => $this->user
                    ];
                    
                    // Creating employee
                    $employee = (new Employee())->create( $args );

                    // Cerating a separate array for benefits
                    foreach( $this->request->mapping as $mapping_key => $mapping_record ) {
                        if( ! empty( $employee->id ) && is_numeric($employee->id) ) {
                            $benefit_files_new[$employee->id][$mapping_record['id']] = [
                                'value' => ! empty($csv_record[$mapping_record['csv_heading']]) ? $csv_record[$mapping_record['csv_heading']] : '',
                                'benefit_custom_name' => ! empty($mapping_record['benefit_custom_name']) ? $mapping_record['benefit_custom_name'] : '',
                                'name' => ! empty($mapping_record['name']) ? $mapping_record['name'] : '',
                                'show' => 1,
                            ];
                        }
                    }
                }
                
                $res = $employee->updateEmployeeBenefits( $benefit_files_new, $this->user );
                
                if( ! empty( $res ) && ! empty($res['success']) ) {
                    $response["imported"] = $response["imported"] + 1;
                } else {
                    $response["failed"] = $response["failed"] + 1;
                    $response["failed_record"] = $csv_record;
                    $response["failed_msg"] = $res["col"];
                }
                
            }
            $user = User::find($this->user->id);
            update_option('company_job_' . $user->currentSessionCompany(), '123');
            
            // return send_success(["msg"=> count($this->request->csv) . " Employees created and benefits imported.", "count" => count($this->request->csv), "res" => $response]);
        } catch(\Exception $e) {
            // return send_error(["msg" => $e->getMessage()]);
        }
    }
}

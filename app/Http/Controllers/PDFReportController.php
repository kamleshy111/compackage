<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Company;
use App\Models\Employee;
// use Illuminate\Http\Request;
use App\Models\CustomCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PDFReportController extends Controller
{
    public $test;
    public function generate_report( $employee_id, $type = 'show', $test = 'no', $exclude_emp = false )
    {
        $this->test = $test;
        $employee = Employee::find($employee_id);
        if( ! empty( $employee ) ) {
            $company = $employee->company()->first();
            if( ! empty( $company ) ) {
                $this->_individual_pdf_report( $company, $employee, $type, $exclude_emp);
            }
        }
        return false;
    }

    private function _individual_pdf_report( Company $company, Employee $employee, String $type, String $exclude_emp) {
        if( $company->canCompanyPrintReports() ) {

            $categories = CustomCategory::get();
            $category_data = [];
            $category_pdf_body_heading_override = [];
            
            foreach( $categories as $category ) {
                $category_data[$category->id] = $category->name;
            }
            /*
            foreach( $categories as $category ) 
            {
                $category_pdf_body_heading_override[$category->id] = !empty($company->{$category->key}) ? $company->{$category->key} : $category->name;
            }
            */
            /** New category label added SM */
            if(!empty($employee->hourly_pay_functionality) && $employee->hourly_pay_functionality == 1)
            {
                foreach( $categories as $category ) 
                {
                    if(!empty($category) && $category->diff_pay == 'hourly_pay' && !empty($category->categorie_id))
                    {
                        $category_pdf_body_heading_override[$category->categorie_id] = !empty($company->{$category->key}) ? $company->{$category->key} : $category->name;
                    }
                }
            }
            else 
            {
                foreach( $categories as $category ) 
                {
                    if(!empty($category) && $category->diff_pay == 'base_pay')
                    {
                        $category_pdf_body_heading_override[$category->id] = !empty($company->{$category->key}) ? $company->{$category->key} : $category->name;
                    }
                }
            }
            
            if( empty( $employee ) && empty( $company ) ) {
                return;
            }

            $employee_benefit_count = DB::table('benefit_employee')->where('employee_id', $employee->id)->count();
            $categories = CustomCategory::all()->toArray();
            
            // Loop through all the benefits under a benefit type.
            $benefits_controller = new BenefitsController();
            $benefits = $benefits_controller->getCompanyBenefits($company->id);

            $your_base_pay = 0;
            $other_cash_benefits = 0;
            $other_income_total = 0;
            $right_side_employer = 0;
            $right_side_employee = 0;
            $benefitsByCategory = [];
            $employee_benefits_total = 0;
            $employer_benefits_total = 0;

            # Hourly functionality
            $_bt_10 = [];
            $_ocb_rate_10 = 0;
            $_rate_total_10 = 0;
            $all_hours_worked = 0;
            $benefit_type_10_benefits = [];
            # Hourly functionality
            // dd($benefits);
            foreach( $benefits as $order_sequence => $benefit1 ) {
                if( $employee->hourly_pay_functionality ) {
                    ( in_array($benefit1->id, [2,3,17,18]) && ! empty($benefit1->pivot) && ! empty($benefit1->pivot->category_id) && $benefit1->pivot->category_id == 1) ? $benefit1->pivot->category_id = 2 : $benefit1->pivot->category_id;
                }
                $benefit = Benefit::find($benefit1->id);
                $userRelationWithBenefits = '';
    
                // Get pivot data(relation data)
                if( ! empty( $employee_benefit_count ) && $employee_benefit_count > 0 ) {
                    $userRelationWithBenefits = $benefit->employees($employee->id)->withPivot([ 'benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'order_sequence'])->first();//where('benefit_employee.show', 1)->
                } else {
                    $userRelationWithBenefits = $benefit->companies($company->id)->withPivot([ 'benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'order_sequence'])->where('company_benefit.show', 1)->first();
                }
                if( ! empty( $userRelationWithBenefits ) && ! empty( $userRelationWithBenefits->pivot ) ) {
                    $userRelationWithBenefits = $userRelationWithBenefits->pivot;
                }
                
                
                // If found data then, assign to the object.
                if( ! empty($userRelationWithBenefits) ) {
                    $temp = [];
                    $temp['id'] = $benefit->id;
                    $temp['name'] = $benefit->name;
                    $temp['show'] = ! empty($userRelationWithBenefits->show) ? true : false;
                    if( ! empty( $benefit1->pivot ) ) {
                        $temp['additional_benefit_name'] = ! empty( $benefit1->pivot->benefit_custom_name ) ? $benefit1->pivot->benefit_custom_name : '';
                    } else {
                        $temp['additional_benefit_name'] = ! empty( $userRelationWithBenefits->benefit_custom_name ) ? $userRelationWithBenefits->benefit_custom_name : '';
                    }
                    $temp['employer_default_value']  = ! empty( $userRelationWithBenefits->employer_default_value ) ? $userRelationWithBenefits->employer_default_value : 0;
                    if( $exclude_emp == 1 ){
                        $temp['employee_default_value']  = 0;
                    }
                    else{
                        $temp['employee_default_value']  = ! empty( $userRelationWithBenefits->employee_default_value && $benefit1->pivot->employee_co_pay ) ? $userRelationWithBenefits->employee_default_value : 0;
                    }
                    
                    $temp["addedby"]                 = $benefit['addedby'];
                    $temp["benefit_type_id"]         = $benefit['benefit_type_id'];
    
                    if( ! empty( $benefit1->pivot ) && ! empty( $benefit1->pivot->category_id ) ) {
                        $temp['categories'] = $categories;
                        
                        if( ! empty( $benefit1->pivot ) ) {
                            $temp['category_id'] = $benefit1->pivot->category_id;
                        } else if( $userRelationWithBenefits->category_id ) {
                            $temp['category_id'] = $userRelationWithBenefits->category_id;
                        }

                        $temp['can_categorize'] = $userRelationWithBenefits->can_categorize;
                    
                        if( ! empty( $benefit1->pivot ) ) {
                            $temp["bold"]                    = ! empty( $benefit1->pivot->bold ) ? true : false;
                            $temp["italic"]                  = ! empty( $benefit1->pivot->italic ) ? true : false;
                            $temp["add_dollar"]              = ! empty( $benefit1->pivot->add_dollar ) ? true : false;
                            $temp["decimal_cents"]           = ! empty( $benefit1->pivot->decimal_cents ) ? true : false;
                            $temp['order_sequence']          = ! empty( $benefit1->pivot->order_sequence ) ? $benefit1->pivot->order_sequence : $order_sequence;
                            
                            // If benefit type is Custom benefits or Other Benefits Information with values then add 100 to order sequence so, they can show at the end in the other benefits type.
                            if( in_array($temp["benefit_type_id"], [7,5]) ) {
                                $temp['order_sequence'] += 100;
                            }

                            if( in_array($temp["benefit_type_id"], [10]) ) {
                                $temp['order_sequence'] -= 100;
                            }

                            if( 
                                ( $employee->hourly_pay_functionality && in_array($benefit1->id, [1,2,3]) ) || // ,2,3
                                ( $employee->hourly_pay_functionality && ( ! empty($benefit1->hourly_rate) || ! empty($benefit1->hourly_hours) ) ) ||
                                ( ! $employee->hourly_pay_functionality && ( ! empty($benefit1->hourly_rate) || ! empty($benefit1->hourly_hours) || ! empty($benefit1->hourly_amount) ) ) 
                            ) {} else {
                                $benefitsByCategory[$benefit1->pivot->category_id][] = $temp;
                            }
                        } else {
                            $temp["bold"]                    = ! empty( $benefit1->bold ) ? true : false;
                            $temp["italic"]                  = ! empty( $benefit1->italic ) ? true : false;
                            $temp["add_dollar"]              = ! empty( $benefit1->add_dollar ) ? true : false;
                            $temp["decimal_cents"]           = ! empty( $benefit1->pivot->decimal_cents ) ? true : false;
                            $temp['order_sequence']          = ! empty( $benefit1->order_sequence ) ? $benefit1->order_sequence : $order_sequence;
                            
                            // If benefit type is Custom benefits or Other Benefits Information with values then add 100 to order sequence so, they can show at the end in the other benefits type.
                            if( in_array($temp["benefit_type_id"], [7,5]) ) {
                                $temp['order_sequence'] += 100;
                            }

                            if( in_array($temp["benefit_type_id"], [10]) ) {
                                $temp['order_sequence'] -= 100;
                            }

                            if( 
                                ( $employee->hourly_pay_functionality && in_array($benefit1->id, [1,2,3]) ) || // ,2,3
                                ( $employee->hourly_pay_functionality && ( ! empty($benefit1->hourly_rate) || ! empty($benefit1->hourly_hours) ) ) ||
                                ( ! $employee->hourly_pay_functionality && ( ! empty($benefit1->hourly_rate) || ! empty($benefit1->hourly_hours) || ! empty($benefit1->hourly_amount) ) ) 
                            ) {} else {
                                $benefitsByCategory[$benefit->category_id][] = $temp;
                            }
                        }
                        
                        // If benefit ID is 7 then, do not include in the total
                        if( $benefit1->benefit_type_id != 7 ) {

                            if( ($benefit1->benefit_type_id == 10 && ! $employee->hourly_pay_functionality) || ($benefit1->benefit_type_id == 1 && $employee->hourly_pay_functionality && $benefit1->id != 6 ) ){
                            //if( $benefit1->benefit_type_id == 10 && ! $employee->hourly_pay_functionality ) { //&& empty($benefit->hourly_amount) ) {

                            } else if( $employee->hourly_pay_functionality && ! $benefit1->hourly_hours && ! $benefit1->hourly_rate && $benefit1->id != 1 ) {
                                if( $benefit1->hourly_amount && $benefit1->hourly_hours && $benefit1->hourly_rate ) {
                                    
                                    if( $benefit1->pivot->category_id == 1 ) {
                                        $your_base_pay += $temp['employer_default_value'];
                                    } else {
                                        $other_cash_benefits += $temp['employer_default_value'];
                                    }
                                }
                                
                                $employee_benefits_total += $temp['employee_default_value'];
                                //$employer_benefits_total += $temp['employer_default_value'];
                                
                                if( $benefit1->pivot->category_id == 1 ) {
                                    $your_base_pay += $temp['employer_default_value'];
                                    $employer_benefits_total += $temp['employer_default_value'];
                                } else {
                                    $other_cash_benefits += $temp['employer_default_value'];
                                }

                                if( $benefit1->pivot->category_id == 2 ) {
                                    $other_income_total += $temp['employer_default_value'];
                                    
                                    //$employer_benefits_total += $temp['employer_default_value'];
                                }
        
                                if( ! in_array( $benefit1->pivot->category_id, [1,2,8] ) ) {
                                    $right_side_employer += $temp['employer_default_value'];
                                    $right_side_employee += $temp['employee_default_value'];
                                    $employer_benefits_total += $temp['employer_default_value'];
                                }
                            } else if( ! $employee->hourly_pay_functionality ) {
                                $employee_benefits_total += $temp['employee_default_value'];
                                // $employer_benefits_total += $temp['employer_default_value'];
                                
                                if( $benefit1->pivot->category_id == 1 ) {
                                    $your_base_pay += $temp['employer_default_value'];
                                    $employer_benefits_total += $temp['employer_default_value'];
                                } else {
                                    $other_cash_benefits += $temp['employer_default_value'];
                                }
    
                                if( $benefit1->pivot->category_id == 2 ) {
                                    $other_income_total += $temp['employer_default_value'];
                                    //$employer_benefits_total += $temp['employer_default_value'];
                                }
            
                                if( ! in_array( $benefit1->pivot->category_id, [1,2,8] ) ) {
                                    $right_side_employer += $temp['employer_default_value'];
                                    $right_side_employee += $temp['employee_default_value'];
                                    $employer_benefits_total += $temp['employer_default_value'];
                                }
                            }
                        }
                        
                        if( $benefit1->benefit_type_id == 10 ) {
                            $benefit_type_10_benefits[] = $temp;
                        }
                        
                    }
                }
                
                # Hourly functionality
                /**
                 * Getting benefit type 10 all benefits in a separate array so, we could use it further.
                 */
                if( ! empty($benefit->hourly_rate) || ! empty($benefit->hourly_hours) || ! empty($benefit->hourly_amount) ) {
                    $_bt_10[$benefit->id] = $temp;
                }

                /**
                 * Total package Rate total
                 */
                if( ! empty($benefit->hourly_rate) ) {
                    $_rate_total_10 += $temp['employer_default_value'];
                }

                /**
                 * Other cash Benefits Rate
                 */
                if( $benefit->id == 145 ) {
                    $_ocb_rate_10 += $temp['employer_default_value'];
                }

                /**
                 * All hours worked
                 */
                if( ! empty($benefit->hourly_hours) ) {
                    $all_hours_worked += $temp['employer_default_value'];
                }
                
                # Hourly functionality
            }
            
            //dd($employer_benefits_total);
            
            $category_total = [];
            foreach( $benefitsByCategory as $category_id => $bcs ) {
                $category_total[$category_id] = 0;
                foreach( $bcs as $bc) {
                    if($bc['benefit_type_id']  != 7 ) {
                        $category_total[$category_id] += $bc['employer_default_value'];
                    }
                }
            }
            if( isset($category_total[2] ) ){
                $employer_benefits_total += $category_total[2];
            }
            //dd($category_total);
            $data['category_total'] = $category_total;
            $data['employee_benefits_total']    = $employee_benefits_total;
            $data['employer_benefits_total']    = $employer_benefits_total;
            $data['company']                    = $company;
            $data['employee']                    = $employee;
            $data['category']                   = $category_data;
            $data['category_pdf_body_heading_override'] = $category_pdf_body_heading_override;
            if( ($right_side_employee + $right_side_employer) > 0 ) {
                $data['cpb_percent']                = number_format((($right_side_employer * 100) / ($right_side_employee + $right_side_employer)), 2);
            } else {
                $data['cpb_percent']                = 0;
            }
    
            if( ($right_side_employee + $right_side_employer) > 0 ) {
                if( $your_base_pay > 0 ) {
                    $col = [];
                    foreach( $benefitsByCategory as $key => $bene ) {
                        if( $key == 1 ) {
                            continue;
                        }

                        $col = array_merge( $col, array_column($bene,'employer_default_value')) + array_merge( $col, array_column($bene,'employee_default_value'));
                    }

                    $tcp = ((round($other_cash_benefits) * 100) / round($your_base_pay));
                } else {
                    $tcp = 100;
                }
                $data['tcp_percent']                = $tcp;
            } else {
                $data['tcp_percent']                = 0;
            }
            
            
            $data['other_cash_benefits']        = $other_cash_benefits;
            //$data['other_income_total']         = $other_income_total;
            $data['other_income_total']         = isset($category_total[2]) ? $category_total[2]:0;
            $data['your_base_pay']              = $your_base_pay;
            $data['right_left_total']           = ( ($right_side_employee + $right_side_employer) > 0 ) ? $right_side_employee + $right_side_employer : 1;
            $data['company']->logo              = $company->getAttachment();
            $data['benefits_by_category']       = $benefitsByCategory;
            $data['right_side_employer']        = $right_side_employer;
            $data['right_side_employee']        = $right_side_employee;
            
            $category_name = [];
            foreach( $categories as $category ) {
                $category_name[$category['id']] = $category['name'];
            }
            $data['category_name']        = $category_pdf_body_heading_override; //$category_name;

            # Hourly functionality
            $data['_bt_10'] = $_bt_10;
            $data['_rate_total_10'] = $_rate_total_10;
            $data['all_hours_worked'] = $all_hours_worked;

            if( ! empty( $all_hours_worked ) ) {
                $data['_cpb_rate_10'] = ($right_side_employer/$all_hours_worked);
                // Commented the below line as per bill instructions and added new formula
                // $data['_ocb_rate_10'] = (($data['other_income_total']+$data['your_base_pay'])/$all_hours_worked);
                $data['_ocb_rate_10'] = (($data['other_income_total'])/$all_hours_worked);
            } else {
                $data['_cpb_rate_10'] = 0;
                $data['_ocb_rate_10'] = 0;
            }
            
            $data['tt_package'] = ((! empty($data['_ocb_rate_10']) ? $data['_ocb_rate_10'] : 1) + (! empty($_bt_10) && array_key_exists(141, $_bt_10) && isset( $_bt_10[141]['employer_default_value'] ) ? $_bt_10[141]['employer_default_value'] : 0));

            $data['_bt_10_141_rate'] = ! empty( $_bt_10[141] ) && $_bt_10[141]['employer_default_value'] ? $_bt_10[141]['employer_default_value'] : 0;
            $data['_bt_10_142_hours'] = ! empty( $_bt_10[142] ) && $_bt_10[142]['employer_default_value'] ? number_format($_bt_10[142]['employer_default_value'], 0) : 0;
            $data['_bt_10_143_total'] = ! empty( $_bt_10[143] ) && $_bt_10[143]['employer_default_value'] ? $_bt_10[143]['employer_default_value'] : 0;
            # Hourly functionality
            
            $data['_exclude_emp'] = $exclude_emp;
            
            if( ! empty($_GET['test']) ) {
                dd($data);
            }
            if( ! empty( $this->test == 'yes' ) ) {
                $pdf = PDF::loadView('reports.alex', $data);    
            } else {
                $pdf = PDF::loadView('reports.pdf', $data);
            }
            
            $customPaper = array(0,0,614,800);
            $pdf->set_paper($customPaper);

            // Put watermark on the PDF.
            if( ! $employee->final_commited && $company->getActivePlan() != 'unlimited' && $company->getActivePlan() != 'professional' ) {
                $pdf->output();
                $canvas = $pdf->getDomPDF()->getCanvas();
                $height = $canvas->get_height();
                $width = $canvas->get_width();
                $canvas->set_opacity(.5,"Multiply");
                $canvas->page_text($width/5, $height/1.7, 'DRAFT: FOR REVIEW ONLY', null, 30, array(0,0,0),2,2,-30);
            }
            
            header("Content-type:application/pdf");
            if( $type == 'download' ) {
                header("Content-Disposition:attachment;filename=".$employee->firstname . '-' .$employee->lastname.".pdf");
            }

            echo $pdf->stream();

        } else {
            abort(403, 'The subscription has been expired. Please contact to your employer to renew the plan.');
        }
    }

    /** Combined PDF */
    public function _individual_pdf_report_combined_pdf( Company $company, Employee $employee, String $type, String $exclude_emp) {
        if( $company->canCompanyPrintReports() ) {
            $categories = CustomCategory::get();
            $category_data = [];
            $category_pdf_body_heading_override = [];
            
            foreach( $categories as $category ) {
                $category_data[$category->id] = $category->name;
            }

            /*
            foreach( $categories as $category ) 
            {
                $category_pdf_body_heading_override[$category->id] = !empty($company->{$category->key}) ? $company->{$category->key} : $category->name;
            }
            */
            /** New category label added SM */
            if(!empty($employee->hourly_pay_functionality) && $employee->hourly_pay_functionality == 1)
            {
                foreach( $categories as $category ) 
                {
                    if(!empty($category) && $category->diff_pay == 'hourly_pay' && !empty($category->categorie_id))
                    {
                        $category_pdf_body_heading_override[$category->categorie_id] = !empty($company->{$category->key}) ? $company->{$category->key} : $category->name;
                    }
                }
            }
            else 
            {
                foreach( $categories as $category ) 
                {
                    if(!empty($category) && $category->diff_pay == 'base_pay')
                    {
                        $category_pdf_body_heading_override[$category->id] = !empty($company->{$category->key}) ? $company->{$category->key} : $category->name;
                    }
                }
            }
            
            if( empty( $employee ) && empty( $company ) ) {
                return;
            }

            $employee_benefit_count = DB::table('benefit_employee')->where('employee_id', $employee->id)->count();
            $categories = CustomCategory::all()->toArray();
            
            // Loop through all the benefits under a benefit type.
            $benefits_controller = new BenefitsController();
            $benefits = $benefits_controller->getCompanyBenefits($company->id);

            $your_base_pay = 0;
            $other_cash_benefits = 0;
            $other_income_total = 0;
            $right_side_employer = 0;
            $right_side_employee = 0;
            $benefitsByCategory = [];
            $employee_benefits_total = 0;
            $employer_benefits_total = 0;

            # Hourly functionality
            $_bt_10 = [];
            $_ocb_rate_10 = 0;
            $_rate_total_10 = 0;
            $all_hours_worked = 0;
            $benefit_type_10_benefits = [];
            # Hourly functionality
            // dd($benefits);
            foreach( $benefits as $order_sequence => $benefit1 ) {
                if( $employee->hourly_pay_functionality ) {
                    ( in_array($benefit1->id, [2,3,17,18]) && ! empty($benefit1->pivot) && ! empty($benefit1->pivot->category_id) && $benefit1->pivot->category_id == 1) ? $benefit1->pivot->category_id = 2 : $benefit1->pivot->category_id;
                }
                $benefit = Benefit::find($benefit1->id);
                
                $userRelationWithBenefits = '';
    
                // Get pivot data(relation data)
                if( ! empty( $employee_benefit_count ) && $employee_benefit_count > 0 ) {
                    $userRelationWithBenefits = $benefit->employees($employee->id)->withPivot([ 'benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'order_sequence'])->first();//where('benefit_employee.show', 1)->
                } else {
                    $userRelationWithBenefits = $benefit->companies($company->id)->withPivot([ 'benefit_custom_name', 'employer_default_value', 'employee_default_value', 'show', 'can_categorize', 'category_id', 'order_sequence'])->where('company_benefit.show', 1)->first();
                }
                if( ! empty( $userRelationWithBenefits ) && ! empty( $userRelationWithBenefits->pivot ) ) {
                    $userRelationWithBenefits = $userRelationWithBenefits->pivot;
                }
                
                
                // If found data then, assign to the object.
                if( ! empty($userRelationWithBenefits) ) {
                    $temp = [];
                    $temp['id'] = $benefit->id;
                    $temp['name'] = $benefit->name;
                    $temp['show'] = ! empty($userRelationWithBenefits->show) ? true : false;
                    if( ! empty( $benefit1->pivot ) ) {
                        $temp['additional_benefit_name'] = ! empty( $benefit1->pivot->benefit_custom_name ) ? $benefit1->pivot->benefit_custom_name : '';
                    } else {
                        $temp['additional_benefit_name'] = ! empty( $userRelationWithBenefits->benefit_custom_name ) ? $userRelationWithBenefits->benefit_custom_name : '';
                    }
                    $temp['employer_default_value']  = ! empty( $userRelationWithBenefits->employer_default_value ) ? $userRelationWithBenefits->employer_default_value : 0;
                    if( $exclude_emp == 1 ){
                        $temp['employee_default_value']  = 0;
                    }
                    else{
                        $temp['employee_default_value']  = ! empty( $userRelationWithBenefits->employee_default_value && $benefit1->pivot->employee_co_pay ) ? $userRelationWithBenefits->employee_default_value : 0;
                    }
                    
                    $temp["addedby"]                 = $benefit['addedby'];
                    $temp["benefit_type_id"]         = $benefit['benefit_type_id'];
    
                    if( ! empty( $benefit1->pivot ) && ! empty( $benefit1->pivot->category_id ) ) {
                        $temp['categories'] = $categories;
                        
                        if( ! empty( $benefit1->pivot ) ) {
                            $temp['category_id'] = $benefit1->pivot->category_id;
                        } else if( $userRelationWithBenefits->category_id ) {
                            $temp['category_id'] = $userRelationWithBenefits->category_id;
                        }

                        $temp['can_categorize'] = $userRelationWithBenefits->can_categorize;
                    
                        if( ! empty( $benefit1->pivot ) ) {
                            $temp["bold"]                    = ! empty( $benefit1->pivot->bold ) ? true : false;
                            $temp["italic"]                  = ! empty( $benefit1->pivot->italic ) ? true : false;
                            $temp["add_dollar"]              = ! empty( $benefit1->pivot->add_dollar ) ? true : false;
                            $temp["decimal_cents"]           = ! empty( $benefit1->pivot->decimal_cents ) ? true : false;
                            $temp['order_sequence']          = ! empty( $benefit1->pivot->order_sequence ) ? $benefit1->pivot->order_sequence : $order_sequence;
                            
                            // If benefit type is Custom benefits or Other Benefits Information with values then add 100 to order sequence so, they can show at the end in the other benefits type.
                            if( in_array($temp["benefit_type_id"], [7,5]) ) {
                                $temp['order_sequence'] += 100;
                            }

                            if( in_array($temp["benefit_type_id"], [10]) ) {
                                $temp['order_sequence'] -= 100;
                            }

                            if( 
                                ( $employee->hourly_pay_functionality && in_array($benefit1->id, [1,2,3]) ) || // ,2,3
                                ( $employee->hourly_pay_functionality && ( ! empty($benefit1->hourly_rate) || ! empty($benefit1->hourly_hours) ) ) ||
                                ( ! $employee->hourly_pay_functionality && ( ! empty($benefit1->hourly_rate) || ! empty($benefit1->hourly_hours) || ! empty($benefit1->hourly_amount) ) ) 
                            ) {} else {
                                $benefitsByCategory[$benefit1->pivot->category_id][] = $temp;
                            }
                        } else {
                            $temp["bold"]                    = ! empty( $benefit1->bold ) ? true : false;
                            $temp["italic"]                  = ! empty( $benefit1->italic ) ? true : false;
                            $temp["add_dollar"]              = ! empty( $benefit1->add_dollar ) ? true : false;
                            $temp["decimal_cents"]           = ! empty( $benefit1->pivot->decimal_cents ) ? true : false;
                            $temp['order_sequence']          = ! empty( $benefit1->order_sequence ) ? $benefit1->order_sequence : $order_sequence;
                            
                            // If benefit type is Custom benefits or Other Benefits Information with values then add 100 to order sequence so, they can show at the end in the other benefits type.
                            if( in_array($temp["benefit_type_id"], [7,5]) ) {
                                $temp['order_sequence'] += 100;
                            }

                            if( in_array($temp["benefit_type_id"], [10]) ) {
                                $temp['order_sequence'] -= 100;
                            }

                            if( 
                                ( $employee->hourly_pay_functionality && in_array($benefit1->id, [1,2,3]) ) || // ,2,3
                                ( $employee->hourly_pay_functionality && ( ! empty($benefit1->hourly_rate) || ! empty($benefit1->hourly_hours) ) ) ||
                                ( ! $employee->hourly_pay_functionality && ( ! empty($benefit1->hourly_rate) || ! empty($benefit1->hourly_hours) || ! empty($benefit1->hourly_amount) ) ) 
                            ) {} else {
                                $benefitsByCategory[$benefit->category_id][] = $temp;
                            }
                        }

                        // If benefit ID is 7 then, do not include in the total
                        if( $benefit1->benefit_type_id != 7 ) {
                            if( $benefit1->benefit_type_id == 10 && ! $employee->hourly_pay_functionality ) { //&& empty($benefit->hourly_amount) ) {

                            } else if( $employee->hourly_pay_functionality && ! $benefit1->hourly_hours && ! $benefit1->hourly_rate && $benefit1->id != 1 ) {
                                if( $benefit1->hourly_amount && $benefit1->hourly_hours && $benefit1->hourly_rate ) {
                                    
                                    if( $benefit1->pivot->category_id == 1 ) {
                                        $your_base_pay += $temp['employer_default_value'];
                                    } else {
                                        $other_cash_benefits += $temp['employer_default_value'];
                                    }
                                }
                                
                                $employee_benefits_total += $temp['employee_default_value'];
                                //$employer_benefits_total += $temp['employer_default_value'];

                                if( $benefit1->pivot->category_id == 1 ) {
                                    $your_base_pay += $temp['employer_default_value'];
                                    $employer_benefits_total += $temp['employer_default_value'];
                                } else {
                                    $other_cash_benefits += $temp['employer_default_value'];
                                }

                                if( $benefit1->pivot->category_id == 2 ) {
                                    $other_income_total += $temp['employer_default_value'];
                                }
        
                                if( ! in_array( $benefit1->pivot->category_id, [1,2,8] ) ) {
                                    $right_side_employer += $temp['employer_default_value'];
                                    $right_side_employee += $temp['employee_default_value'];
                                    $employer_benefits_total += $temp['employer_default_value'];
                                }
                            } else if( ! $employee->hourly_pay_functionality ) {
                                $employee_benefits_total += $temp['employee_default_value'];
                                //$employer_benefits_total += $temp['employer_default_value'];
                                
                                if( $benefit1->pivot->category_id == 1 ) {
                                    $your_base_pay += $temp['employer_default_value'];
                                    $employer_benefits_total += $temp['employer_default_value'];
                                } else {
                                    $other_cash_benefits += $temp['employer_default_value'];
                                }
    
                                if( $benefit1->pivot->category_id == 2 ) {
                                    $other_income_total += $temp['employer_default_value'];
                                }
            
                                if( ! in_array( $benefit1->pivot->category_id, [1,2,8] ) ) {
                                    $right_side_employer += $temp['employer_default_value'];
                                    $right_side_employee += $temp['employee_default_value'];
                                    $employer_benefits_total += $temp['employer_default_value'];
                                }
                            }
                        }

                        if( $benefit1->benefit_type_id == 10 ) {
                            $benefit_type_10_benefits[] = $temp;
                        }
                    }
                }

                # Hourly functionality
                /**
                 * Getting benefit type 10 all benefits in a separate array so, we could use it further.
                 */
                if( ! empty($benefit->hourly_rate) || ! empty($benefit->hourly_hours) || ! empty($benefit->hourly_amount) ) {
                    $_bt_10[$benefit->id] = $temp;
                }

                /**
                 * Total package Rate total
                 */
                if( ! empty($benefit->hourly_rate) ) {
                    $_rate_total_10 += $temp['employer_default_value'];
                }

                /**
                 * Other cash Benefits Rate
                 */
                if( $benefit->id == 145 ) {
                    $_ocb_rate_10 += $temp['employer_default_value'];
                }

                /**
                 * All hours worked
                 */
                if( ! empty($benefit->hourly_hours) ) {
                    $all_hours_worked += $temp['employer_default_value'];
                }
                # Hourly functionality
            }
            // dd($benefitsByCategory);
            $category_total = [];
            foreach( $benefitsByCategory as $category_id => $bcs ) {
                $category_total[$category_id] = 0;
                foreach( $bcs as $bc) {
                    if($bc['benefit_type_id']  != 7 ) {
                        $category_total[$category_id] += $bc['employer_default_value'];
                    }
                }
            }
            if( isset($category_total[2] ) ){
                $employer_benefits_total += $category_total[2];
            }
            $data['category_total'] = $category_total;
            $data['employee_benefits_total']    = $employee_benefits_total;
            $data['employer_benefits_total']    = $employer_benefits_total;
            $data['company']                    = $company;
            $data['employee']                    = $employee;
            $data['category']                   = $category_data;
            $data['category_pdf_body_heading_override'] = $category_pdf_body_heading_override;
            if( ($right_side_employee + $right_side_employer) > 0 ) {
                $data['cpb_percent']                = number_format((($right_side_employer * 100) / ($right_side_employee + $right_side_employer)), 2);
            } else {
                $data['cpb_percent']                = 0;
            }
    
            if( ($right_side_employee + $right_side_employer) > 0 ) {
                if( $your_base_pay > 0 ) {
                    $col = [];
                    foreach( $benefitsByCategory as $key => $bene ) {
                        if( $key == 1 ) {
                            continue;
                        }

                        $col = array_merge( $col, array_column($bene,'employer_default_value')) + array_merge( $col, array_column($bene,'employee_default_value'));
                    }

                    $tcp = ((round($other_cash_benefits) * 100) / round($your_base_pay));
                } else {
                    $tcp = 100;
                }
                $data['tcp_percent']                = $tcp;
            } else {
                $data['tcp_percent']                = 0;
            }
            
            $data['other_cash_benefits']        = $other_cash_benefits;
            $data['other_income_total']         = isset($category_total[2]) ? $category_total[2] : 0;
            $data['your_base_pay']              = $your_base_pay;
            $data['right_left_total']           = ( ($right_side_employee + $right_side_employer) > 0 ) ? $right_side_employee + $right_side_employer : 1;
            $data['company']->logo              = $company->getAttachment();
            $data['benefits_by_category']       = $benefitsByCategory;
            $data['right_side_employer']        = $right_side_employer;
            $data['right_side_employee']        = $right_side_employee;
            
            $category_name = [];
            foreach( $categories as $category ) {
                $category_name[$category['id']] = $category['name'];
            }
            $data['category_name']        = $category_pdf_body_heading_override; //$category_name;

            # Hourly functionality
            $data['_bt_10'] = $_bt_10;
            $data['_rate_total_10'] = $_rate_total_10;
            $data['all_hours_worked'] = $all_hours_worked;

            if( ! empty( $all_hours_worked ) ) {
                $data['_cpb_rate_10'] = ($right_side_employer/$all_hours_worked);
                // Commented the below line as per bill instructions and added new formula
                // $data['_ocb_rate_10'] = (($data['other_income_total']+$data['your_base_pay'])/$all_hours_worked);
                $data['_ocb_rate_10'] = (($data['other_income_total'])/$all_hours_worked);
            } else {
                $data['_cpb_rate_10'] = 0;
                $data['_ocb_rate_10'] = 0;
            }
            
            $data['tt_package'] = ((! empty($data['_ocb_rate_10']) ? $data['_ocb_rate_10'] : 1) + (! empty($_bt_10) && array_key_exists(141, $_bt_10) && isset( $_bt_10[141]['employer_default_value'] ) ? $_bt_10[141]['employer_default_value'] : 0));

            $data['_bt_10_141_rate'] = ! empty( $_bt_10[141] ) && $_bt_10[141]['employer_default_value'] ? $_bt_10[141]['employer_default_value'] : 0;
            $data['_bt_10_142_hours'] = ! empty( $_bt_10[142] ) && $_bt_10[142]['employer_default_value'] ? number_format($_bt_10[142]['employer_default_value'], 0) : 0;
            $data['_bt_10_143_total'] = ! empty( $_bt_10[143] ) && $_bt_10[143]['employer_default_value'] ? $_bt_10[143]['employer_default_value'] : 0;
            $data['_exclude_emp'] = $exclude_emp;
            return $data; 
        } else {
            abort(403, 'The subscription has been expired. Please contact to your employer to renew the plan.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\AnnualRefresh;

class AnnualRefreshConttroller extends Controller
{

    public $default_company;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show_button = $this->showClearButton();
        //dd($show_button);
        return view('webapp.annual-refresh.annual-refresh', compact('show_button'));
    }

    public function clearData( Request $request ) {
        // User is logged in
        if( $user = auth()->user() ) {
            // Get default company
            $this->default_company = $user->defaultCompany();

            if( ! $this->default_company->canCompanyPrintReports() ) {
                return send_error(["msg" => "Your plan has already expired."]);
            }

            // Reports is not expired
            if( $this->default_company->canCompanyPrintReports() ) {

                // Get plan duration
                $default_company_licence_package = $user->defaultCompanyLicencePackage();
                
                if( ! empty( $default_company_licence_package ) && $default_company_licence_package > 1 ) {

                    /** Added New code start*/
                    if (!empty($this->default_company->annual_refresh_date)) {
                        $annual_refresh_date = new DateTime($this->default_company->annual_refresh_date);
                    } else {
                        $annual_refresh_date = new DateTime();
                    }
                    $annual_refresh_date->modify('+1 year');
                    // Update the annual refresh date with the new date
                    $this->default_company->annual_refresh_date = $annual_refresh_date; 
                    // Save the updated company object
                    $this->default_company->save();
                    
                    /** Added New code End*/
                    
                    $now = new DateTime(date("Y-m-d H:i:s", time()));
                    $signup = new DateTime(date("Y-m-d H:i:s", strtotime($this->default_company->signup_date)));
                    $diff = $now->diff($signup);

                    if( $diff->y == 1 && ! $this->default_company->clear2year && $diff->y <= $default_company_licence_package) {
                        $this->clearAllData();
                        $this->default_company->clear2year = 1;
                        $this->default_company->save();
                        return send_success(["msg" => "All the employee data has been uncommited."]);
                    } else if( $diff->y == 2 && ! $this->default_company->clear3year && $diff->y <= $default_company_licence_package) {
                        $this->clearAllData();
                        $this->default_company->clear3year = 1;
                        $this->default_company->save();
                        return send_success(["msg" => "All the employee data has been uncommited."]);
                    } else if( $diff->y == 3 && ! $this->default_company->clear4year && $diff->y <= $default_company_licence_package) {
                        $this->clearAllData();
                        $this->default_company->clear4year = 1;
                        $this->default_company->save();
                        return send_success(["msg" => "All the employee data has been uncommited."]);
                    }

                    return send_error(["msg" => "No match found."]);
                }
                return send_error(["msg" => "Cannot uncommit your data due to plan duration."]);    
            }
            return send_error(["msg" => "The reports have already expired."]);
        }
        return send_error(["msg" => "Unable to fetch the user."]);
    }

    public function clearAllData() {
        $default_company_employees = $this->default_company->employees()->get();
        foreach($default_company_employees as $employee) {
            // $force_delete = 1;
            // $employee->delete($force_delete);
            $employee->uncommit();
        }
        $this->default_company->reports_left = $this->default_company->total_reports;
    }

    public function showClearButton() {

        if( $user = auth()->user() ) {
            // Get default company
            $this->default_company = $user->defaultCompany();
            if( ! $this->default_company->canCompanyPrintReports() ) {
                return false;
            }
        } else {
            return false;
        }

        $now = new DateTime(date("Y-m-d H:i:s", time()));
        $signup = new DateTime(date("Y-m-d H:i:s", strtotime($this->default_company->signup_date)));
        $diff = $now->diff($signup);

        $default_company_licence_package = $user->defaultCompanyLicencePackage();
        
        if( $diff->y == 1 && ! $this->default_company->clear2year && $diff->y <= $default_company_licence_package) {
            return true;
        } else if( $diff->y == 2 && ! $this->default_company->clear3year && $diff->y <= $default_company_licence_package) {
            return true;
        } else if( $diff->y == 3 && ! $this->default_company->clear4year && $diff->y <= $default_company_licence_package) {
            return true;
        }
        /*
        else if( $diff->y == 4 && ! $this->default_company->clear5year) {
            return true;
        }else if( $diff->y == 5 && ! $this->default_company->clear6year) {
            return true;
        }else if( $diff->y == 6 && ! $this->default_company->clear7year) {
            return true;
        }
        */
        return false;
    }
}

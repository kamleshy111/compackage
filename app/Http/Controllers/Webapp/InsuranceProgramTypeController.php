<?php

namespace App\Http\Controllers\Webapp;

use Exception;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InsuranceProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $permissions = [
            'view'      => auth()->user()->can('benefit.view'),
            'create'    => auth()->user()->can('benefit.create'),
            'update'    => auth()->user()->can('benefit.update'),
            'delete'    => auth()->user()->can('benefit.delete'),
        ];

        if($request->ajax() || $request->wantsJson() || $request->isXmlHttpRequest()) {
            $company = auth()->user()->defaultCompany();

            $health_census = '';
            $dental_census = '';
            $vision_census = '';

            if( ! empty($company->health_census) ) {
                $health_census = explode("|", $company->health_census);
                
                foreach( $health_census as $h_key => $val1 ) {
                    $health_census[$h_key] = explode(";", $val1);
                    $health_census[$h_key]['id'] = $h_key + 1;
                }

                foreach( $health_census as $h_key => $temp ) {
                    unset($health_census[$h_key][4]);
                    $this->replace_key(0, 'description', $health_census[$h_key]);
                    $this->replace_key(1, 'payrolls', $health_census[$h_key]);
                    $this->replace_key(2, 'employee_pay_per_cost', $health_census[$h_key]);
                    $this->replace_key(3, 'employer_pay_per_cost', $health_census[$h_key]);
                }
            }

            if( ! empty($company->dental_census) ) {
                $dental_census = explode("|", $company->dental_census);
                
                foreach( $dental_census as $d_key => $val1 ) {
                    $dental_census[$d_key] = explode(";", $val1);
                    $dental_census[$d_key]['id'] = $d_key + 1;
                }

                foreach( $dental_census as $d_key => $temp ) {
                    unset($dental_census[$d_key][4]);
                    $this->replace_key(0, 'description', $dental_census[$d_key]);
                    $this->replace_key(1, 'payrolls', $dental_census[$d_key]);
                    $this->replace_key(2, 'employee_pay_per_cost', $dental_census[$d_key]);
                    $this->replace_key(3, 'employer_pay_per_cost', $dental_census[$d_key]);
                }
            }

            if( ! empty($company->vision_census) ) {
                $vision_census = explode("|", $company->vision_census);
                
                foreach( $vision_census as $v_key => $val1 ) {
                    $vision_census[$v_key] = explode(";", $val1);
                    $vision_census[$v_key]['id'] = $v_key + 1;
                }

                foreach( $vision_census as $v_key => $temp ) {
                    unset($vision_census[$v_key][4]);
                    $this->replace_key(0, 'description', $vision_census[$v_key]);
                    $this->replace_key(1, 'payrolls', $vision_census[$v_key]);
                    $this->replace_key(2, 'employee_pay_per_cost', $vision_census[$v_key]);
                    $this->replace_key(3, 'employer_pay_per_cost', $vision_census[$v_key]);
                }
            }

           return send_success(["health_census" => $health_census, "dental_census" => $dental_census, "vision_census" => $vision_census]);
        } else {
            return view('webapp.benefits.insurance-program-types', compact('permissions'));
        }
    }

    public function replace_key($old_key, $new_key, &$array)
    {
        if( isset( $array[ $old_key ] ) ) {
            $array[$new_key] = $array[$old_key];
            unset($array[$old_key]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $company = auth()->user()->defaultCompany();
            
            if( ! empty( $request->health ) && isset($request->health[0]) && ! empty($request->health[0]) ) {
                $health_string = [];
                foreach( $request->health as $single ) {
                    if( is_array($single) ) {
                        unset($single['id']);
                        $health_string[] = implode(";", $single);
                    }
                }
                $company->health_census = implode("|", $health_string);
            } else if(is_array($request->health) && empty($request->health)) {
                $company->vision_census = '';
            }
    
            if( ! empty( $request->dental )  && isset($request->dental[0]) && ! empty($request->dental[0]) ) {
                $dental_string = [];
                foreach( $request->dental as $single ) {
                    if( is_array($single) ) {
                        unset($single['id']);
                        $dental_string[] = implode(";", $single);
                    }
                }
                $company->dental_census = implode("|", $dental_string);
            } else if(is_array($request->dental) && empty($request->dental)) {
                $company->dental_census = '';
            }
    
            if( ! empty( $request->vision )  && isset($request->vision[0]) && ! empty($request->vision[0]) ) {
                $vision_string = [];
                foreach( $request->vision as $single ) {
                    if( is_array($single) ) {
                        unset($single['id']);
                        $vision_string[] = implode(";", $single);
                    }
                }
                $company->vision_census = implode("|", $vision_string);
            } else if(is_array($request->vision) && empty($request->vision)) {
                $company->vision_census = '';
            }
    
            $company->save();

            if( ! empty( $request->action ) && $request->action == 'delete' ) {
                return send_success(["msg" => "Insurance successfully deleted."]);
            } else {
                return send_success(["msg" => "Insurance successfully updated."]);
            }
        } catch( Exception $ex ) {
            return send_error(["msg" => "Something went wrong!! ERROR: " . $ex->getMessage()]);
        }
    }
}

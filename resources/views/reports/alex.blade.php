<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Employee Benefit Report</title>
</head>

<body style="margin:0 10px;">

    <?php
        $col = [];
        foreach( $benefits_by_category as $key => $bene ) {
            if( $key == 1 || $key == 8  ) {
                continue;
            }
            foreach( $bene as $ben ) {
                if( $ben['benefit_type_id'] != 7 ) {
                    $col[] = $ben['employer_default_value'];
                }
            }
        }

        // Left side benefits
        $left_rows = [
            'employee' => [],
            'employer' => []
        ];

        if (!empty($benefits_by_category[1]) && array_sum(array_column($benefits_by_category[1], 'employer_default_value')) > 0) {
            $count = count($left_rows['employer']);
            $left_rows['employer'][$count]['heading'] = !empty($company->base_pay_heading) ? '<strong>'.$company->base_pay_heading.'</strong>' : "<strong>Base Pay</strong>";
            $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $left_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[1] ) ? number_format($category_total[1] ,0, '.', ',') : 0;
            $left_rows['employer'][$count]['color'] = "#cbcaca;";
            
            usort($benefits_by_category[1], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });
            
            foreach ($benefits_by_category[1] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0) {
                    
                    $count = count($left_rows['employer']);
                    
                    $left_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $left_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;
                    
                    if( $benefit['benefit_type_id'] == 7 ) {
                        $left_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');

                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $left_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $left_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }

                    $left_rows['employer'][$count]['heading'] = $heading;
                    $left_rows['employer'][$count]['employer_default_value'] = $value;
                    $left_rows['employer'][$count]['color'] = "#fff";
                }
            }
            
        }
        if (!empty($benefits_by_category[2]) && array_sum(array_column($benefits_by_category[2], 'employer_default_value')) > 0) {
            $count = count($left_rows['employer']);
            $left_rows['employer'][$count]['heading'] = !empty($company->other_cash_heading) ? '<strong>'.$company->other_cash_heading.'</strong>' : "<strong>Other Cash Benefits</strong>";
            $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $left_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[2] ) ? number_format($category_total[2] ,0, '.', ',') : 0;
            $left_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[2], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[2] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0) {
                    $count = count($left_rows['employer']);
                    
                    $left_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $left_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $left_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $left_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $left_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $left_rows['employer'][$count]['heading'] = $heading;
                    $left_rows['employer'][$count]['employer_default_value'] = $value;
                    $left_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }

        // Right side benefits
        $right_rows = [
            'employee' => [],
            'employer' => []
        ];

        if (!empty($benefits_by_category[3]) && array_sum(array_column($benefits_by_category[3], 'employer_default_value')) > 0) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>' . $category_name[3] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[3] ) ? number_format($category_total[3] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[3], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[3], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });
            
            foreach ($benefits_by_category[3] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[4]) && array_sum(array_column($benefits_by_category[4], 'employer_default_value')) > 0) {
            
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[4] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[4] ) ? number_format($category_total[4] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[4], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[4], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[4] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[5]) && array_sum(array_column($benefits_by_category[5], 'employer_default_value')) > 0) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[5] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[5] ) ? number_format($category_total[5] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[5], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[5], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[5] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0 ) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[6]) && array_sum(array_column($benefits_by_category[6], 'employer_default_value')) > 0) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[6] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[6] ) ? number_format($category_total[6] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[6], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[6], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[6] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[7]) && array_sum(array_column($benefits_by_category[7], 'employer_default_value')) > 0) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[7] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[7] ) ? number_format($category_total[7] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[7], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[7], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[7] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employer_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        $_8count = isset($benefits_by_category[8]) ? count($benefits_by_category[8]) : 0;
        $_limit_increase = 18 - ($_8count+1);
        $r_count = count($right_rows['employer'])-29;
        $r_count = ($r_count > 0) ? $r_count : 0;
        
        $chunked_array_right = array_chunk($right_rows['employer'], ((29+$r_count) > 33) ? 33 :(29+$r_count));
        $chunked_array_left = array_chunk($left_rows['employer'], (($_limit_increase > 2) ? $_limit_increase : 2 ) );
        $loop_length = (count($chunked_array_left) > count($chunked_array_right)) ? count($chunked_array_left) : count($chunked_array_right);
        // 29
    ?>

    <!-- Content Start -->
    <header style="margin-top: 28px;">
        <table style="width:100%; margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td width="45%" style="font-size:12pt;vertical-align: middle;">
                    <div style="padding-left: 20px;padding-top:0px;">
                        @if( ! empty($company->logo) )
                            <img src={{ (! empty($company->logo)? url('/'. $company->logo) : '') }} style="height: 107.5px;width: 215px;" />
                        @else
                            <div style="height: 107.5px;width: 215px;display: inline-block;"></div>
                        @endif
                        
                    </div>
                    <div style="font-family: Arial, Helvetica, sans-serif;padding-top: 60px;padding-left: 40px;font-size:11pt;">
                        <div>{{$employee->firstname}} {{$employee->lastname}}</div>
                        <div>{{$employee->address_line_1}}</div>
                        <div>{{! empty($employee->address_line_2) ? $employee->address_line_2 . ',' : ''}}</div>
                        <div>{{$employee->city}}, {{$employee->state}} {{$employee->zip}}</div>
                    </div>
                </td>
                <td width="55%" style="padding-right:30px;">
                    <div style="font-family: Arial, Helvetica, sans-serif;color:#16622e; font-size:10.5pt;line-height:1;">
                        <b>For Year Ending {{$company->month}} {{$company->day}}, {{$company->year}}</b>
                        <br />
                        <b>Your Total Compensation Report</b>
                    </div>
                    <div align="justify" style="font-family: Arial, Helvetica, sans-serif;margin-top:10px; font-size:8.5pt;">
                        {!! $company->letter !!}
                        <br>
                        {!! $company->closing !!}
                    </div>
                    <div align="justify" style="margin-top:10px; font-size:9pt;">
                        <div align="justify" style="margin-top:10px; font-size:8pt;font-family: Arial, Helvetica, sans-serif;">
                            <span style='font-size:8pt;'>{{$company->exec_name}}@if(! empty($company->exec_position)), {{$company->exec_position}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name)) )

                            @endif
                            <span style='font-size:8pt;'>{{$company->exec_name2}}@if(! empty($company->exec_position2)), {{$company->exec_position2}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name2)) )
                            

                            @endif
                            <span style='font-size:8pt;'>{{$company->exec_name3}}@if(! empty($company->exec_position3)), {{$company->exec_position3}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name3)) )
                            @endif
                            <br />
                            <span style='font-size:8pt;'><strong>Department</strong>: {{$employee->group}}</span>
                        </div>
                    </div>
                    <div align="justify" style="margin-top:10px; font-size:9pt;">
                        {{! empty($employee->mid_year_event) ? $employee->mid_year_event : ''}}<!--[MIDYEAR_TEXT]-->
                    </div>
                </td>
            </tr>
        </table>
    </header>
    <!-- Header -->

    <div style="width: 100%;height: 2px;background: #000;margin-top: 15px;margin-bottom: 15px; clear:both;"></div>
    
    <!-- Price Blocks:START -->
    <section>
        <table style="width:100%; margin-top:0px; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td width="43%" style="position:relative;">
                    <div align="center" style="color:#000000; font-size:12pt;">
                        <div style="margin-top: 15px;display: inline-block;text-align: center;padding: 0 15px;width: 100%;">
                            <div style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:140px">
                                <div style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color1}};">
                                    <span style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                        <strong>{{( ! empty($company->base_pay_heading) ? $company->base_pay_heading: 'Base Pay')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 2px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ ! empty( $your_base_pay ) ? number_format($your_base_pay ,0, '.', ',') : 0 }}
                                        <!-- ! empty( $benefits_by_category[1] ) ? number_format(array_sum(array_column($benefits_by_category[1],'employer_default_value')),0) : 0 -->
                                    </strong>
                                    </span>
                                </div>
                            </div>

                            @if( ! empty( $benefits_by_category[2] ) && array_sum(array_column($benefits_by_category[2],'employer_default_value')) > 0 )
                            <div style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;">+</div>
                            <div style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:140px">
                                <div style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color2}};">
                                    <span style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                        <strong>{{( ! empty($company->other_cash_heading) ? $company->other_cash_heading: 'Other Cash Benefits ')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 2px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <!-- <strong>{{$company->currency_symbol}}{{ ! empty($benefits_by_category[2]) ? number_format(array_sum(array_column($benefits_by_category[2],'employer_default_value')),0) : 0}}</strong> -->
                                        <strong>{{$company->currency_symbol}}{{ ! empty($other_income_total) ? number_format($other_income_total,0) : 0}}</strong>
                                    </span>
                                </div>
                            </div>
                            @endif

                            <div style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;">+</div>

                            <div style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:140px">
                                <div style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color3}};">
                                    <span style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                        <strong>{{( ! empty($company->company_paid_heading) ? $company->company_paid_heading: 'Company Paid Benefits')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 2px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ ! empty( $right_side_employer ) ? number_format($right_side_employer,0) : 0 }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;">=</div>

                            <div style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:140px">
                                <div style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color4}};">
                                    <span style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #fff;"><strong>{{( ! empty($company->total_compensation_heading) ? $company->total_compensation_heading: 'Total Compensation')}}</strong></span>
                                </div>
                                <div style="padding: 2px 10px;font-family: Arial, Helvetica, sans-serif;color: #7850a0;">
                                    <span style="font-size: 14px;">
                                        <strong>
                                            {{$company->currency_symbol}}{{ number_format( $employer_benefits_total ,0) }}
                                        </strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </section>
    <!-- Price Blocks:END -->
    
    <div style="width: 100%;height: 1px;margin-top: 15px;margin-bottom: 15px; clear:both;"></div>
    
    <!-- All Benefits with Category:START -->
    
    <main style="width: 100%;">
        <section class="cp-table-continer" style="width:49%;float: left;">
            <div style="width:100%;">
                <!-- <table cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td bgcolor="#000000" align="left" height="21">
                                <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" style="font-size:11px;">&nbsp;&nbsp;<b>Pay</b></font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="dddd">
                    <tbody>
                        <tr>
                            <td style="border-bottom: 1px solid #000;padding:2px 5px;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">Shares in Company</td>
                            <td style="border-bottom: 1px solid #000;padding:2px 5px;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"></td>
                            <td style="border-bottom: 1px solid #000;padding:2px 5px;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"></td>
                        </tr>
                    </tbody>
                </table> -->
                @if( isset($chunked_array_left[0]) )
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td bgcolor="#000000" align="left" height="21">
                                    <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" style="font-size:11px;">&nbsp;&nbsp;<b>Pay</b></font>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="dddd">
                    <tbody>
                        @if( isset($chunked_array_left[0]) )
                            @foreach( $chunked_array_left[0] as $benefits )
                                <tr style="background-color: <?php echo $benefits['color']?>;">
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!! $benefits['heading'] !!}</td>
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{{$benefits['symbol']}}</td>
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!!$benefits['employer_default_value']!!}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div style="width:100%;">
                <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr valign="top">
                            <td width="49%" style="position:relative;">
                                <!-- Total Compensation Package  -->
                                <table cellpadding="0" cellspacing="0" width="100%" style="margin-top:15px;">
                                    <tr>
                                        <td bgcolor="#000000" align="center" height="25">
                                            <font color="#FFFFFF" style="font-size: 11px;" face="Arial, Helvetica, sans-serif"><b>Total Compensation Package</b></font>
                                            <div style='font-family: Arial, Helvetica, sans-serif;font-size:10px; font-family: Arial, Helvetica, sans-serif; color:#FFFFFF'>(Your Base Pay and {{$company->company_designation}}-Paid Benefits)</div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                    <tr align="center">
                                        <td width="50%">
                                            <table border="0" cellpadding="0" cellspacing="5">
                                                <tr valign="bottom">
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td align="center">
                                                                    <div height="{{(($tcp_percent > 100) ? 0 : 100-$tcp_percent)}}px" style="margin-left: auto;margin-right: auto; width:45px; height:{{(($tcp_percent > 100) ? 0 : 100-$tcp_percent)}}px; background:#7da7d8; border:1px solid #000000;"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;"><b>{{$company->currency_symbol}}{{ ! empty( $your_base_pay ) ? number_format($your_base_pay ,0, '.', ',') : 0 }}
                                                                </b></td>
                                                            </tr>
                                                            <tr align="center" valign="middle" style="color:#CC0000;">
                                                                <td style="font-family: Arial, Helvetica, sans-serif;">
                                                                    <div style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;color:#2E0854;">Your Base Pay</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td align="center" valign="middle">
                                                        <table border="0" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td class="Calc"><b>+</b></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td align="center">
                                                                    <div height="{{(($tcp_percent > 100) ? 100 : $tcp_percent)}}" style="margin-left: auto;margin-right: auto;width:45px; height:{{(($tcp_percent > 100) ? 100 : $tcp_percent)}}px; background:#f00; border:1px solid #000000;"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;"><b>{{$company->currency_symbol}}{{ ! empty( $col ) ? number_format(array_sum($col) ,0, '.', ',') : 0 }}</b></td>
                                                            </tr>
                                                            <tr align="center" valign="middle" style="color:#CC0000;">
                                                                <td>
                                                                    <div style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;color:#2E0854;">{{$company->company_designation}}-Paid Benefits and
                                                                        Cash</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td align="center" valign="middle">
                                                        <table border="0" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td class="Calc"><b>=</b></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <table style="text-align: center;">
                                                            <tr style="text-align: center;">
                                                                <td align="center" style="text-align: center;">
                                                                    <table style="text-align: center;" border="0" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td align="center" style="text-align: center;">
                                                                                <div height="{{(($tcp_percent > 100) ? 100 : $tcp_percent)}}" style="display: block; margin-left: 20px;margin-right: auto;width:45px; height:{{(($tcp_percent > 100) ? 100 : $tcp_percent)}}px; background:#f00; border:1px solid #000000;"></div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center" style="text-align: center;">
                                                                                <div height="{{(($tcp_percent > 100) ? 0 : 100-$tcp_percent)}}" style="display: block;margin-left: 20px;margin-right: auto;width:45px; height:{{(($tcp_percent > 100) ? 0 : 100-$tcp_percent)}}px; background:#7da7d8; border:1px solid #000000;"></div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;"><b>
                                                                    {{$company->currency_symbol}}{{ number_format( $employer_benefits_total ,0) }}
                                                                </b></td>
                                                            </tr>
                                                            <tr align="center" valign="middle" style="color:#CC0000;">
                                                                <td>
                                                                    <div style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;color:#2E0854;">Your Total Compensation</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table style="margin-top:5px; margin-bottom:5px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                                    <tr bgcolor="#CCCCCC">
                                        <td>
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                <tr bgcolor="#CCCCCC">
                                                    <td width="4%">&nbsp;</td>
                                                    <td width="10%">
                                                        <div class="divcloud" style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;"><b style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{ !empty( $tcp_percent ) ? number_format($tcp_percent, 2, '.', ',') : 0}}%</b></div>
                                                    </td>
                                                    <td width="4%">&nbsp;</td>
                                                    <td align="left" width="82%" style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;"><b>Your
                                                            {{$company->company_designation}}-Paid Benefits and Cash represent <br />
                                                            <b style="color:#CC0000;">an additional {{ !empty( $tcp_percent ) ? number_format($tcp_percent, 2, '.', ',') : 0}}%</b> of
                                                            Your Base Pay!</b> </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- Total Compensation Package  -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="width: 100%;">
                <!-- Additional Perks -->
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                    </tr>
                    @if( ! empty( $benefits_by_category[8] ) )
                    <tr style="background-color: #cbcaca;">
                        <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><strong>Other Benefits Information</strong></td>
                        <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"></td>
                        <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"></td>
                    </tr>
                    <?php 
                        usort($benefits_by_category[8], function ($item1, $item2) {
                            return $item1['order_sequence'] <=> $item2['order_sequence'];
                        });
                    ?>
                    @foreach( $benefits_by_category[8] as $benefit )
                    <?php 
                        $count = 0;
                        $category_8['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                        $category_8['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;
                        $category_8['employer'][$count]['add_dollar'] = ! empty($benefit['add_dollar']) ? '$' : '';
                        
                        
                        $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                        $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                        if( $benefit['benefit_type_id'] == 7 ) {
                            if( $category_8['employer'][$count]['italic'] ) {
                                $heading = '<i>'.$heading. '</i>';
                                $value = '<i>'.$value. '</i>';
                            }
                            if( $category_8['employer'][$count]['bold'] ) {
                                $heading = '<strong>'.$heading. '</strong>';
                                $value = '<strong>'.$value. '</strong>';
                            } else {
                                $heading = $heading;
                                $value = $value;
                            }
                        } else {
                            $heading = '<strong>'.$heading.'</strong>';
                            $value = $value;
                        }
                        $category_8['employer'][$count]['heading'] = $heading;
                        $category_8['employer'][$count]['employer_default_value'] = $value;
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000;padding:2px 5px;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!! $heading !!}</td> 
                        <td style="border-bottom: 1px solid #000;padding:2px 5px;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                            {!! ! empty($benefit['employer_default_value']) ? $category_8['employer'][$count]['add_dollar'] . $value : '' !!}
                        </td> 
                        <td style="border-bottom: 1px solid #000;padding:2px 5px;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"></td> 
                    </tr>
                    @endforeach
                    @endif
                </table>
                <!-- Additional Perks -->
            </div>
        </section>

        <section style="width: 2%; float: left;"></section>

        <section class="cp-table-continer" style="width:49%;float: right;">
            <div style="width:100%;">
                <table style="background:#000;color:#fff;padding: 2px 5px;" background="black" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="120" style="font-family: Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold; ">Benefits</td>
                            <td width="90" style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold;text-align:left;">Company<br>Contribution</td>
                            <td style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold">Your<br>Contribution</td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        @if( isset($chunked_array_right[0]) )
                            @foreach( $chunked_array_right[0] as $benefits )
                            <?php 
                                $lower1 = floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) + floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value']));
                                $upper1 = floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) * 100;
                                $lower2 = ( floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) + floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value'])));
                                $upper2 = (floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value'])) * 100);
                            ?>
                            <tr style="background-color: <?php echo $benefits['color']?>;">
                                <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!! $benefits['heading'] !!}</td>
                                <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{{$benefits['symbol']}} <span>{!! $benefits['employer_default_value'] !!}</span></td>
                                <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                    <span>{{$company->currency_symbol}}</span>
                                    <div style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                        <span style="background: #ff1100; width:{{($upper1 / ( ! empty($lower1) ? $lower1 : 1 ))}}%;display: inline-block;height: 8px;float: left;"></span>
                                        <span style="background: #ffeb00; width:{{( $upper2/ ( ! empty($lower2) ? $lower2 : 1 ))}}%;display: inline-block;height: 8px;float: right;"></span>
                                    </div>
                                </td>
                                <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><span>{{(! empty($benefits['employee_default_value']) && $benefits['employee_default_value'] > 0 ) ? $benefits['symbol'] . '' .$benefits['employee_default_value'] : '-' }}</span></td>
                            </tr>
                            @endforeach
                            @if(count($right_rows['employer']) < 34)
                                <tr style="background-color: #cbcaca;">
                                    <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><strong>Benefits Total</strong></td>
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><strong>{{$company->currency_symbol}} {{number_format($right_side_employer,0, '.', ',')}}</strong></td>
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                        <span><strong>{{$company->currency_symbol}}</strong></span>
                                        <div style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                            <span style="background:#ff1100; width:{{(($right_side_employer * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: left;"></span>
                                            <span style="background: #ffeb00; width:{{(($right_side_employee * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: right;"></span>
                                        </div>
                                    </td>
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                        <strong>${{number_format($right_side_employee ,0, '.', ',')}}</strong>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- <div style="width:100%;">
                <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr valign="top">
                            <td width="49%" style="position:relative;">
                                <table width="100%" border="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td colspan="8" style="font-size:1pt;">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="9">
                                                <table style="margin-top:10px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                        <tr bgcolor="#CCCCCC">
                                                            <td>
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr bgcolor="#CCCCCC">
                                                                            <td width="5%">&nbsp;</td>
                                                                            <td width="10%">
                                                                                <div class="divcloud" style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;"><b style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">79.17%</b></div>
                                                                            </td>
                                                                            <td width="5%">&nbsp;</td>
                                                                            <td align="left" width="80%" style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;"><b>Your
                                                                                    Company-Paid Benefits represent <b style="color:#CC0000;">79.17%</b><br>
                                                                                    of your Total Benefits!</b> </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> -->
            
            @if(count($chunked_array_right[0]) <= 29) 
                <div style="width:100%;">
                    <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr valign="top">
                                <td width="49%" style="position:relative;">
                                    <table width="100%" border="0" cellspacing="0">
                                        <tr>
                                            <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="9">
                                                <table style="margin-top:10px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                <tr bgcolor="#CCCCCC">
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td width="10%">
                                                                        <div class="divcloud" style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;"><b style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b></div>
                                                                    </td>
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td align="left" width="80%" style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;"><b>Your
                                                                            {{$company->company_designation}}-Paid Benefits represent <b style="color:#CC0000;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b><br />
                                                                            of your Total Benefits!</b> </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </main>

    <div style="width: 100%;height: 0px;margin-top: 0px;margin-bottom: 0px; clear:both;"></div>
    
    <main style="width: 100%;">
        <section class="cp-table-continer" style="width:49%;float: left;">
            @if(count($chunked_array_left) > 1 )
                <div style="width:100%;">
                    
                    @if( isset($chunked_array_left[1]) )
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td bgcolor="#000000" align="left" height="21">
                                        <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" style="font-size:11px;">&nbsp;&nbsp;<b>Pay</b></font>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="dddd">
                        <tbody>
                            @for( $i = 1 ; $i < count($chunked_array_left) ; $i++ )
                                @if( isset($chunked_array_left[$i]) )
                                    @foreach( $chunked_array_left[$i] as $benefits )
                                        <tr style="background-color: <?php echo $benefits['color']?>;">
                                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!! $benefits['heading'] !!}</td>
                                            <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{{$benefits['symbol']}}</td>
                                            <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!!$benefits['employer_default_value']!!}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endfor
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <section style="width: 2%; float: left;"></section>

        <section class="cp-table-continer" style="width:49%;float: right;">
            @if(count($right_rows['employer']) > 29 && count($right_rows['employer']) < 34)
                <div style="width:100%;">
                    <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr valign="top">
                                <td width="49%" style="position:relative;">
                                    <table width="100%" border="0" cellspacing="0">
                                        <tr>
                                            <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="9">
                                                <table style="margin-top:10px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                <tr bgcolor="#CCCCCC">
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td width="10%">
                                                                        <div class="divcloud" style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;"><b style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b></div>
                                                                    </td>
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td align="left" width="80%" style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;"><b>Your
                                                                            {{$company->company_designation}}-Paid Benefits represent <b style="color:#CC0000;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b><br />
                                                                            of your Total Benefits!</b> </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            @if(count($chunked_array_right) > 1 )
                <div style="width:100%;">
                    <table style="background:#000;color:#fff;padding: 2px 5px;" background="black" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="120" style="font-family: Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold; ">Benefits</td>
                                <td width="90" style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold;text-align:left;">Company<br>Contribution</td>
                                <td style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold">Your<br>Contribution</td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            @for( $i = 1 ; $i < count($chunked_array_right) ; $i++ )
                                @if( isset($chunked_array_right[$i]) )
                                    @foreach( $chunked_array_right[$i] as $benefits )
                                    <?php 
                                        $lower1 = floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) + floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value']));
                                        $upper1 = floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) * 100;
                                        $lower2 = ( floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) + floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value'])));
                                        $upper2 = (floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value'])) * 100);
                                    ?>
                                    <tr style="background-color: <?php echo $benefits['color']?>;">
                                        <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!! $benefits['heading'] !!}</td>
                                        <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{{$benefits['symbol']}} <span>{!! $benefits['employer_default_value'] !!}</span></td>
                                        <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                            <span>{{$company->currency_symbol}}</span>
                                            <div style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                                <span style="background: #ff1100; width:{{($upper1 / ( ! empty($lower1) ? $lower1 : 1 ))}}%;display: inline-block;height: 8px;float: left;"></span>
                                                <span style="background: #ffeb00; width:{{( $upper2/ ( ! empty($lower2) ? $lower2 : 1 ))}}%;display: inline-block;height: 8px;float: right;"></span>
                                            </div>
                                        </td>
                                        <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><span>{{(! empty($benefits['employee_default_value']) && $benefits['employee_default_value'] > 0 ) ? $benefits['symbol'] . '' .$benefits['employee_default_value'] : '-' }}</span></td>
                                    </tr>
                                    @endforeach
                                @endif
                                @if( count($chunked_array_right)-1 == $i )
                                    <tr style="background-color: #cbcaca;">
                                        <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><strong>Benefits Total</strong></td>
                                        <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><strong>{{$company->currency_symbol}} {{number_format($right_side_employer,0, '.', ',')}}</strong></td>
                                        <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                            <span><strong>{{$company->currency_symbol}}</strong></span>
                                            <div style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                                <span style="background:#ff1100; width:{{(($right_side_employer * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: left;"></span>
                                                <span style="background: #ffeb00; width:{{(($right_side_employee * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: right;"></span>
                                            </div>
                                        </td>
                                        <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                            <strong>${{number_format($right_side_employee ,0, '.', ',')}}</strong>
                                        </td>
                                    </tr>
                                @endif
                            @endfor
                        </tbody>
                    </table>
                </div>
            @endif
            @if(count($chunked_array_right) > 1)
                <div style="width:100%;">
                    <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr valign="top">
                                <td width="49%" style="position:relative;">
                                    <table width="100%" border="0" cellspacing="0">
                                        <tr>
                                            <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="9">
                                                <table style="margin-top:10px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td>
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                <tr bgcolor="#CCCCCC">
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td width="10%">
                                                                        <div class="divcloud" style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;"><b style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b></div>
                                                                    </td>
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td align="left" width="80%" style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;"><b>Your
                                                                            {{$company->company_designation}}-Paid Benefits represent <b style="color:#CC0000;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b><br />
                                                                            of your Total Benefits!</b> </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </main>
    
    <!-- All Benefits with Category:END -->

    <div style="width: 100%;height: 0px;margin-top: 0px;margin-bottom: 0px; clear:both;"></div>
        
    <!-- Footer:START -->
    <footer>
        <table style="margin-left: auto;margin-right: auto;">
            <td width="100%" style="position:relative;">
                <table cellpadding='0' cellspacing='0'>
                    <tr>
                        <td style='font-family: Arial, Helvetica, sans-serif;font-size:10px;'>
                            <p style='font-size: 6.5pt;font-family: Arial, Helvetica, sans-serif;'><strong>Disclaimer</strong>: {!! $company->disclaimer !!}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </table>
        <table style="margin-top: 0px;border-top:1px solid #000000;margin-left: 0;margin-right: auto;padding-top: 6px;width: 100%;" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="font-size:6pt;font-family: Arial, Helvetica, sans-serif;">{!! $company->report_footer !!}</td>
                <td style="font-size:6pt;font-family: Arial, Helvetica, sans-serif;" align="right">{{url('/')}}</td>
            </tr>
        </table>
    </footer>
    <!-- Footer:END -->
</body>

</html>











<?php
/*
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Employee Benefit Report</title>
</head>
<style>
</style>

<body style="margin:0 10px;">
    <?php
        $col = [];
        foreach( $benefits_by_category as $key => $bene ) {
            if( $key == 1 || $key == 8  ) {
                continue;
            }
            foreach( $bene as $ben ) {
                if( $ben['benefit_type_id'] != 7 ) {
                    $col[] = $ben['employer_default_value'];
                }
            }
        }

        // Left side benefits
        $left_rows = [
            'employee' => [],
            'employer' => []
        ];

        if (!empty($benefits_by_category[1]) && array_sum(array_column($benefits_by_category[1], 'employer_default_value')) > 0) {
            $count = count($left_rows['employer']);
            $left_rows['employer'][$count]['heading'] = !empty($company->base_pay_heading) ? '<strong>'.$company->base_pay_heading.'</strong>' : "<strong>Base Pay</strong>";
            $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $left_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[1] ) ? number_format($category_total[1] ,0, '.', ',') : 0;
            $left_rows['employer'][$count]['color'] = "#cbcaca;";
            
            usort($benefits_by_category[1], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });
            
            foreach ($benefits_by_category[1] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0) {
                    
                    $count = count($left_rows['employer']);
                    
                    $left_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $left_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;
                    
                    if( $benefit['benefit_type_id'] == 7 ) {
                        $left_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');

                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $left_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $left_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }

                    $left_rows['employer'][$count]['heading'] = $heading;
                    $left_rows['employer'][$count]['employer_default_value'] = $value;
                    $left_rows['employer'][$count]['color'] = "#fff";
                }
            }
            
        }
        if (!empty($benefits_by_category[2]) && array_sum(array_column($benefits_by_category[2], 'employer_default_value')) > 0) {
            $count = count($left_rows['employer']);
            $left_rows['employer'][$count]['heading'] = !empty($company->other_cash_heading) ? '<strong>'.$company->other_cash_heading.'</strong>' : "<strong>Other Cash Benefits</strong>";
            $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $left_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[2] ) ? number_format($category_total[2] ,0, '.', ',') : 0;
            $left_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[2], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[2] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0) {
                    $count = count($left_rows['employer']);
                    
                    $left_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $left_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $left_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $left_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $left_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $left_rows['employer'][$count]['heading'] = $heading;
                    $left_rows['employer'][$count]['employer_default_value'] = $value;
                    $left_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }

        // Right side benefits
        $right_rows = [
            'employee' => [],
            'employer' => []
        ];

        if (!empty($benefits_by_category[3]) && array_sum(array_column($benefits_by_category[3], 'employer_default_value')) > 0) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>' . $category_name[3] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[3] ) ? number_format($category_total[3] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[3], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[3], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });
            
            foreach ($benefits_by_category[3] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[4]) && array_sum(array_column($benefits_by_category[4], 'employer_default_value')) > 0) {
            
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[4] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[4] ) ? number_format($category_total[4] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[4], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[4], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[4] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[5]) && array_sum(array_column($benefits_by_category[5], 'employer_default_value')) > 0) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[5] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[5] ) ? number_format($category_total[5] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[5], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[5], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[5] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0 ) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[6]) && array_sum(array_column($benefits_by_category[6], 'employer_default_value')) > 0) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[6] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[6] ) ? number_format($category_total[6] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[6], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[6], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[6] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[7]) && array_sum(array_column($benefits_by_category[7], 'employer_default_value')) > 0) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[7] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
            $right_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[7] ) ? number_format($category_total[7] ,0, '.', ',') : 0;
            $right_rows['employer'][$count]['employee_default_value'] = number_format(array_sum(array_column($benefits_by_category[7], 'employee_default_value')), 0, '.', ',');
            $right_rows['employer'][$count]['color'] = "#cbcaca;";

            usort($benefits_by_category[7], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[7] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employer_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                    if( $benefit['benefit_type_id'] == 7 ) {
                        if( $right_rows['employer'][$count]['italic'] ) {
                            $heading = '<i>'.$heading. '</i>';
                            $value = '<i>'.$value. '</i>';
                        }
                        if( $right_rows['employer'][$count]['bold'] ) {
                            $heading = '<strong>'.$heading. '</strong>';
                            $value = '<strong>'.$value. '</strong>';
                        } else {
                            $heading = $heading;
                            $value = $value;
                        }
                    } else {
                        $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }

        $chunked_array_right = array_chunk($right_rows['employer'], 35);
        $chunked_array_left = array_chunk($left_rows['employer'], 35);
        $loop_length = (count($chunked_array_left) > count($chunked_array_right)) ? count($chunked_array_left) : count($chunked_array_right);
    ?>

    <!-- Content Start -->
    <header style="margin-top: 28px;">
        <table style="width:100%; margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td width="45%" style="font-size:12pt;vertical-align: middle;">
                    <div style="padding-left: 20px;padding-top:0px;">
                        @if( ! empty($company->logo) )
                            <img src={{ (! empty($company->logo)? url('/'. $company->logo) : '') }} style="height: 107.5px;width: 215px;" />
                        @else
                            <div style="height: 107.5px;width: 215px;display: inline-block;"></div>
                        @endif
                        
                    </div>
                    <div style="font-family: Arial, Helvetica, sans-serif;padding-top: 60px;padding-left: 40px;font-size:11pt;">
                        <div>{{$employee->firstname}} {{$employee->lastname}}</div>
                        <div>{{$employee->address_line_1}}</div>
                        <div>{{! empty($employee->address_line_2) ? $employee->address_line_2 . ',' : ''}}</div>
                        <div>{{$employee->city}}, {{$employee->state}} {{$employee->zip}}</div>
                    </div>
                </td>
                <td width="55%" style="padding-right:30px;">
                    <div style="font-family: Arial, Helvetica, sans-serif;color:#16622e; font-size:10.5pt;line-height:1;">
                        <b>For Year Ending {{$company->month}} {{$company->day}}, {{$company->year}}</b>
                        <br />
                        <b>Your Total Compensation Report</b>
                    </div>
                    <div align="justify" style="font-family: Arial, Helvetica, sans-serif;margin-top:10px; font-size:8.5pt;">
                        {!! $company->letter !!}
                        <br>
                        {!! $company->closing !!}
                    </div>
                    <div align="justify" style="margin-top:10px; font-size:9pt;">
                        <div align="justify" style="margin-top:10px; font-size:8pt;font-family: Arial, Helvetica, sans-serif;">
                            <span style='font-size:8pt;'>{{$company->exec_name}}@if(! empty($company->exec_position)), {{$company->exec_position}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name)) )

                            @endif
                            <span style='font-size:8pt;'>{{$company->exec_name2}}@if(! empty($company->exec_position2)), {{$company->exec_position2}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name2)) )
                            

                            @endif
                            <span style='font-size:8pt;'>{{$company->exec_name3}}@if(! empty($company->exec_position3)), {{$company->exec_position3}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name3)) )
                            @endif
                            <br />
                            <span style='font-size:8pt;'><strong>Department</strong>: {{$employee->group}}</span>
                        </div>
                    </div>
                    <div align="justify" style="margin-top:10px; font-size:9pt;">
                        {{! empty($employee->mid_year_event) ? $employee->mid_year_event : ''}}<!--[MIDYEAR_TEXT]-->
                    </div>
                </td>
            </tr>
        </table>
    </header>
    <!-- Header -->
    
    <div style="width: 100%;height: 2px;background: #000;margin-top: 15px;margin-bottom: 15px; clear:both;"></div>

    <!-- Price Blocks:START -->
    <section>
        <table style="width:100%; margin-top:0px; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td width="43%" style="position:relative;">
                    <div align="center" style="color:#000000; font-size:12pt;">
                        <div style="margin-top: 15px;display: inline-block;text-align: center;padding: 0 15px;width: 100%;">
                            <div style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:140px">
                                <div style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color1}};">
                                    <span style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                        <strong>{{( ! empty($company->base_pay_heading) ? $company->base_pay_heading: 'Base Pay')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 2px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ ! empty( $your_base_pay ) ? number_format($your_base_pay ,0, '.', ',') : 0 }}
                                        <!-- ! empty( $benefits_by_category[1] ) ? number_format(array_sum(array_column($benefits_by_category[1],'employer_default_value')),0) : 0 -->
                                    </strong>
                                    </span>
                                </div>
                            </div>

                            @if( ! empty( $benefits_by_category[2] ) && array_sum(array_column($benefits_by_category[2],'employer_default_value')) > 0 )
                            <div style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;">+</div>
                            <div style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:140px">
                                <div style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color2}};">
                                    <span style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                        <strong>{{( ! empty($company->other_cash_heading) ? $company->other_cash_heading: 'Other Cash Benefits ')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 2px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <!-- <strong>{{$company->currency_symbol}}{{ ! empty($benefits_by_category[2]) ? number_format(array_sum(array_column($benefits_by_category[2],'employer_default_value')),0) : 0}}</strong> -->
                                        <strong>{{$company->currency_symbol}}{{ ! empty($other_income_total) ? number_format($other_income_total,0) : 0}}</strong>
                                    </span>
                                </div>
                            </div>
                            @endif

                            <div style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;">+</div>

                            <div style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:140px">
                                <div style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color3}};">
                                    <span style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                        <strong>{{( ! empty($company->company_paid_heading) ? $company->company_paid_heading: 'Company Paid Benefits')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 2px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ ! empty( $right_side_employer ) ? number_format($right_side_employer,0) : 0 }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;">=</div>

                            <div style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:140px">
                                <div style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color4}};">
                                    <span style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: #fff;"><strong>{{( ! empty($company->total_compensation_heading) ? $company->total_compensation_heading: 'Total Compensation')}}</strong></span>
                                </div>
                                <div style="padding: 2px 10px;font-family: Arial, Helvetica, sans-serif;color: #7850a0;">
                                    <span style="font-size: 14px;">
                                        <strong>
                                            {{$company->currency_symbol}}{{ number_format( $employer_benefits_total ,0) }}
                                        </strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </section>
    <!-- Price Blocks:END -->

    <div style="width: 100%;height: 1px;margin-top: 15px;margin-bottom: 15px; clear:both;"></div>

    <!-- All Benefits with Category:START -->
    @for( $i = 0 ; $i <= $loop_length-1 ; $i++ )
        <section class="cp-table-continer" style="width: 100%;">

            <div style="width:49%;float: left;">
                @if( isset($chunked_array_left[$i]) )
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td bgcolor="#000000" align="left" height="21">
                                    <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" style="font-size:11px;">&nbsp;&nbsp;<b>Pay</b></font>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="dddd">
                    <tbody>
                        @if( isset($chunked_array_left[$i]) )
                            @foreach( $chunked_array_left[$i] as $benefits )
                                <tr style="background-color: <?php echo $benefits['color']?>;">
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!! $benefits['heading'] !!}</td>
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{{$benefits['symbol']}}</td>
                                    <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!!$benefits['employer_default_value']!!}</td>
                                </tr>
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>

            <div style="width: 2%;float: left;"></div>

            <div style="width:49%;float: right;">
                @if( isset($chunked_array_right[$i]) )
                    <table style="background:#000;color:#fff;padding: 2px 5px;" background="black" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="120" style="font-family: Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold; ">Benefits</td>
                                <td width="90" style="font-family: Arial, Helvetica, sans-serif;text-align:right;font-size:10px;font-weight:bold;text-align:left;">Company<br>Contribution</td>
                                <td style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold">Your<br>Contribution</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        @if( isset($chunked_array_right[$i]) )
                            @foreach( $chunked_array_right[$i] as $benefits )
                            <?php 
                                $lower1 = floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) + floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value']));
                                $upper1 = floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) * 100;
                                $lower2 = ( floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) + floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value'])));
                                $upper2 = (floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value'])) * 100);
                            ?>
                            <tr style="background-color: <?php echo $benefits['color']?>;">
                                    <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!! $benefits['heading'] !!}</td>
                                    <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{{$benefits['symbol']}} <span>{!! $benefits['employer_default_value'] !!}</span></td>
                                    <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                        <span>{{$company->currency_symbol}}</span>
                                        <div style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                            <span style="background: #ff1100; width:{{($upper1 / ( ! empty($lower1) ? $lower1 : 1 ))}}%;display: inline-block;height: 8px;float: left;"></span>
                                            <span style="background: #ffeb00; width:{{( $upper2/ ( ! empty($lower2) ? $lower2 : 1 ))}}%;display: inline-block;height: 8px;float: right;"></span>
                                        </div>
                                    </td>
                                    <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><span>{{(! empty($benefits['employee_default_value']) && $benefits['employee_default_value'] > 0 ) ? $benefits['symbol'] . '' .$benefits['employee_default_value'] : '-' }}</span></td>
                                </tr>
                            @endforeach
                        @endif
                        @if( $loop_length-1 == $i )
                            <tr style="background-color: #cbcaca;">
                                <td style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><strong>Benefits Total</strong></td>
                                <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><strong>{{$company->currency_symbol}} {{number_format($right_side_employer,0, '.', ',')}}</strong></td>
                                <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                    <span><strong>{{$company->currency_symbol}}</strong></span>
                                    <div style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                        <span style="background:#ff1100; width:{{(($right_side_employer * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: left;"></span>
                                        <span style="background: #ffeb00; width:{{(($right_side_employee * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: right;"></span>
                                    </div>
                                </td>
                                <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                    <strong>${{number_format($right_side_employee ,0, '.', ',')}}</strong>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </section>
        <div style="width: 100%;height: 0px;margin-top: 0px;margin-bottom: 0px; clear:both;"></div>
    @endfor
    <!-- All Benefits with Category:END -->

    <!-- Chart and percentage:START -->
    <table style="width:100%; margin-top:15px; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
        <tr valign="top">

            <td width="49%" style="position:relative;">
                <!-- Total Compensation Package  -->
                <table cellpadding="0" cellspacing="0" width="100%" style="margin-top:15px;">
                    <tr>
                        <td bgcolor="#000000" align="center" height="25">
                            <font color="#FFFFFF" style="font-size: 11px;" face="Arial, Helvetica, sans-serif"><b>Total Compensation Package</b></font>
                            <div style='font-family: Arial, Helvetica, sans-serif;font-size:10px; font-family: Arial, Helvetica, sans-serif; color:#FFFFFF'>(Your Base Pay and {{$company->company_designation}}-Paid Benefits)</div>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr align="center">
                        <td width="50%">
                            <table border="0" cellpadding="0" cellspacing="5">
                                <tr valign="bottom">
                                    <td>
                                        <table>
                                            <tr>
                                                <td align="center">
                                                    <div height="{{(($tcp_percent > 100) ? 0 : 100-$tcp_percent)}}px" style="margin-left: auto;margin-right: auto; width:45px; height:{{(($tcp_percent > 100) ? 0 : 100-$tcp_percent)}}px; background:#7da7d8; border:1px solid #000000;"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;"><b>{{$company->currency_symbol}}{{ ! empty( $your_base_pay ) ? number_format($your_base_pay ,0, '.', ',') : 0 }}
                                                </b></td>
                                            </tr>
                                            <tr align="center" valign="middle" style="color:#CC0000;">
                                                <td style="font-family: Arial, Helvetica, sans-serif;">
                                                    <div style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;color:#2E0854;">Your Base Pay</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="center" valign="middle">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="Calc"><b>+</b></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td align="center">
                                                    <div height="{{(($tcp_percent > 100) ? 100 : $tcp_percent)}}" style="margin-left: auto;margin-right: auto;width:45px; height:{{(($tcp_percent > 100) ? 100 : $tcp_percent)}}px; background:#f00; border:1px solid #000000;"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;"><b>{{$company->currency_symbol}}{{ ! empty( $col ) ? number_format(array_sum($col) ,0, '.', ',') : 0 }}</b></td>
                                            </tr>
                                            <tr align="center" valign="middle" style="color:#CC0000;">
                                                <td>
                                                    <div style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;color:#2E0854;">{{$company->company_designation}}-Paid Benefits and
                                                        Cash</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="center" valign="middle">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="Calc"><b>=</b></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="text-align: center;">
                                        <table style="text-align: center;">
                                            <tr style="text-align: center;">
                                                <td align="center" style="text-align: center;">
                                                    <table style="text-align: center;" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td align="center" style="text-align: center;">
                                                                <div height="{{(($tcp_percent > 100) ? 100 : $tcp_percent)}}" style="display: block; margin-left: 20px;margin-right: auto;width:45px; height:{{(($tcp_percent > 100) ? 100 : $tcp_percent)}}px; background:#f00; border:1px solid #000000;"></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align: center;">
                                                                <div height="{{(($tcp_percent > 100) ? 0 : 100-$tcp_percent)}}" style="display: block;margin-left: 20px;margin-right: auto;width:45px; height:{{(($tcp_percent > 100) ? 0 : 100-$tcp_percent)}}px; background:#7da7d8; border:1px solid #000000;"></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;"><b>
                                                    {{$company->currency_symbol}}{{ number_format( $employer_benefits_total ,0) }}
                                                </b></td>
                                            </tr>
                                            <tr align="center" valign="middle" style="color:#CC0000;">
                                                <td>
                                                    <div style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;color:#2E0854;">Your Total Compensation</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table style="margin-top:5px; margin-bottom:5px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#CCCCCC">
                        <td>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr bgcolor="#CCCCCC">
                                    <td width="4%">&nbsp;</td>
                                    <td width="10%">
                                        <div class="divcloud" style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;"><b style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{ !empty( $tcp_percent ) ? number_format($tcp_percent, 2, '.', ',') : 0}}%</b></div>
                                    </td>
                                    <td width="4%">&nbsp;</td>
                                    <td align="left" width="82%" style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;"><b>Your
                                            {{$company->company_designation}}-Paid Benefits and Cash represent <br />
                                            <b style="color:#CC0000;">an additional {{ !empty( $tcp_percent ) ? number_format($tcp_percent, 2, '.', ',') : 0}}%</b> of
                                            Your Base Pay!</b> </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
                <!-- Additional Perks -->
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                    </tr>
                    @if( ! empty( $benefits_by_category[8] ) )
                    <tr style="background-color: #cbcaca;">
                        <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"><strong>Other Benefits Information</strong></td>
                        <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"></td>
                        <td style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"></td>
                    </tr>
                    <?php 
                        usort($benefits_by_category[8], function ($item1, $item2) {
                            return $item1['order_sequence'] <=> $item2['order_sequence'];
                        });
                    ?>
                    @foreach( $benefits_by_category[8] as $benefit )
                    <?php 
                        $count = 0;
                        $category_8['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                        $category_8['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;
                        $category_8['employer'][$count]['add_dollar'] = ! empty($benefit['add_dollar']) ? '$' : '';
                        
                        
                        $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                        $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                        if( $benefit['benefit_type_id'] == 7 ) {
                            if( $category_8['employer'][$count]['italic'] ) {
                                $heading = '<i>'.$heading. '</i>';
                                $value = '<i>'.$value. '</i>';
                            }
                            if( $category_8['employer'][$count]['bold'] ) {
                                $heading = '<strong>'.$heading. '</strong>';
                                $value = '<strong>'.$value. '</strong>';
                            } else {
                                $heading = $heading;
                                $value = $value;
                            }
                        } else {
                            $heading = '<strong>'.$heading.'</strong>';
                            $value = $value;
                        }
                        $category_8['employer'][$count]['heading'] = $heading;
                        $category_8['employer'][$count]['employer_default_value'] = $value;
                    ?>
                    <tr>
                        <td style="border-bottom: 1px solid #000;padding:2px 5px;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">{!! $heading !!}</td> 
                        <td style="border-bottom: 1px solid #000;padding:2px 5px;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                            {!! ! empty($benefit['employer_default_value']) ? $category_8['employer'][$count]['add_dollar'] . $value : '' !!}
                        </td> 
                        <td style="border-bottom: 1px solid #000;padding:2px 5px;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;"></td> 
                    </tr>
                    @endforeach
                    @endif
                </table>
                <!-- Additional Perks -->
                <!-- Total Compensation Package  -->
            </td>
            <td width="2%">
                &nbsp;<br />
            </td>

            <td width="49%" style="position:relative;">
                <table width="100%" border="0" cellspacing="0">
                    <tr>
                        <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan="9">
                            <table style="margin-top:10px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                                <tr bgcolor="#CCCCCC">
                                    <td>
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr bgcolor="#CCCCCC">
                                                <td width="5%">&nbsp;</td>
                                                <td width="10%">
                                                    <div class="divcloud" style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;"><b style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b></div>
                                                </td>
                                                <td width="5%">&nbsp;</td>
                                                <td align="left" width="80%" style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;"><b>Your
                                                        {{$company->company_designation}}-Paid Benefits represent <b style="color:#CC0000;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b><br />
                                                        of your Total Benefits!</b> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>
    <!-- Chart and percentage:END -->

    <!-- Footer:START -->
    <footer>
        <table style="margin-left: auto;margin-right: auto;">
            <td width="100%" style="position:relative;">
                <table cellpadding='0' cellspacing='0'>
                    <tr>
                        <td style='font-family: Arial, Helvetica, sans-serif;font-size:10px;'>
                            <p style='font-size: 6.5pt;font-family: Arial, Helvetica, sans-serif;'><strong>Disclaimer</strong>: {!! $company->disclaimer !!}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </table>
        <table style="margin-top: 0px;border-top:1px solid #000000;margin-left: 0;margin-right: auto;padding-top: 6px;width: 100%;" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td style="font-size:6pt;font-family: Arial, Helvetica, sans-serif;">{!! $company->report_footer !!}</td>
                <td style="font-size:6pt;font-family: Arial, Helvetica, sans-serif;" align="right">{{url('/')}}</td>
            </tr>
        </table>
    </footer>
    <!-- Footer:END -->
</body>
</html> */?>
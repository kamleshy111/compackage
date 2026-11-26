<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Employee Benefit Report</title>
</head>

<body style="margin:0 10px;">
    <style>
    td.ellips-text strong {
        width: 150px;
        display: inline-block;
    }
    </style>
    <?php
        if( $employee->hourly_pay_functionality ) {
            $your_base_pay = $_bt_10_143_total;
        } else {
            $your_base_pay = ! empty( $your_base_pay ) ? $your_base_pay : 0;
        }

        if( $employee->is_middle_wages_top_box ){
            $wages_div_width = "112px";
        }
        else{
            $wages_div_width = "140px";
        }

        if( empty($employer_benefits_total) ) {
            $employer_benefits_total = 1;
        }        

        $col = [];
        //dd($benefits_by_category);
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
        // dd($benefits_by_category[1]);
        $hourly_base_pay_category = '';
        if (!empty($benefits_by_category[1]) && (array_sum(array_column($benefits_by_category[1], 'employer_default_value')) > 0 || array_sum(array_column($benefits_by_category[1], 'employee_default_value')) > 0)) {
            $count = count($left_rows['employer']);
            // $left_rows['employer'][$count]['heading'] = !empty($company->base_pay_heading) ? '<strong>'.$company->base_pay_heading.'</strong>' : "<strong>Base Pay</strong>";
            $left_rows['employer'][$count]['heading'] = !empty($category_name[1]) ? '<strong>'.$category_name[1].'</strong>' : "<strong>Base Pay</strong>";
            $left_rows['employer'][$count]['symbol'] = '<strong>'.$company->currency_symbol . '</strong>';
            $left_rows['employer'][$count]['employer_default_value'] = ! empty( $category_total[1] ) ? '<strong>'. number_format($category_total[1] ,0, '.', ',').'</strong>' : '<strong>0</strong>';
            $left_rows['employer'][$count]['color'] = "#cbcaca;border-right: 1px solid #000;border-left: 1px solid #000;";
            
            usort($benefits_by_category[1], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });
            
            foreach ($benefits_by_category[1] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0) {
                    $count = count($left_rows['employer']);
                    if( $benefit['id'] == 143 && ! empty($_bt_10) && ! empty($_bt_10[141]) && ! empty($_bt_10[142]) ) {
                        $left_rows['employer'][$count]['hourly'] = true;
                        $left_rows['employer'][$count]['html'] = '<tr style="background-color: #fff;">
                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[141]['additional_benefit_name']) ? $_bt_10[141]['additional_benefit_name']: $_bt_10[141]['name']).': '.$company->currency_symbol.''.number_format($_bt_10[141]['employer_default_value'], 2).' </td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[142]['additional_benefit_name']) ? $_bt_10[142]['additional_benefit_name']: $_bt_10[142]['name']).': '.number_format($_bt_10[142]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name']: $benefit['name']).': '.$company->currency_symbol.''.number_format($benefit['employer_default_value'], 2).'</td>
                        </tr>';
                    } else {
                    
                        
                        $left_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                        $left_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;
                        $left_rows['employer'][$count]['decimal_cents'] = ! empty($benefit['decimal_cents']) ? true : false;
                        
                        
                        if( $benefit['benefit_type_id'] == 7 ) {
                            $left_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                            if(!empty($benefit['decimal_cents']))
                            {
                                $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                            }
                            else
                            {
                                // $value = $benefit['employer_default_value'];
                                $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                            }
                        } else {
                            $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                            $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                        }
                        
                        $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                        
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
                            $heading = $heading;
                            // $heading = '<strong>'.$heading.'</strong>';
                            $value = $value;
                            //$value = 8988;
                        }

                        $left_rows['employer'][$count]['heading'] = $heading;
                        $left_rows['employer'][$count]['employer_default_value'] = $value;
                        $left_rows['employer'][$count]['color'] = "#fff";
                    }
                }
            }
        }
        
        if (!empty($benefits_by_category[2]) && (array_sum(array_column($benefits_by_category[2], 'employer_default_value')) > 0 || array_sum(array_column($benefits_by_category[2], 'employee_default_value')) > 0)) {
            $count = count($left_rows['employer']);
            // $left_rows['employer'][$count]['heading'] = !empty($company->other_cash_heading) ? '<strong>'.$company->other_cash_heading.'</strong>' : "<strong>Other Cash Benefits</strong>";
            $left_rows['employer'][$count]['heading'] = !empty($category_name[2]) ? '<strong>'.$category_name[2].'</strong>' : "<strong>Other Cash Benefits</strong>";
            $left_rows['employer'][$count]['symbol'] = '<strong>'.$company->currency_symbol.'</strong>';
            $left_rows['employer'][$count]['employer_default_value'] = '<strong>'.(! empty( $category_total[2] ) ? number_format($category_total[2] ,0, '.', ',') : 0).'</strong>';
            $left_rows['employer'][$count]['color'] = "#cbcaca;border-right: 1px solid #000;border-left: 1px solid #000;";

            usort($benefits_by_category[2], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[2] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0) {
                    $count = count($left_rows['employer']);
                    
                    if( $benefit['id'] == 146 && ! empty($_bt_10) && ! empty($_bt_10[145]) && ! empty($_bt_10[144]) ) {
                        $left_rows['employer'][$count]['hourly'] = true;
                        $left_rows['employer'][$count]['html'] = '<tr style="background-color: #fff;">
                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[144]['additional_benefit_name']) ? $_bt_10[144]['additional_benefit_name']: $_bt_10[144]['name']).': '.$company->currency_symbol.''.number_format($_bt_10[144]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[145]['additional_benefit_name']) ? $_bt_10[145]['additional_benefit_name']: $_bt_10[145]['name']).': '.number_format($_bt_10[145]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name']: $benefit['name']).': '.$company->currency_symbol.''.number_format($benefit['employer_default_value'], 2).'</td>
                        </tr>';
                    } else if( $benefit['id'] == 149 && ! empty($_bt_10) && ! empty($_bt_10[147]) && ! empty($_bt_10[148]) ) {
                        $left_rows['employer'][$count]['hourly'] = true;
                        $left_rows['employer'][$count]['html'] = '<tr style="background-color: #fff;">
                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[147]['additional_benefit_name']) ? $_bt_10[147]['additional_benefit_name']: $_bt_10[147]['name']).': '.$company->currency_symbol.''.number_format($_bt_10[147]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[148]['additional_benefit_name']) ? $_bt_10[148]['additional_benefit_name']: $_bt_10[148]['name']).': '.number_format($_bt_10[148]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name']: $benefit['name']).': '.$company->currency_symbol.''.number_format($benefit['employer_default_value'], 2).'</td>
                        </tr>';
                    } else if( $benefit['id'] == 152 && ! empty($_bt_10) && ! empty($_bt_10[151]) && ! empty($_bt_10[150]) ) {
                        $left_rows['employer'][$count]['hourly'] = true;
                        $left_rows['employer'][$count]['html'] = '<tr style="background-color: #fff;">
                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[150]['additional_benefit_name']) ? $_bt_10[150]['additional_benefit_name']: $_bt_10[150]['name']).': '.$company->currency_symbol.''.number_format($_bt_10[150]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[151]['additional_benefit_name']) ? $_bt_10[151]['additional_benefit_name']: $_bt_10[151]['name']).': '.number_format($_bt_10[151]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name']: $benefit['name']).': '.$company->currency_symbol.''.number_format($benefit['employer_default_value'], 2).'</td>
                        </tr>';
                    } else if( $benefit['id'] == 155 && ! empty($_bt_10) && ! empty($_bt_10[154]) && ! empty($_bt_10[153]) ) {
                        $left_rows['employer'][$count]['hourly'] = true;
                        $left_rows['employer'][$count]['html'] = '<tr style="background-color: #fff;">
                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[153]['additional_benefit_name']) ? $_bt_10[153]['additional_benefit_name']: $_bt_10[153]['name']).': '.$company->currency_symbol.''.number_format($_bt_10[153]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[154]['additional_benefit_name']) ? $_bt_10[154]['additional_benefit_name']: $_bt_10[154]['name']).': '.number_format($_bt_10[154]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name']: $benefit['name']).': '.$company->currency_symbol.''.number_format($benefit['employer_default_value'], 2).'</td>
                        </tr>';
                    } else if( $benefit['id'] == 158 && ! empty($_bt_10) && ! empty($_bt_10[157]) && ! empty($_bt_10[156]) ) {
                        $left_rows['employer'][$count]['hourly'] = true;
                        $left_rows['employer'][$count]['html'] = '<tr style="background-color: #fff;">
                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[156]['additional_benefit_name']) ? $_bt_10[156]['additional_benefit_name']: $_bt_10[156]['name']).': '.$company->currency_symbol.''.number_format($_bt_10[156]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[157]['additional_benefit_name']) ? $_bt_10[157]['additional_benefit_name']: $_bt_10[157]['name']).': '.number_format($_bt_10[157]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name']: $benefit['name']).': '.$company->currency_symbol.''.number_format($benefit['employer_default_value'], 2).'</td>
                        </tr>';
                    } else if( $benefit['id'] == 161 && ! empty($_bt_10) && ! empty($_bt_10[160]) && ! empty($_bt_10[159]) ) {
                        $left_rows['employer'][$count]['hourly'] = true;
                        $left_rows['employer'][$count]['html'] = '<tr style="background-color: #fff;">
                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[159]['additional_benefit_name']) ? $_bt_10[159]['additional_benefit_name']: $_bt_10[159]['name']).': '.$company->currency_symbol.''.number_format($_bt_10[159]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($_bt_10[160]['additional_benefit_name']) ? $_bt_10[160]['additional_benefit_name']: $_bt_10[160]['name']).': '.number_format($_bt_10[160]['employer_default_value'], 2).'</td>

                            <td style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">'.(! empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name']: $benefit['name']).': '.$company->currency_symbol.''.number_format($benefit['employer_default_value'], 2).'</td>
                        </tr>';
                    } else {
                        $left_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                        $left_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;
                        $left_rows['employer'][$count]['decimal_cents'] = ! empty($benefit['decimal_cents']) ? true : false;

                        if( $benefit['benefit_type_id'] == 7 ) {
                            $left_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                            if(!empty($benefit['decimal_cents']))
                            {
                                $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                            }
                            else
                            {
                                // $value = $benefit['employer_default_value'];
                                $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                            }
                        } else {
                            $left_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                            $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                        }
                        
                        $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                        
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
                            // $heading = '<strong>'.$heading.'</strong>';
                            $heading = $heading;
                            $value = $value;
                        }
                        $left_rows['employer'][$count]['heading'] = $heading;
                        $left_rows['employer'][$count]['employer_default_value'] = $value;
                        $left_rows['employer'][$count]['color'] = "#fff";
                    }
                }
            }
        }

        // Right side benefits
        $right_rows = [
            'employee' => [],
            'employer' => []
        ];

        if (!empty($benefits_by_category[3]) && (array_sum(array_column($benefits_by_category[3], 'employer_default_value')) > 0 || array_sum(array_column($benefits_by_category[3], 'employee_default_value')) > 0)) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>' . $category_name[3] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = '<strong>' . ($company->currency_symbol) . '</strong>';
            $right_rows['employer'][$count]['employer_default_value'] = '<strong>' . (! empty( $category_total[3] ) ? number_format($category_total[3] ,0, '.', ',') : 0).'</strong>';
            $right_rows['employer'][$count]['employee_default_value'] = '<strong>' . number_format(array_sum(array_column($benefits_by_category[3], 'employee_default_value')), 0, '.', ',').'</strong>';
            $right_rows['employer'][$count]['color'] = "#cbcaca;border-right: 1px solid #000;border-left: 1px solid #000;";

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
                    $right_rows['employer'][$count]['decimal_cents'] = ! empty($benefit['decimal_cents']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                        if(!empty($benefit['decimal_cents']))
                        {
                            $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                        }
                        else
                        {
                            // $value = $benefit['employer_default_value'];
                            $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                        }
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                        $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    // $value = number_format($benefit['employer_default_value'], 2, '.', ',');
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
                        $heading = $heading;
                        // $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[4]) && (array_sum(array_column($benefits_by_category[4], 'employer_default_value')) > 0 || array_sum(array_column($benefits_by_category[4], 'employee_default_value')) > 0)) {
            
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[4] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = '<strong>' . $company->currency_symbol. '</strong>';
            $right_rows['employer'][$count]['employer_default_value'] = '<strong>' . (! empty( $category_total[4] ) ? number_format($category_total[4] ,0, '.', ',') : 0). '</strong>';
            $right_rows['employer'][$count]['employee_default_value'] = '<strong>' . number_format(array_sum(array_column($benefits_by_category[4], 'employee_default_value')), 0, '.', ',') . '</strong>';
            $right_rows['employer'][$count]['color'] = "#cbcaca;border-right: 1px solid #000;border-left: 1px solid #000;";

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
                    $right_rows['employer'][$count]['decimal_cents'] = ! empty($benefit['decimal_cents']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                        if(!empty($benefit['decimal_cents']))
                        {
                            $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                        }
                        else
                        {
                            // $value = $benefit['employer_default_value'];
                            $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                        }
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                        $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    // $value = number_format($benefit['employer_default_value'], 2, '.', ',');
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
                        $heading = $heading;
                        // $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[5]) && (array_sum(array_column($benefits_by_category[5], 'employer_default_value')) > 0 || array_sum(array_column($benefits_by_category[5], 'employee_default_value')) > 0)) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[5] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = '<strong>'. ( $company->currency_symbol ) . '</strong>';
            $right_rows['employer'][$count]['employer_default_value'] = '<strong>'. ( ! empty( $category_total[5] ) ? number_format($category_total[5] ,0, '.', ',') : 0 ) . '</strong>';
            $right_rows['employer'][$count]['employee_default_value'] = '<strong>'. number_format(array_sum(array_column($benefits_by_category[5], 'employee_default_value')), 0, '.', ','). '</strong>';
            $right_rows['employer'][$count]['color'] = "#cbcaca;border-right: 1px solid #000;border-left: 1px solid #000;";

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
                    $right_rows['employer'][$count]['decimal_cents'] = ! empty($benefit['decimal_cents']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                        if(!empty($benefit['decimal_cents']))
                        {
                            $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                        }
                        else
                        {
                            // $value = $benefit['employer_default_value'];
                            $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                        }
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                        $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    // $value = number_format($benefit['employer_default_value'], 2, '.', ',');
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
                        $heading = $heading;
                        // $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[6]) && (array_sum(array_column($benefits_by_category[6], 'employer_default_value')) > 0 || array_sum(array_column($benefits_by_category[6], 'employee_default_value')) > 0)) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[6] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = '<strong>' . ( $company->currency_symbol )  . '</strong>';
            $right_rows['employer'][$count]['employer_default_value'] = '<strong>' . ( ! empty( $category_total[6] ) ? number_format($category_total[6] ,0, '.', ',') : 0 ) . '</strong>';
            $right_rows['employer'][$count]['employee_default_value'] = '<strong>' . number_format(array_sum(array_column($benefits_by_category[6], 'employee_default_value')), 0, '.', ',') . '</strong>';
            $right_rows['employer'][$count]['color'] = "#cbcaca;border-right: 1px solid #000;border-left: 1px solid #000;";

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
                    $right_rows['employer'][$count]['decimal_cents'] = ! empty($benefit['decimal_cents']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                        if(!empty($benefit['decimal_cents']))
                        {
                            $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                        }
                        else
                        {
                            // $value = $benefit['employer_default_value'];
                            $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                        }
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                        $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    // $value = number_format($benefit['employer_default_value'], 2, '.', ',');
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
                        $heading = $heading;
                        // $heading = '<strong>'.$heading.'</strong>';
                        $value = $value;
                    }
                    $right_rows['employer'][$count]['heading'] = $heading;
                    $right_rows['employer'][$count]['employer_default_value'] = $value;
                    $right_rows['employer'][$count]['employee_default_value'] = number_format($benefit['employee_default_value'], 0, '.', ',');
                    $right_rows['employer'][$count]['color'] = "#fff";
                }
            }
        }
        if (!empty($benefits_by_category[7]) && (array_sum(array_column($benefits_by_category[7], 'employer_default_value')) > 0 || array_sum(array_column($benefits_by_category[7], 'employee_default_value')) > 0)) {
            $count = count($right_rows['employer']);
            $right_rows['employer'][$count]['heading'] = '<strong>'.$category_name[7] . ' Total</strong>';
            $right_rows['employer'][$count]['symbol'] = '<strong>'. ($company->currency_symbol) . '</strong>';
            $right_rows['employer'][$count]['employer_default_value'] = '<strong>'. ( ! empty( $category_total[7] ) ? number_format($category_total[7] ,0, '.', ',') : 0) . '</strong>';
            $right_rows['employer'][$count]['employee_default_value'] = '<strong>' . number_format(array_sum(array_column($benefits_by_category[7], 'employee_default_value')), 0, '.', ',') . '</strong>';
            $right_rows['employer'][$count]['color'] = "#cbcaca;border-right: 1px solid #000;border-left: 1px solid #000;";

            usort($benefits_by_category[7], function($a, $b) {
                if ($a['order_sequence'] == $b['order_sequence']) {
                    return 0;
                }
                return ($a['order_sequence'] < $b['order_sequence']) ? -1 : 1;
            });

            foreach ($benefits_by_category[7] as $c => $benefit) {
                if ((float)$benefit['employer_default_value'] > 0 || (float)$benefit['employee_default_value'] > 0) {
                    $count = count($right_rows['employer']);

                    $right_rows['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                    $right_rows['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;
                    $right_rows['employer'][$count]['decimal_cents'] = ! empty($benefit['decimal_cents']) ? true : false;

                    if( $benefit['benefit_type_id'] == 7 ) {
                        $right_rows['employer'][$count]['symbol'] = ! empty($benefit['add_dollar']) ? $company->currency_symbol : '';
                        if(!empty($benefit['decimal_cents']))
                        {
                            $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                        }
                        else
                        {
                            // $value = $benefit['employer_default_value'];
                            $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                        }
                    } else {
                        $right_rows['employer'][$count]['symbol'] = $company->currency_symbol;
                        $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                    }
                    
                    $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                    // $value = number_format($benefit['employer_default_value'], 2, '.', ',');
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
                        $heading = $heading;
                        // $heading = '<strong>'.$heading.'</strong>';
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
        
        //$_limit_increase = 23 - ($_8count+1);

        if( $employee->hourly_pay_functionality ){
            $_limit_increase = 20 - ($_8count+1);
        } else {
            $_limit_increase = 23 - ($_8count+1);
        }

        $r_count = count($right_rows['employer'])-29;
        $r_count = ($r_count > 0) ? $r_count : 0;
        
        //dd( $benefits_by_category );
        $chunked_array_right = array_chunk($right_rows['employer'], ((29+$r_count) > 33) ? 33 :(29+$r_count));
        $chunked_array_left = array_chunk($left_rows['employer'], (($_limit_increase > 2) ? $_limit_increase : 2 ) );


        // dd($chunked_array_right);
        $loop_length = (count($chunked_array_left) > count($chunked_array_right)) ? count($chunked_array_left) : count($chunked_array_right);
        // 20
        /** If not empty logo */
        $imgheight = '';
        $imgwidth = '';
        if(! empty($company->logo))
        {
            $image_dimensions = getimagesize(url('/'. $company->logo));
            /**  ($image_dimensions[0] => Width */
            /**  ($image_dimensions[1] => Height */
            if(!empty($image_dimensions[0]) && !empty($image_dimensions[1]) && intval($image_dimensions[0]) > 0 && intval($image_dimensions[1]) > 0 )
            {
                if (!empty($image_dimensions[1]) && $image_dimensions[1] < $image_dimensions[0]) 
                {
                    /* Calculate the percentage of the image height */
                    $percentage = ($image_dimensions[1] / $image_dimensions[0]) * 100;
                    //dd($percentage);
                    $percentage_total = 100 - $percentage;
                    if (!empty($percentage_total) && $percentage_total < 25) {
                        $imgheight = 'height: 107.5px;';
                    }
                    else
                    {
                        $imgwidth = 'width: 215px;';
                    }
                }
                else if (!empty($image_dimensions[0]) && $image_dimensions[0] < $image_dimensions[1]) {
                    $imgheight = 'height: 107.5px;';
                }
                else
                {
                    $imgheight = 'height: 107.5px;';
                }
            }
        }
    ?>

    <!-- Content Start -->
    <header style="margin-top: 25px;">
        <table style="width:100%; margin-left: auto;margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td width="45%" style="font-size:12pt;vertical-align: middle;">
                    <div style="padding-left: 20px;padding-top:0px;height:107.5px;width:215px;">
                        @if( ! empty($company->logo) )
                        @if(! empty($company->id) && $company->id == 2503)
                        <img src={{ (! empty($company->logo)? url('/'. $company->logo) : '') }} style="width:150px;" />
                        @else
                        <img src={{ (! empty($company->logo)? url('/'. $company->logo) : '') }}
                            style="{{ $imgheight }} {{ $imgwidth }}" />
                        @endif
                        @else
                        <div style="height: 107.5px;width: 215px;display: inline-block;"></div>
                        @endif

                    </div>

                    <div
                        style="font-family: Arial, Helvetica, sans-serif;padding-top: 45px;padding-left: 54px;font-size:11pt;">
                        <div>{{$employee->firstname}} {{$employee->lastname}}</div>
                        <div>{{$employee->address_line_1}}</div>
                        <div>{{! empty($employee->address_line_2) ? $employee->address_line_2 : ''}}</div>
                        <div>{{! empty($employee->city) ? $employee->city . ', ' : ' '}}{{$employee->state}}
                            {{$employee->zip}}</div>
                    </div>
                </td>
                <td width="55%" style="padding-right:30px;padding-left:35px;">
                    <div
                        style="font-family: Arial, Helvetica, sans-serif;color:#16622e; font-size:10.5pt;line-height:1;">
                        <b>{{ !empty($company->ending_date_label) ? $company->ending_date_label : 'For Year Ending' }}
                            {{$company->month}} {{$company->day}}, {{$company->year}}</b>
                        <br />
                        <b>Your Total Compensation Report</b>
                    </div>
                    <div align="justify"
                        style="font-family: Arial, Helvetica, sans-serif;margin-top:10px; font-size:8pt;">
                        {!! $company->letter !!}
                    </div>
                    <div align="justify"
                        style="font-family: Arial, Helvetica, sans-serif;margin-top:5px; font-size:8.5pt;">
                        {!! $company->closing !!}
                    </div>
                    <div align="justify" style="margin-top:3px; font-size:9pt;">
                        <div align="justify"
                            style="margin-top:3px; font-size:8pt;font-family: Arial, Helvetica, sans-serif;">
                            <span style='font-size:8pt;'>{{$company->exec_name}}@if(! empty($company->exec_position)),
                                {{$company->exec_position}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name)) )

                            @endif
                            <span style='font-size:8pt;'>{{$company->exec_name2}}@if(! empty($company->exec_position2)),
                                {{$company->exec_position2}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name2)) )


                            @endif
                            <span style='font-size:8pt;'>{{$company->exec_name3}}@if(! empty($company->exec_position3)),
                                {{$company->exec_position3}} @endif<br /></span>
                            @if(! empty($employee->group && ! empty($company->exec_name3)) )
                            @endif
                            <br />
                            @if( ! empty( $employee->group ) )
                            <span style='font-size:8pt;'><strong>Department</strong>: {{$employee->group}}</span>
                            @endif
                        </div>
                    </div>
                    <div align="justify"
                        style="margin-top:0px; font-size:9pt; font-family: Arial, Helvetica, sans-serif;">
                        {{! empty($employee->mid_year_event) ? $employee->mid_year_event : ''}}
                        <!--[MIDYEAR_TEXT]-->
                    </div>
                </td>
            </tr>
        </table>
    </header>
    <!-- Header -->

    <div style="width: 100%;height: 2px;background: #fff;margin-top: 15px;margin-bottom: 0px; clear:both;"></div>

    <!-- Price Blocks:START -->
    <section>
        <table style="width:100%; margin-top:0px; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0"
            cellpadding="0" cellspacing="0">
            @if( $employee->hourly_pay_functionality )
            <tr valign="top">
                <td width="43%" style="position:relative;">
                    <div align="center" style="color:#000000; font-size:12pt;">
                        <div
                            style="margin-top: 10px;display: inline-block;text-align: center;padding: 0 15px;width: 100%;">
                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color3}};">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color:{{$company->color3_3}}">
                                        <strong>{{( ! empty($company->base_pay_hourly_heading) ? $company->base_pay_hourly_heading: 'Base Hourly')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ number_format($_bt_10_141_rate, 2) }}/hr
                                        </strong>
                                    </span>
                                </div>
                            </div>

                            @if( ! empty( $benefits_by_category[2] ) &&
                            array_sum(array_column($benefits_by_category[2],'employer_default_value')) > 0 )
                            <div
                                style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;width:5px">
                                +</div>
                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color2}};">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color:{{$company->color2_2}}">
                                        <strong>{{( ! empty($company->other_cash_hourly_heading) ? $company->other_cash_hourly_heading: 'Other Income/hr')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <!-- <strong>{{$company->currency_symbol}}{{ ! empty($benefits_by_category[2]) ? number_format(array_sum(array_column($benefits_by_category[2],'employer_default_value')),0) : 0}}</strong> -->
                                        <strong>{{$company->currency_symbol}}{{number_format($_ocb_rate_10,2)}}/hr</strong>
                                    </span>
                                </div>
                            </div>
                            @endif

                            @if( $employee->is_middle_wages_top_box )
                            <?php
                            //$temp_bt_10_141_rate = !empty($_bt_10_141_rate) ? floor((float)$_bt_10_141_rate) : 0;
                            //$temp_ocb_rate_10 = !empty($_ocb_rate_10) ? floor((float)$_ocb_rate_10) : 0;
                            $grand__ocb_rate_10 = $_bt_10_141_rate + $_ocb_rate_10;
                            ?>
                            <div
                                style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;width:5px">
                                =</div>

                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{!empty($company->color5) ? $company->color5 : '#a194c4'}}">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color:{{$company->color5_5}}">
                                        <strong>{{( ! empty($company->company_total_wages_hr_heading) ? $company->company_total_wages_hr_heading: 'Total Wages/hr.')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ number_format($grand__ocb_rate_10, 2) }}/hr
                                        </strong>
                                    </span>
                                </div>
                            </div>
                            @endif

                            <div
                                style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;width:5px">
                                +</div>

                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color2}};">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color:{{$company->color2_2}}">
                                        <strong>{{( ! empty($company->company_paid_hourly_heading) ? $company->company_paid_hourly_heading: 'Benefits/hr')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{number_format($_cpb_rate_10,2)}}/hr</strong>
                                    </span>
                                </div>
                            </div>

                            <div
                                style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;width:5px">
                                =</div>

                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color4}};">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: {{$company->color4_4}};"><strong>{{( ! empty($company->total_compensation_hourly_heading) ? $company->total_compensation_hourly_heading: 'Total Pkg./hr')}}</strong></span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>
                                            {{$company->currency_symbol}}{{number_format($_cpb_rate_10 + $_ocb_rate_10 + $_bt_10_141_rate, 2)}}/hr
                                        </strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endif

            <tr valign="top">
                <td width="43%" style="position:relative;">
                    <div align="center" style="color:#000000; font-size:12pt;">
                        <div
                            style="margin-top: 10px;display: inline-block;text-align: center;padding: 0 15px;width: 100%;">
                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color3}};">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color:{{$company->color3_3}}">
                                        <strong>{{( ! empty($company->base_pay_heading) ? $company->base_pay_heading: 'Base Pay')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ ! empty( $your_base_pay ) ? number_format($your_base_pay ,0, '.', ',') : 0 }}</strong>
                                    </span>
                                </div>
                            </div>

                            @if( ! empty( $benefits_by_category[2] ) &&
                            array_sum(array_column($benefits_by_category[2],'employer_default_value')) > 0 )
                            <div
                                style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;width:5px">
                                +</div>
                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color2}};">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color:{{$company->color2_2}}">
                                        <strong>{{( ! empty($company->other_cash_heading) ? $company->other_cash_heading: 'Other Income')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <!-- <strong>{{$company->currency_symbol}}{{ ! empty($benefits_by_category[2]) ? number_format(array_sum(array_column($benefits_by_category[2],'employer_default_value')),0) : 0}}</strong> -->
                                        <strong>{{$company->currency_symbol}}{{ ! empty($other_income_total) ? number_format($other_income_total,0) : 0}}</strong>
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if( $employee->is_middle_wages_top_box )
                            <div
                                style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;width:5px">
                                =</div>

                            <?php
                            $total_wages_base = !empty($other_income_total) ? floor((float)$other_income_total) : 0;
                            $total_wages_base_hr = !empty($your_base_pay) ? floor((float)$your_base_pay) : 0;
                            $grand_total_wages_base_hr = $total_wages_base + $total_wages_base_hr;
                            ?>

                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{!empty($company->color5) ? $company->color5 : '#a194c4'}}">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color:{{$company->color5_5}}">
                                        <strong>{{( ! empty($company->company_total_wages_heading) ? $company->company_total_wages_heading: 'Total Wages')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ number_format($grand_total_wages_base_hr, 0) }}</strong>
                                    </span>
                                </div>
                            </div>
                            @endif

                            <div
                                style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;width:5px">
                                +</div>

                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color2}};">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color:{{$company->color2_2}}">
                                        <strong>{{( ! empty($company->company_paid_heading) ? $company->company_paid_heading: 'Company Paid Benefits')}}</strong>
                                    </span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
                                    <span style="font-size: 14px;">
                                        <strong>{{$company->currency_symbol}}{{ ! empty( $right_side_employer ) ? number_format($right_side_employer,0) : 0 }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div
                                style="padding: 0 10px;font-weight: 900;font-size: 20px;display: inline-block;vertical-align: middle;width:5px">
                                =</div>

                            <div
                                style="text-align: center;border: 1px solid #000;display: inline-block;vertical-align: middle;width:{{$wages_div_width}}">
                                <div
                                    style="border-bottom: 1px solid #000;padding: 2px 10px;background-color: {{$company->color4}};">
                                    <span
                                        style="display: block;font-size: 10px;font-family: Arial, Helvetica, sans-serif;color: {{$company->color4_4}};"><strong>{{( ! empty($company->total_compensation_heading) ? $company->total_compensation_heading: 'Total Compensation')}}</strong></span>
                                </div>
                                <div style="padding: 0px 10px;font-family: Arial, Helvetica, sans-serif;">
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

    <div style="width: 100%;height: 1px;margin-top: 0px;margin-bottom: 6px; clear:both;"></div>

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
                                <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" style="font-size:11px;">
                                    &nbsp;&nbsp;<b>Pay</b></font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="dddd">
                    <tbody>
                        @if( isset($chunked_array_left[0]) )
                        @foreach( $chunked_array_left[0] as $benefits )
                        @if(! empty($benefits['hourly']))
                        {!! $benefits['html'] !!}
                        @else
                        <tr style="background-color: <?php echo $benefits['color']?>">
                            <td
                                style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                {!! $benefits['heading'] !!}</td>
                            <td
                                style="padding:2px 5px;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                            </td>
                            <td nowrap
                                style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                {!! $benefits['symbol'] !!} {!! $benefits['employer_default_value'] !!}</td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div style="width:100%;">
                <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0"
                    cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr valign="top">
                            <td width="49%" style="position:relative;">
                                <!-- Total Compensation Package  -->
                                <table cellpadding="0" cellspacing="0" width="100%" style="margin-top:15px;">
                                    <tr>
                                        <td bgcolor="#000000" align="center" height="20">
                                            <font color="#FFFFFF" style="font-size: 11px;"
                                                face="Arial, Helvetica, sans-serif"><b>Total Compensation Package</b>
                                            </font>
                                            <div
                                                style='display:none; font-family: Arial, Helvetica, sans-serif;font-size:10px; font-family: Arial, Helvetica, sans-serif; color:#FFFFFF'>
                                                (Your Base Pay and
                                                {{isset($company->company_designation) && !empty($company->company_designation) ? $company->company_designation : 'Company'}}-Paid
                                                Benefits)</div>
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
                                                                    <div height="{{(($your_base_pay*100)/$employer_benefits_total/1.7)}}px"
                                                                        style="margin-left: auto;margin-right: auto; width:45px; height:{{(($your_base_pay*100)/$employer_benefits_total/1.7)}}px; background:{{$company->color3}}; border:1px solid #000000;">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                                                    <b>{{$company->currency_symbol}}{{ ! empty( $your_base_pay ) ? number_format($your_base_pay ,0, '.', ',') : 0 }}</b>
                                                                </td>
                                                            </tr>
                                                            <tr align="center" valign="middle" style="color:#000000;">
                                                                <td style="font-family: Arial, Helvetica, sans-serif;">
                                                                    <div
                                                                        style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;">
                                                                        Base Pay</div>
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
                                                                    <div height="{{((array_sum($col)*100)/$employer_benefits_total/1.7)}}"
                                                                        style="margin-left: auto;margin-right: auto;width:45px; height:{{((array_sum($col)*100)/$employer_benefits_total/1.7)}}px; background:{{$company->color2}}; border:1px solid #000000;">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                                                    <b>{{$company->currency_symbol}}{{ ! empty( $col ) ? number_format(array_sum($col) ,0, '.', ',') : 0 }}</b>
                                                                </td>
                                                            </tr>
                                                            <tr align="center" valign="middle" style="color:#000000;">
                                                                <td>
                                                                    <div
                                                                        style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;">
                                                                        {{isset($company->company_designation) && !empty($company->company_designation) ? $company->company_designation : 'Company'}}-Paid
                                                                        Benefits/Other Income</div>
                                                                    <!-- Change Cash to Other Income -->
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
                                                                    <table style="text-align: center;" border="0"
                                                                        cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td align="center"
                                                                                style="text-align: center;">
                                                                                <div height="{{((array_sum($col)*100)/$employer_benefits_total/1.7)}}"
                                                                                    style="display: block; margin-left: 20px;margin-right: auto;width:45px; height:{{((array_sum($col)*100)/$employer_benefits_total/1.7)}}px; background:{{$company->color2}}; border:1px solid #000000;">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center"
                                                                                style="text-align: center;">
                                                                                <div height="{{(($your_base_pay*100)/$employer_benefits_total/1.7)}}"
                                                                                    style="display: block;margin-left: 20px;margin-right: auto;width:45px; height:{{(($your_base_pay*100)/$employer_benefits_total/1.7)}}px; background:{{$company->color3}}; border:1px solid #000000;">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;">
                                                                    <b>
                                                                        {{$company->currency_symbol}}{{ number_format( $employer_benefits_total ,0) }}
                                                                    </b>
                                                                </td>
                                                            </tr>
                                                            <tr align="center" valign="middle" style="color:#000000;">
                                                                <td>
                                                                    <div
                                                                        style="font-size:7pt;line-height:1;font-family: Arial, Helvetica, sans-serif;">
                                                                        Total Compensation</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table style="margin-top:5px; margin-bottom:5px;" width="100%" border="1"
                                    cellpadding="0" cellspacing="0">
                                    <tr bgcolor="#CCCCCC">
                                        <td>
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                <tr bgcolor="#CCCCCC">
                                                    <td width="4%">&nbsp;</td>
                                                    <td width="10%">
                                                        <div class="divcloud"
                                                            style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;">
                                                            <b
                                                                style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{ !empty( $tcp_percent ) ? number_format(((array_sum($col)*100)/$your_base_pay), 2, '.', ',') : 0}}%</b>
                                                            </div>
                                                    </td>
                                                    <td width="4%">&nbsp;</td>
                                                    <td align="left" width="82%"
                                                        style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;">
                                                        <b>Your
                                                            {{isset($company->company_designation) && !empty($company->company_designation) ? $company->company_designation : 'Company'}}-Paid
                                                            Benefits and Other Income represent <br />
                                                            <!-- Change Cash to Other Income -->
                                                            <b style="color:#CC0000;">an additional
                                                                {{ !empty( $tcp_percent ) ? number_format(((array_sum($col)*100)/$your_base_pay), 2, '.', ',') : 0}}%</b>
                                                            of
                                                            Your Base Pay!</b>
                                                    </td>
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

                    <!-- && reset($benefits_by_category[8])['employer_default_value'] > 0 -->
                    @if( ! empty( $benefits_by_category[8] ) )
                    <tr
                        style="background-color: #cbcaca;border-right: 1px solid #000;border-left: 1px solid #000;border-top: 1px solid #000;">
                        <td
                            style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                            <strong>
                                @if($category_name[8] == 'Additional Benefits/hr')
                                    Additional Benefits
                                @else
                                    {{ $category_name[8] }}
                                @endif
                            </strong>
                        </td>
                        <td
                            style="padding:2px 5px;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                        </td>
                        <td
                            style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                        </td>
                    </tr>
                    <?php 
                            usort($benefits_by_category[8], function ($item1, $item2) {
                                return $item1['order_sequence'] <=> $item2['order_sequence'];
                            });
                        ?>

                    @foreach( $benefits_by_category[8] as $benefit )
                    @if( in_array($benefit['id'], [60,61,62,63,64]) || $benefit['employer_default_value'] > 0 ||
                    $benefit['benefit_type_id'] != 7 )
                    <?php 
                                $count = 0;
                                $category_8['employer'][$count]['bold'] = ! empty($benefit['bold']) ? true : false;
                                $category_8['employer'][$count]['italic'] = ! empty($benefit['italic']) ? true : false;
                                $category_8['employer'][$count]['add_dollar'] = ! empty($benefit['add_dollar']) ? '$' : '';
                                $category_8['employer'][$count]['decimal_cents'] = ! empty($benefit['decimal_cents']) ? true : false;
                                
                                $heading = (!empty($benefit['additional_benefit_name']) ? $benefit['additional_benefit_name'] : $benefit['name']);
                                
                                if( $benefit['benefit_type_id'] == 7 ) {
                                    if(!empty($benefit['decimal_cents']))
                                    {
                                        $value = number_format($benefit['employer_default_value'], 2, '.', ',');
                                    }
                                    else
                                    {
                                        //$value = $benefit['employer_default_value'];
                                        $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                                    }
                                    
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
                                    $value = number_format($benefit['employer_default_value'], 0, '.', ',');
                                    // $heading = '<strong>'.$heading.'</strong>';
                                    $heading = $heading;
                                    $value = $value;
                                }
                                $category_8['employer'][$count]['heading'] = $heading;
                                $category_8['employer'][$count]['employer_default_value'] = $value;
                            ?>
                    <tr>
                        <td
                            style="border-bottom: 1px solid #000;padding:2px 5px;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                            {!! $heading !!}</td>
                        <td
                            style="border-bottom: 1px solid #000;padding:2px 5px;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                            {!! ! empty($benefit['employer_default_value']) ?
                            $category_8['employer'][$count]['add_dollar'] . $value : '' !!}
                        </td>
                        <td
                            style="border-bottom: 1px solid #000;padding:2px 5px;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                </table>
                <!-- Additional Perks -->
            </div>
        </section>

        <section style="width: 2%; float: left;"></section>

        <section class="cp-table-continer" style="width:49%;float: right;">
            <div style="width:100%;">
                <table style="background:#000;color:#fff;padding: 2px 5px;" background="black" width="100%" border="0"
                    cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="120"
                                style="font-family: Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold; ">
                                Benefits</td>
                            @if($_exclude_emp != 1)
                            <td width="90"
                                style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold;text-align:left;">
                                {{!empty($company->company_designation) ? $company->company_designation : 'Company'}}<br>Contribution
                            </td>
                            <td
                                style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold">
                                Your<br>Contribution</td>
                            @else
                            <td
                                style="font-family: Arial, Helvetica, sans-serif;text-align:right;font-size:10px;font-weight:bold;">
                                {{!empty($company->company_designation) ? $company->company_designation : 'Company'}}<br>Contribution
                            </td>
                            @endif
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
                            <td class="ellips-text"
                                style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                {!! $benefits['heading'] !!}</td>
                            <td nowrap
                                style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                {!! (! empty($benefits['employer_default_value']) && $benefits['employer_default_value']
                                > 0 ) ? $benefits['symbol'] . '' .$benefits['employer_default_value'] : '--' !!}</span>
                            </td>
                            @if($_exclude_emp != 1)
                            <td
                                style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                <!-- <span>{!! $company->currency_symbol !!}</span> -->
                                <div
                                    style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                    <span
                                        style="background:{{$company->color2}}; width:{{($upper1 / ( ! empty($lower1) ? $lower1 : 1 ))}}%;display: inline-block;height: 8px;float: left;"></span>
                                    <span
                                        style="background:{{$company->color1}}; width:{{( $upper2/ ( ! empty($lower2) ? $lower2 : 1 ))}}%;display: inline-block;height: 8px;float: right;"></span>
                                </div>
                            </td>
                            <td nowrap
                                style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                <span style="display: inline-block;">{!! (! empty($benefits['employee_default_value'])
                                    && $benefits['employee_default_value'] > 0 ) ? $benefits['symbol'] . ''
                                    .$benefits['employee_default_value'] : '--' !!}</span>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @if(count($right_rows['employer']) < 34) <tr style="background-color: #cbcaca;">
                            <td
                                style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                <strong>
                                    @if(! empty($company->benefits_total_heading))
                                    {{ $company->benefits_total_heading }}
                                    @else
                                    Benefits Total
                                    @endif
                                </strong>
                            </td>
                            <td nowrap
                                style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                <strong>{{$company->currency_symbol}}
                                    {{number_format($right_side_employer,0, '.', ',')}}</strong>
                            </td>
                            @if($_exclude_emp != 1)
                            <td
                                style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                {{-- <!-- <span><strong>{{$company->currency_symbol}}</strong></span> --> --}}
                                <div
                                    style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                    <span
                                        style="background:{{$company->color2}}; width:{{(($right_side_employer * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: left;"></span>
                                    <span
                                        style="background: {{$company->color1}}; width:{{(($right_side_employee * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: right;"></span>
                                </div>
                            </td>
                            <td nowrap
                                style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                <strong>${{number_format($right_side_employee ,0, '.', ',')}}</strong>
                            </td>
                            @endif
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

            @if( ! empty($chunked_array_right) && isset($chunked_array_right[0]) && count($chunked_array_right[0]) <= 29
                && $_exclude_emp !=1 ) <div style="width:100%;">
                <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0"
                    cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr valign="top">
                            <td width="49%" style="position:relative;">
                                <table width="100%" border="0" cellspacing="0">
                                    <tr>
                                        <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="9">
                                            <table style="margin-top:10px;" width="100%" border="1" cellpadding="0"
                                                cellspacing="0">
                                                <tr bgcolor="#CCCCCC">
                                                    <td>
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                            <tr bgcolor="#CCCCCC">
                                                                <td width="5%">&nbsp;</td>
                                                                <td width="10%">
                                                                    <div class="divcloud"
                                                                        style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;">
                                                                        <b
                                                                            style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b>
                                                                    </div>
                                                                </td>
                                                                <td width="5%">&nbsp;</td>
                                                                <td align="left" width="80%"
                                                                    style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;">
                                                                    <b>Your
                                                                        {{isset($company->company_designation) && !empty($company->company_designation) ? $company->company_designation : 'Company'}}-Paid
                                                                        Benefits represent <b
                                                                            style="color:#CC0000;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b><br />
                                                                        of your Total Benefits!</b>
                                                                </td>
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
                                <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" style="font-size:11px;">
                                    &nbsp;&nbsp;<b>Pay</b></font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="dddd">
                    <tbody>
                        @for( $i = 1 ; $i < count($chunked_array_left) ; $i++ ) @if( isset($chunked_array_left[$i]) )
                            @foreach( $chunked_array_left[$i] as $benefits ) @if(! empty($benefits['hourly'])) {!!
                            $benefits['html'] !!} @else <tr style="background-color: <?php echo $benefits['color']?>;">
                            <td
                                style="padding:2px 5px;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                {!! $benefits['heading'] !!}</td>
                            <td
                                style="padding:2px 5px;border-bottom: 1px solid #000;text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                            </td>
                            <td
                                style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                {!! $benefits['symbol'] !!} {!!$benefits['employer_default_value']!!}</td>
                            </tr>
                            @endif
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
            @if(count($right_rows['employer']) > 29 && count($right_rows['employer']) < 34 && $_exclude_emp !=1 ) <div
                style="width:100%;">
                <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0"
                    cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr valign="top">
                            <td width="49%" style="position:relative;">
                                <table width="100%" border="0" cellspacing="0">
                                    <tr>
                                        <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="9">
                                            <table style="margin-top:10px;" width="100%" border="1" cellpadding="0"
                                                cellspacing="0">
                                                <tr bgcolor="#CCCCCC">
                                                    <td>
                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                            <tr bgcolor="#CCCCCC">
                                                                <td width="5%">&nbsp;</td>
                                                                <td width="10%">
                                                                    <div class="divcloud"
                                                                        style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;">
                                                                        <b
                                                                            style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b>
                                                                    </div>
                                                                </td>
                                                                <td width="5%">&nbsp;</td>
                                                                <td align="left" width="80%"
                                                                    style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;">
                                                                    <b>Your
                                                                        {{isset($company->company_designation) && !empty($company->company_designation) ? $company->company_designation : 'Company'}}-Paid
                                                                        Benefits represent <b
                                                                            style="color:#CC0000;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b><br />
                                                                        of your Total Benefits!</b>
                                                                </td>
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
                    <table style="background:#000;color:#fff;padding: 2px 5px;" background="black" width="100%"
                        border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="120"
                                    style="font-family: Arial, Helvetica, sans-serif;font-size:10px;font-weight:bold; ">
                                    Benefits</td>
                                @if($_exclude_emp != 1)
                                <td width="90"
                                    style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold;text-align:left;">
                                    Company<br>Contribution</td>
                                <td
                                    style="font-family: Arial, Helvetica, sans-serif;text-align:center;font-size:10px;font-weight:bold">
                                    Your<br>Contribution</td>
                                @else
                                <td
                                    style="font-family: Arial, Helvetica, sans-serif;text-align:right;font-size:10px;font-weight:bold;">
                                    Company<br>Contribution</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            @for( $i = 1 ; $i < count($chunked_array_right) ; $i++ ) @if(
                                isset($chunked_array_right[$i]) ) @foreach( $chunked_array_right[$i] as $benefits ) <?php 
                                        $lower1 = floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) + floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value']));
                                        $upper1 = floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) * 100;
                                        $lower2 = ( floatval(preg_replace('/[^\d.]/', '', $benefits['employer_default_value'])) + floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value'])));
                                        $upper2 = (floatval(preg_replace('/[^\d.]/', '', $benefits['employee_default_value'])) * 100);
                                    ?> <tr style="background-color: <?php echo $benefits['color']?>;">
                                <td
                                    style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                    {!! $benefits['heading'] !!}</td>
                                <td
                                    style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                    <span>{{(! empty($benefits['employer_default_value']) && $benefits['employer_default_value'] > 0 ) ? $benefits['symbol'] . '' .$benefits['employer_default_value'] : '--' }}</span>
                                </td>
                                @if($_exclude_emp != 1)
                                <td
                                    style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                    <span>{{$company->currency_symbol}}</span>
                                    <div
                                        style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                        <span
                                            style="background: #ff1100; width:{{($upper1 / ( ! empty($lower1) ? $lower1 : 1 ))}}%;display: inline-block;height: 8px;float: left;"></span>
                                        <span
                                            style="background: #ffeb00; width:{{( $upper2/ ( ! empty($lower2) ? $lower2 : 1 ))}}%;display: inline-block;height: 8px;float: right;"></span>
                                    </div>
                                </td>
                                <td
                                    style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                    <span>{{(! empty($benefits['employee_default_value']) && $benefits['employee_default_value'] > 0 ) ? $benefits['symbol'] . '' .$benefits['employee_default_value'] : '--' }}</span>
                                </td>
                                @endif
                                </tr>
                                @endforeach
                                @endif
                                @if( count($chunked_array_right)-1 == $i )
                                <tr style="background-color: #cbcaca;">
                                    <td
                                        style="padding:2px 5px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                        <strong>
                                            @if(! empty($company->benefits_total_heading))
                                            {{ $company->benefits_total_heading }}
                                            @else
                                            Benefits Total
                                            @endif</strong>
                                    </td>
                                    <td
                                        style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                        <strong>{{$company->currency_symbol}}
                                            {{number_format($right_side_employer,0, '.', ',')}}</strong>
                                    </td>
                                    @if($_exclude_emp != 1)
                                    <td
                                        style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;vertical-align: middle;">
                                        <span><strong>{{$company->currency_symbol}}</strong></span>
                                        <div
                                            style="vertical-align: middle;border:1px solid #000; height: 8px;display: inline-block;margin-right:2px;width: 50px;">
                                            <span
                                                style="background:#ff1100; width:{{(($right_side_employer * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: left;"></span>
                                            <span
                                                style="background: #ffeb00; width:{{(($right_side_employee * 100) / ( $right_left_total))}}%;display: inline-block;height: 8px;float: right;"></span>
                                        </div>
                                    </td>
                                    <td
                                        style="padding:2px 5px;border-bottom: 1px solid #000;text-align: right;font-family: Arial, Helvetica, sans-serif;font-size: 9px;">
                                        <strong>${{number_format($right_side_employee ,0, '.', ',')}}</strong>
                                    </td>
                                    @endif
                                </tr>
                                @endif
                                @endfor
                        </tbody>
                    </table>
                </div>
                @endif
                @if(count($chunked_array_right) > 1 && $_exclude_emp != 1 )
                <div style="width:100%;">
                    <table style="width:100%; margin-bottom:0px;margin-left: auto;margin-right: auto;" border="0"
                        cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr valign="top">
                                <td width="49%" style="position:relative;">
                                    <table width="100%" border="0" cellspacing="0">
                                        <tr>
                                            <td colspan='8' style='font-size:1pt;'>&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="9">
                                                <table style="margin-top:10px;" width="100%" border="1" cellpadding="0"
                                                    cellspacing="0">
                                                    <tr bgcolor="#CCCCCC">
                                                        <td>
                                                            <table width="100%" border="0" cellpadding="0"
                                                                cellspacing="0">
                                                                <tr bgcolor="#CCCCCC">
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td width="10%">
                                                                        <div class="divcloud"
                                                                            style="background-color: #efd514;border:1px solid #ff0000;text-align: center;width: 40px;height: 40px;line-height:30px;border-radius:100%;">
                                                                            <b
                                                                                style="font-size:8pt; color:#CC0000;font-family: Arial, Helvetica, sans-serif;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b>
                                                                        </div>
                                                                    </td>
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td align="left" width="80%"
                                                                        style="font-size:6.5pt;font-family: Arial, Helvetica, sans-serif;">
                                                                        <b>Your
                                                                            {{isset($company->company_designation) && !empty($company->company_designation) ? $company->company_designation : 'Company'}}-Paid
                                                                            Benefits represent <b
                                                                                style="color:#CC0000;">{{! empty($cpb_percent) ? $cpb_percent : 0}}%</b><br />
                                                                            of your Total Benefits!</b>
                                                                    </td>
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
    <?php
        $rightCountCP = count($right_rows['employer']);
        $leftCountCP = count($left_rows['employer']);
        //dd($rightCountCP);
    ?>
    <!-- Footer:START -->
    <?php if ($rightCountCP > 26 && $rightCountCP <= 30 || $leftCountCP > 14 && $leftCountCP <= 18) { ?>
    <footer style="position: relative; margin-top: 0px; bottom: 10px;width: 100%;">
        <?php } else {?>
        <footer style="position: absolute;bottom: 10px;width: 100%;">
            <?php } ?>
            <table style="margin-left: auto;margin-right: auto;">
                <td width="100%" style="position:relative;">
                    <table cellpadding='0' cellspacing='0'>
                        <tr>
                            <td style='font-family: Arial, Helvetica, sans-serif;font-size:10px;'>
                                <p style='font-size: 6.5pt;font-family: Arial, Helvetica, sans-serif;'>
                                    @if( ! empty( $company->disclaimer ) )
                                    <strong>Disclaimer</strong>: {!! $company->disclaimer !!}
                                    @endif
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </table>
            <table
                style="margin-top: 0px;border-top:1px solid #000000;margin-left: 0;margin-right: auto;padding-top: 6px;width: 100%;"
                border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="font-size:6pt;font-family: Arial, Helvetica, sans-serif;">{!! $company->report_footer !!}
                    </td>
                    <td style="font-size:6pt;font-family: Arial, Helvetica, sans-serif;" align="right">{{url('/')}}</td>
                </tr>
            </table>
        </footer>
        <!-- Footer:END -->
</body>

</html>
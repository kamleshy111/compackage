<template>
    <form action="#" method="POST" enctype="multipart/form-data" v-on:submit="updateCompany">
        <div class="flex flex-wrap row -mx-4">
            <div class="w-full px-4">

                <div class="w-full px-2.5 flex flex-wrap gap-4 justify-end">
                    <input
                        class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md"
                        type="submit" name="" value="Save" id="" />
                    <a :href="url + '/create-report?employee_id='+employee.id+'&exclude_emp='+this.exclude_employee_contributions"
                        class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" target="_blank">Create PDF Report</a>
                    <a href="javascript:void()" v-if="employee.is_digital_delivery" v-on:click="sendEmployeeALink"
                        class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" target="_blank">Send Employee a Link</a>
                </div>

                <p class="cpation text-black text-base mb-10">(You must have pop-ups enabled on your browser to view
                    report. To print your report use your browser's print function.)</p>
                <div class="xl:w-1/2 w-full">

                    <h3 class="text-xl text-black mb-5">Employee Information</h3>


                    <div class="flex -m-2.5 mb-3">
                        <div class="w-1/2 px-2.5">
                            <label class="mb-1">First Name</label>
                            <input name="firstname" type="text" disabled maxlength="30" v-model="employee.firstname"
                                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="w-1/2 px-2.5">
                            <label class="mb-1">Last Name</label>
                            <input name="lastname" type="text" disabled maxlength="30" v-model="employee.lastname"
                                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                    </div>

                    <div class="flex -m-2.5 mt-4">
                        <div class="lg:w-1/2 w-full mb-3 mb-3 px-2.5">
                            <label class="mb-1">Email</label>
                            <input name="email" type="email" maxlength="60" v-model="employee.email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                        </div>
                        <div class="lg:w-1/2 w-full mb-3 mb-3 px-2.5">
                            <label class="mb-1">Cell Phone</label>
                            <input name="phone" type="tel" maxlength="15" v-model="employee.phone" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                        </div>
                    </div>

                    <div class="w-full mb-3 mb-3">
                        <label class="mb-1">Employee ID (SSN cannot be used for Employee ID)</label>
                        <input name="employee_id" type="text" disabled maxlength="30" v-model="employee.employee_id"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>

                    <div class="w-full mb-3 mb-3">
                        <label class="mr-1">Inactive</label>
                        <input type="checkbox" v-model="employee.inactive" value="1">
                    </div>

                    <div class="w-full mb-3 mb-3">
                        <label for="toggleB" class="flex items-center cursor-pointer">
                            <div>Hourly Pay Functionality</div>
                            <div class="relative ml-3">
                                <input type="checkbox" id="toggleB" v-model="employee.hourly_pay_functionality" class="sr-only">
                                <div class="block bg-gray-600 w-8 h-5 rounded-full"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-3 h-3 rounded-full transition"></div>
                            </div>
                        </label>
                    </div>
                    
                    <div class="w-full mb-3 mb-3">
                        <!-- <label class="mr-1"></label>
                        <input type="checkbox" v-model="employee.is_digital_delivery"> -->
                        <label for="toggleC" class="flex items-center cursor-pointer">
                            <div>Allow Digital Delivery</div>
                            <div class="relative ml-3">
                                <input type="checkbox" id="toggleC" v-model="employee.is_digital_delivery" class="sr-only">
                                <div class="block bg-gray-600 w-8 h-5 rounded-full"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-3 h-3 rounded-full transition"></div>
                            </div>
                        </label>
                    </div>

                    <div class="w-full mb-3 mb-3">
                        <label for="toggleD" class="flex items-center cursor-pointer">
                            <div>Include Middle Wages Top Box Score?</div>
                            <div class="relative ml-3">
                                <input type="checkbox" id="toggleD" v-model="employee.is_middle_wages_top_box" class="sr-only">
                                <div class="block bg-gray-600 w-8 h-5 rounded-full"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-3 h-3 rounded-full transition"></div>
                            </div>
                        </label>
                    </div>

                    <div class="w-full mb-3 mb-3">
                        <label class="mr-1">Digital Delivery ID</label>
                        <input type="text" v-model="employee.digital_delivery_value"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>

                    <div class="w-full mb-3 mb-3">
                        <label class="mb-1">Supervisor</label>
                        <input name="supervisor" type="text" v-model="employee.supervisor"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>

                    <div class="flex flex-wrap -mx-2.5 mb-3">
                        <div class="lg:w-1/2 w-full px-2.5 mb-3 lg:mb-0">
                            <label class="mb-1">Address Line 1</label>
                            <input name="address_line_1" type="text" v-model="employee.address_line_1"
                                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">Address Line 2</label>
                            <input name="address_line_2" type="text" v-model="employee.address_line_2"
                                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-4 mb-3">
                        <div class="md:w-1/3 w-full px-4 mb-3 lg:mb-0">
                            <label class="mb-1">City</label>
                            <input name="city" type="text" v-model="employee.city"
                                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="md:w-1/3 w-full px-4">
                            <label class="mb-1">State</label>
                            <select name="state" v-model="employee.state" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                                <option value=""></option>
                                <option value="">--------USA--------</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="DE">Delaware</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                                <option value="">-------CANADA-------</option>
                                <option value="AB">Alberta</option>
                                <option value="BC">British Columbia</option>
                                <option value="MB">Manitoba</option>
                                <option value="NB">New Brunswick</option>
                                <option value="NL">Newfoundland and Labrador</option>
                                <option value="NT">Northwest Territories</option>
                                <option value="NS">Nova Scotia</option>
                                <option value="NU">Nunavut</option>
                                <option value="ON">Ontario</option>
                                <option value="PE">Prince Edward Island</option>
                                <option value="QC">Quebec</option>
                                <option value="SK">Saskatchewan</option>
                                <option value="YT">Yukon</option>
                            </select>
                        </div>
                        <div class="md:w-1/3 w-full px-4 mb-3 md:mb-0">
                            <label class="mb-1">Zip Code</label>
                            <input name="zip" type="text" v-model="employee.zip"
                                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-4 justify-end">
                        <a href="#" v-on:click="filladdress"
                            class="rounded px-3 py-1.5 leading-4 text-center hover:bg-zinc-600 bg-zinc-500 text-white font-sans font-bold text-md">Use
                            Company Address</a>
                    </div>
                    <div class="w-full mb-3">
                        <label class="mb-1">Group/Department</label>
                        <input name="department" type="text" v-model="employee.group"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="w-full mb-3">
                        <label class="mb-1">Descriptive Qualifier</label>
                        <input name="closing" type="text" v-model="employee.mid_year_event"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        <p class="cpation text-black text-sm mb-10">e.g. 'Mid-year hire date', 'Mid-year promotion',
                            'Disability leave'</p>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="relative overflow-x-auto md:overflow-visible">
                        <div v-for="(benefit_type, benefit_type_index) in benefit_types" :key="benefit_type" class="mt-8">
                            <h3 v-if="benefit_type.show_benefit_type && benefit_type.id != 10 || (benefit_type.id == 10 && employee.hourly_pay_functionality)" class="text-xl text-black mb-2" v-html="benefit_type.name"></h3>

                            <div v-if="benefit_type.show_benefit_type && benefit_type.id != 10 || (benefit_type.id == 10 && employee.hourly_pay_functionality)" class="relative overflow-x-auto md:overflow-visible">
                                <table :id="'items' + benefit_type_index"
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead>
                                        <tr>
                                            <!-- <th>Show</th> -->
                                            <th scope="col" class="px-2 py-3">{{benefit_type.sub_heading || 'Benefit Name'}}</th>
                                            <th v-if="benefit_type.id != 4" scope="col" class="px-2 py-3">Employer</th>
                                            <th v-if="benefit_type.id != 4" scope="col" class="px-2 py-3">Employee</th>
                                        </tr>
                                    </thead>
                                    <tbody :data-pos="benefit_index" :data-benefit_id="benefit.id"
                                        :data-benefittype="benefit_type.id"
                                        v-for="(benefit, benefit_index) in benefit_type.benefits" :key="benefit">
                                        <tr v-if="benefit.show && ( ! employee.hourly_pay_functionality || (employee.hourly_pay_functionality && ! base_pay_benefits.includes(benefit.id)) )">
                                            <!-- <td data-label="Show" class="px-2 py-2">
                                                <input type="checkbox" v-model="benefit.show" :value="1" />
                                            </td> -->
                                            <td data-label="Benefit Name" class="px-2 py-2">
                                                
                                                {{ benefit.benefit_custom_name && benefit.benefit_custom_name != '' ? benefit.benefit_custom_name : benefit.name }}

                                                <p v-if="parseInt(year_option) == parseInt(benefit.id)">
                                                <input v-if="parseInt(year_option) == parseInt(benefit.id)" type="RADIO" name="year_type" class="year_type" value="C" checked="">This Year
                                                <br v-if="parseInt(year_option) == parseInt(benefit.id)">
                                                <input v-if="parseInt(year_option) == parseInt(benefit.id)" type="RADIO" name="year_type" class="year_type" value="L">Last Year
                                                </p>
                                            </td>
                                            <td data-label="Employee" class="px-2 py-2">
                                                <div class="flex">
                                                    <div v-if="benefit.calculator && benefit.calculator != 'NULL' && benefit.calculator != '' && benefit.calculator != '0'" class="relative -ml-9 mr-3" >
                                                        <!-- Calculator Image  -->
                                                        <svg v-on:click="vueCalculate(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6 mr-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                        </svg>

                                                        <!-- BEGIN - State Unemployment -->
                                                        <table class="z-10 border-lbrwnclr border" v-if="calcPop === benefit.id && 12 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;">
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2">
                                                                        <b>S.U.T.A. Calculator</b><br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Total Wages<br>(this employee):</td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Wages'" size="8" onblur="this.value=(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Wage Limit /<br>Cut-off for SUTA:</td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_WageLimit'" size="8" onblur="this.value=(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">SUTA Rate:</td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Rate'" size="4" onblur="" value=""> %
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border"><i>Result:</i></td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;">
                                                                        <button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1"><b>Calculate</b></button>
                                                                        <button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- END - State Unemployment -->

                                                        <!-- BEGIN - 401K Calculator -->
                                                        <table v-if="calcPop === benefit.id && 9 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;" class="z-10 border-lbrwnclr border" >
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2">
                                                                        <b>401K Calculator</b><br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Total Annual Pay<br>(this employee):</td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Pay'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Match Limit<br>(% of Total Pay):</td>
                                                                    <td style="font-size:8pt;"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_MatchLimit'" size="4" onblur="" value=""> %</td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Match(Rate)</td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Rate'" size="4" onblur="" value=""> %</td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">employee(Contribution)</td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_EmployeeContrib'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border"><i>Employer Contribution:</i></td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;">
                                                                        <button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1"><b>Calculate</b></button>
                                                                        <button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--  END  - 401K Calculator -->

                                                        <!-- BEGIN - Worker's Compensation Calculator -->
                                                        <table v-if="calcPop === benefit.id && 13 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;" class="z-10 border-lbrwnclr border" >
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2">
                                                                        <b>Worker's Compensation</b>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Total Wages <br>(this employee): </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Wages'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Wage Limit / <br>Cut-off for WC: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_WageLimit'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Estimated Premium:</td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_EstimatedPremium'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Manual Premium:</td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_ManualPremium'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">
                                                                        <b>Select this employee's class:</b>
                                                                        <br>
                                                                        <select class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_JobClassSelect'" v-on:change="Function_13_CalcForm_JobClassSelect_onchange($event);" style="width:100%;">
                                                                            <option value=""></option>
                                                                            <option value="">No presets available.</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">
                                                                        <b>Or, enter a class manually:</b>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="left" style="font-size:8pt;">Job Class: <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_JobClass'" size="10" onblur="" maxlength="15" value="">
                                                                    </td>
                                                                    <td style="font-size:8pt;">Rate: <br>
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Rate'" size="4" onblur="" value=""> %
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">e.g., Sales</td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <i>Result:</i>
                                                                    </td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;">
                                                                        <button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1"><b>Calculate</b>
                                                                        </button>
                                                                        <button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div v-if="calcPop === benefit.id && 13 == benefit.id" :id="benefit.id + '_CalcForm_Help'" align="left" style="width: 173px;background-color:#fff;z-index:99; padding: 5px; position: absolute; left: -180px; top: 390px; font-size: 8pt; line-height: 95%; visibility: visible;" class="border-lbrwnclr border">
                                                            <b style="font-size:10pt;">Worker's Compensation Help</b>
                                                            <br>&nbsp; <br>
                                                            <i>The following is a strategy for entering per-employee data for Worker's Comp (WC).</i>
                                                            <br>
                                                            <ol style="margin:10px; margin-left:30px; margin-right:0px;">
                                                                <li>Identify your last total Estimated Premium (the bottom line on your WC statement) and enter it in the WC calculator.</li>
                                                                <li>Identify your company's Manual Premium and enter it in the WC calculator. (This is the amount of premium before any adjustments.)</li>
                                                                <li>Identify all Job Classes used by your company and each of their rates. Enter each job class and rate into the calculator as needed.</li>
                                                            </ol>COMPackage will then calculate the WC employer contribution when you click 'Calculate!' <br>&nbsp; <br>
                                                            <b>CAUTION:</b> Do NOT average Total Worker's Comp cost by Total Number of Employees. Rates for classifications vary so greatly that you might skew this benefit cost too greatly. <br>&nbsp; <br>
                                                            <input :id="benefit.id + '_CalcForm_Help_DoNotShow'" onclick="if (this.checked) {document.Form1.Var_CalcForm_WC_HideHelp.value = '1';} else {document.Form1.Var_CalcForm_WC_HideHelp.value = '0';}" type="checkbox">
                                                            <label :for="benefit.id + '_CalcForm_Help_DoNotShow'">Do not show this message again.</label>
                                                            <br>
                                                        </div>
                                                        <!--  END  - Worker's Compensation Calculator -->

                                                        <!-- BEGIN - Holiday Time Off Calculator -->
                                                        <table v-if="calcPop === benefit.id && 14 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;" class="z-10 border-lbrwnclr border" >
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2">
                                                                        <b>Holiday Calculator</b>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Yearly Pay <br>(this employee): </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Pay'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"># of Work Days <br>in a Year: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_WorkDays'" size="4" onblur="" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"># of Paid <br>Days Off: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_DaysOff'" size="4" onblur="" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <i>Result:</i>
                                                                    </td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;">
                                                                        <button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1">
                                                                        <b>Calculate</b>
                                                                        </button>
                                                                        <button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--  END  - Holiday Time Off Calculator -->

                                                        <!-- BEGIN - Sick Time Off Calculator -->
                                                        <table v-if="calcPop === benefit.id && 15 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;" class="z-10 border-lbrwnclr border" >
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2">
                                                                        <b>Sick Time Calculator</b>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Yearly Pay <br>(this employee): </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Pay'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"># of Work Days <br>in a Year: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_WorkDays'" size="4" onblur="" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"># of Paid <br>Days Off: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_DaysOff'" size="4" onblur="" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <i>Result:</i>
                                                                    </td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;">
                                                                        <button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1">
                                                                        <b>Calculate</b>
                                                                        </button>
                                                                        <button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--  END  - Sick Time Off Calculator -->

                                                        <!-- BEGIN - Vaction Time Off Calculator -->
                                                        <table v-if="calcPop === benefit.id && 16 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;" class="z-10 border-lbrwnclr border" >
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2">
                                                                        <b>Vacation Calculator</b>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;">Yearly Pay <br>(this employee): </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Pay'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"># of Work Days <br>in a Year: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_WorkDays'" size="4" onblur="" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"># of Paid <br>Days Off: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_DaysOff'" size="4" onblur="" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <i>Result:</i>
                                                                    </td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;">
                                                                        <button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1">
                                                                        <b>Calculate</b>
                                                                        </button>
                                                                        <button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--  END  - Vaction Time Off Calculator -->

                                                        <!-- BEGIN - Health Insurance Calculator -->
                                                        <table v-if="calcPop === benefit.id && 23 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;" class="z-10 border-lbrwnclr border" >
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2">
                                                                        <b>Health Insurance</b>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> # of Payrolls <br>in a Year: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Payrolls'" size="6" onblur="" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> Employer Per-Pay <br>Costs: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_PerPayCost'" size="6" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> Employee Per-Pay <br>Costs: </td>
                                                                    <td style="font-size:8pt;">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_EmployeePPC'" size="6" onblur="this.value=nf(this.value);" value="" disabled="" style="background-color: rgb(204, 204, 204);">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">
                                                                        <b>Select this employee's Census:</b>
                                                                        <br>
                                                                        <select class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_CensusSelect'" v-on:change="Function_23_CalcForm_CensusSelect_onchange($event);" style="width:100%;">
                                                                            <option value="">Select Census</option>
                                                                            <option value="Single | 26 | $100 | $110">Single | 26 | $100 | $110</option>
                                                                            <option value="Married | 26 | $555 | $111">Married | 26 | $555 | $111</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">
                                                                        <b>Or, enter a Census manually:</b>
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="3" align="left" style="font-size:8pt;">Census:<input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Census'" size="21" onblur="" maxlength="50" value="" style="width:120px;">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">i.e. married with children</td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <i>Employer Result:</i>
                                                                    </td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=nf(this.value);" value="">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <i>Employee Result:</i>
                                                                    </td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border">
                                                                        <input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result2'" size="8" onblur="this.value=nf(this.value);" value="" style="background-color: rgb(204, 204, 204);">
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;">
                                                                        <button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1">
                                                                    <b>Calculate</b>
                                                                        </button>
                                                                        <button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div v-if="calcPop === benefit.id && 23 == benefit.id" :id="benefit.id + '_CalcForm_Help'" align="left" style="width: 173px;background-color:#fff;z-index:99; padding: 5px; position: absolute; left: -180px; top: 390px; font-size: 8pt; line-height: 95%;visibility: visible;" class="border-lbrwnclr border">
                                                            <!-- <b style="font-size:10pt;">Health Insurance Help</b>
                                                            <br>&nbsp; <br>
                                                            <i>The following is a strategy for entering per-employee data for Health Insurance (HI).</i>
                                                            <br>
                                                            <ol style="margin:10px; margin-left:30px; margin-right:0px;">
                                                                <li>Identify the Number of Payrolls your Employee Recieves In a Year. i.e. If a company pays once per month, this would be 12</li>
                                                                <li>Identify how much your company puts in per pay.</li>
                                                                <li>Identify how much your employee puts in per pay</li>
                                                                <li>Identify all Censuses used by your company. Enter each Census into the calculator as needed.</li>
                                                            </ol>COMPackage will then calculate the HI employer contribution and employee contribution when you click 'Calculate!' <br>&nbsp; <br>
                                                            <br> -->
                                                            <b style="font-size:10pt;">Health Insurance Help</b><br>&nbsp;<br>
                                                            <p>Here is a strategy for entering per-employee data for Health Insurance:</p><br>
                                                            <p>Identify the # of Payrolls in a Year. E.g., if a company pays bi-weekly use 26.</p><br>
                                                            <p>Fill in the other fields.</p><br>
                                                            <p>Note that any amount you choose for each family Census category will be saved as a default for the next employee(s) with the same Census.</p><br>
                                                            <p>Click Calculate to get the calculated values.</p>
                                                        </div>
                                                        <!--  END  - Health Insurance Calculator -->

                                                        <!-- BEGIN - Dental Insurance Calculator -->
                                                        <table v-if="calcPop === benefit.id && 24 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;" class="z-10 border-lbrwnclr border" >
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2"><b>Dental Insurance</b><br></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> # of Payrolls<br>in a Year:</td>
                                                                    <td style="font-size:8pt;"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Payrolls'" size="6" onblur="" value=""></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> Employer Per-Pay <br>Costs: </td>
                                                                    <td style="font-size:8pt;"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_PerPayCost'" size="6" onblur="this.value=nf(this.value);" value=""></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> Employee Per-Pay <br>Costs: </td>
                                                                    <td style="font-size:8pt;"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_EmployeePPC'" size="6" onblur="this.value=nf(this.value);" value="" disabled="" style="background-color: rgb(204, 204, 204);"></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">
                                                                        <b>Select this employee's Census:</b><br>
                                                                        <select class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_CensusSelect'" v-on:change="Function_24_CalcForm_CensusSelect_onchange($event);" style="width:100%;">
                                                                        <option value="">Select Census</option>
                                                                        <option value="Single |  | $ | $">Single |  | $ | $</option>
                                                                        <option value="Married |  | $ | $">Married |  | $ | $</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;"><b>Or, enter a Census manually:</b><br></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="3" align="left" style="font-size:8pt;">Census:<input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Census'" size="21" onblur="" maxlength="50" value="" style="width:120px;"></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">i.e.  married with children</td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border"><i>Employer Result:</i></td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=nf(this.value);" value=""></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border"><i>Employee Result:</i></td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border"><input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result2'" size="8" onblur="this.value=nf(this.value);" value="" style="background-color: rgb(204, 204, 204);"></td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;"><button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1"><b>Calculate</b></button><button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div v-if="calcPop === benefit.id && 24 == benefit.id" :id="benefit.id + '_CalcForm_Help'" align="left" style="width: 173px; background-color:#fff;z-index:99;padding: 5px; position: absolute; left: -180px; top: 390px; font-size: 8pt; line-height: 95%;visibility: visible;" class="border-lbrwnclr border">
                                                            <b style="font-size:10pt;">Dental Insurance Help</b><br>&nbsp;<br>
                                                            <p>Here is a strategy for entering per-employee data for Dental Insurance:</p><br>
                                                            <p>Identify the # of Payrolls in a Year. E.g., if a company pays bi-weekly use 26.</p><br>
                                                            <p>Fill in the other fields.</p><br>
                                                            <p>Note that any amount you choose for each family Census category will be saved as a default for the next employee(s) with the same Census.</p><br>
                                                            <p>Click Calculate to get the calculated values.</p>
                                                            <!-- <ol style="margin:10px; margin-left:30px; margin-right:0px;">
                                                                <li>Identify the Number of Payrolls your Employee Recieves In a Year.  i.e. If a company pays once per month, this would be 12</li>
                                                                <li>Identify how much your company puts in per pay.</li>
                                                                <li>Identify how much your employee puts in per pay</li>
                                                                <li>Identify all Censuses used by your company. Enter each Census into the calculator as needed.</li>
                                                            </ol>
                                                            COMPackage will then calculate the DI employer contribution and employee contribution when you click 'Calculate!' -->
                                                        </div>
                                                        <!--  END  - Dental Insurance Calculator -->

                                                        <!-- BEGIN - Dental Insurance Calculator -->
                                                        <table v-if="calcPop === benefit.id && 25 == benefit.id" width="173" border="0" cellpadding="3" cellspacing="0" style="position:absolute; left:-180px; top:10px;" class="z-10 border-lbrwnclr border" >
                                                            <tbody>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2"><b>Vision Insurance</b><br></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> # of Payrolls<br>in a Year:</td>
                                                                    <td style="font-size:8pt;"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Payrolls'" size="6" onblur="" value=""></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> Employer Per-Pay <br>Costs: </td>
                                                                    <td style="font-size:8pt;"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_PerPayCost'" size="6" onblur="this.value=nf(this.value);" value=""></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;"> Employee Per-Pay <br>Costs: </td>
                                                                    <td style="font-size:8pt;"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_EmployeePPC'" size="6" onblur="this.value=nf(this.value);" value="" disabled="" style="background-color: rgb(204, 204, 204);"></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">
                                                                        <b>Select this employee's Census:</b><br>
                                                                        <select class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_CensusSelect'" v-on:change="Function_25_CalcForm_CensusSelect_onchange($event);" style="width:100%;">
                                                                        <option value="">Select Census</option>
                                                                        <option value="Single |  | $ | $">Single |  | $ | $</option>
                                                                        <option value="Married |  | $ | $">Married |  | $ | $</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;"><b>Or, enter a Census manually:</b><br></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="3" align="left" style="font-size:8pt;">Census:<input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Census'" size="21" onblur="" maxlength="50" value="" style="width:120px;"></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td colspan="2" align="left" style="font-size:8pt;">i.e.  married with children</td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border"><i>Employer Result:</i></td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border"><input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result'" size="8" onblur="this.value=nf(this.value);" value=""></td>
                                                                </tr>
                                                                <tr class="bg-neutral-100 text-black">
                                                                    <td align="right" style="font-size:8pt;" class="border-lbrwnclr border"><i>Employee Result:</i></td>
                                                                    <td style="font-size:8pt;" class="border-lbrwnclr border"><input disabled="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 rounded px-1 bg-white" :id="benefit.id + '_CalcForm_Result2'" size="8" onblur="this.value=nf(this.value);" value="" style="background-color: rgb(204, 204, 204);"></td>
                                                                </tr>
                                                                <tr class="bg-zinc-500 text-white">
                                                                    <td align="center" colspan="2" style="color:#FFFFFF;"><button v-on:click="calculateFromCalc(benefit.id, benefit.id + '_empoyer_benefit', benefit.id + '_empoyee_benefit', benefit_type_index, benefit_index)" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border hover:bg-white hover:text-zinc-500 border-white rounded mr-1"><b>Calculate</b></button><button v-on:click="closePopup" type="button" class="leading-3 text-xs px-1.5 py-1 font-bold inline-block border border-white rounded hover:bg-white hover:text-zinc-500">Close</button></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div v-if="calcPop === benefit.id && 25 == benefit.id" :id="benefit.id + '_CalcForm_Help'" align="left" style="width: 173px;background-color:#fff;z-index:99; padding: 5px; position: absolute; left: -180px; top: 390px; font-size: 8pt; line-height: 95%;visibility: visible;" class="border-lbrwnclr border bg-neutral-100 text-black">
                                                            <!-- <b style="font-size:10pt;">Vision Insurance Help</b><br>&nbsp;<br><i>The following is a strategy for entering per-employee data for Vision Insurance.</i><br>
                                                            <ol style="margin:10px; margin-left:30px; margin-right:0px;">
                                                                <li>Identify the Number of Payrolls your Employee Recieves In a Year.  i.e. If a company pays once per month, this would be 12</li>
                                                                <li>Identify how much your company puts in per pay.</li>
                                                                <li>Identify how much your employee puts in per pay</li>
                                                                <li>Identify all Censuses used by your company. Enter each Census into the calculator as needed.</li>
                                                            </ol>
                                                            COMPackage will then calculate the Vision Insurance employer contribution and employee contribution when you click 'Calculate!' -->
                                                            <b style="font-size:10pt;">Vision Insurance Help</b><br>&nbsp;<br>
                                                            <p>Here is a strategy for entering per-employee data for Vision Insurance:</p><br>
                                                            <p>Identify the # of Payrolls in a Year. E.g., if a company pays bi-weekly use 26.</p><br>
                                                            <p>Fill in the other fields.</p><br>
                                                            <p>Note that any amount you choose for each family Census category will be saved as a default for the next employee(s) with the same Census.</p><br>
                                                            <p>Click Calculate to get the calculated values.</p>
                                                        </div>
                                                        <!--  END  - Dental Insurance Calculator -->
                                                    </div>
                                                    <span v-if="benefit_type.id != 4" class="flex items-center w-full">
                                                        <span class="mr-3 w-[7px]" v-if="benefit_type.id != 7" >{{(! benefit.hourly_hours) ? full_company.currency_symbol || '$': ''}}</span>
                                                        <input v-model="benefit.employer_default_value" name="" type="number" max="10000000" step=".01"
                                                            :id="benefit.id + '_empoyer_benefit'"
                                                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                                                    </span>
                                                </div>
                                            </td>
                                            <td data-label="Employee" class="px-2 py-2">
                                                <span v-if="benefit_type.id != 4 && benefit_type.id != 7" class="flex items-center">
                                                    <!-- <span class="mr-3">{{ full_company.currency_symbol || '$' }}</span> -->
                                                    <span class="mr-3 w-[7px]" v-if="benefit_type.id != 7" >{{(! benefit.hourly_hours) ? full_company.currency_symbol || '$': ''}}</span>
                                                    <input :disabled="! benefit.employee_co_pay" v-model="benefit.employee_default_value" type="number" max="10000000" step=".01"
                                                        :id="benefit.id + '_empoyee_benefit'"
                                                        :class="(! benefit.employee_co_pay) ? 'focus:outline-none text-gray-100 h-7 px-2.5 rounded bg-neutral-100 w-full form-control':'focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control'"
                                                        />
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-2.5 flex flex-wrap gap-4 justify-end">
                    <input
                        class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md"
                        type="submit" name="" value="Save" id="" />
                    <a :href="url + '/create-report?employee_id='+employee.id+'&exclude_emp='+this.exclude_employee_contributions" target="_blank" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Create PDF Report</a>
                    <a href="#" v-if="employee.is_digital_delivery" v-on:click="sendEmployeeALink"
                        class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" target="_blank">Send Employee a Link</a>
                </div>
            </div>
        </div>
        <!-- Loader -->
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt=""
                class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </form>
</template>
<script>
import Sortable from 'sortablejs';
export default {
    props: ['edit_employee', 'permissions', 'company', 'social_security', 'full_company'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            action: false,
            calcPop: false,
            active_el:0,
            showVdo: false,
            viewLoader: false,
            base_pay_benefits: [1,2,3],
            benefit_types: [
                {
                    id: '',
                    name: '',
                    benefit: [
                        {
                            id: '',
                            name: '',
                            show: '',
                            additional_benefit_name: '',
                            employer_default_value: '',
                            employee_default_value: '',
                            category_id: ''
                        }
                    ]
                },
            ],
            employee: {
                firstname: '',
                lastname: '',
                employee_id: '',
                inactive: '',
                hourly_pay_functionality: '',
                is_digital_delivery: '',
                digital_delivery_value: '',
                supervisor: '',
                address_line_1: '',
                address_line_2: '',
                city: '',
                state: '',
                zip: '',
                department: '',
                mid_year_event: '',
                is_company_benefit: '',
                email: '',
                phone: '',
                is_middle_wages_top_box: '',
            },
            benefits_from: 'employee',
            benefits_to_be_deleted: [],
            /* Calculator fields */
            year_option: '07',
            health_census: '',
            dental_census: '',
            vision_census: '',
            Var_CalcForm_ID: '',
            Var_CalcForm_401K_MatchLimit: '',
            Var_CalcForm_401K_MatchRate: '',
            Var_CalcForm_SUTA_WageLimit: '',
            Var_CalcForm_SUTA_Rate: '',
            Var_CalcForm_TimeOff_WorkDays: '',
            Var_CalcForm_TimeOff_PaidHolidays: '',
            Var_CalcForm_Notify_NoAutoRecalc: '',
            S_13_JobClass: '',
            S_13_Rate: '',
            Var_CalcForm_WC_WageLimit: '',
            Var_CalcForm_WC_EstimatedPremium: '',
            Var_CalcForm_WC_ManualPremium: '',
            Var_CalcForm_WC_JobClasses: '',
            Var_CalcForm_WC_HideHelp: '',
            S_23_Census: '',
            S_23_Payrolls: '',
            S_23_PerPayCost: '',
            S_23_EmployeePPC: '',
            Var_CalcForm_HI_HideHelp: '',
            S_24_PerPayCost: '',
            S_24_EmployeePPC: '',
            Var_CalcForm_DI_HideHelp: '',
            S_25_PerPayCost: '',
            S_25_EmployeePPC: '',
            Var_CalcForm_VI_HideHelp: '',
            notifyNoAutoRecalc: false,
            exclude_employee_contributions: 'false'
        }
    },
    created() {
        if (this.edit_employee) {
            this.edit_employee.is_digital_delivery = this.edit_employee.is_digital_delivery ? true : false;
            this.edit_employee.inactive = this.edit_employee.inactive ? true : false;
            this.edit_employee.hourly_pay_functionality = this.edit_employee.hourly_pay_functionality ? true : false;
            this.edit_employee.is_middle_wages_top_box = this.edit_employee.is_middle_wages_top_box ? true : false;
            this.employee = this.edit_employee;
        }
        this.getBenefitsTypes();

        document.COMP_arrCustomTimeOffBenefits = Array();
        document.COMP_arrCustomTimeOffBenefitsReverseLookup = Array();

        this.health_census = this.full_company.health_census
        this.dental_census = this.full_company.dental_census
        this.vision_census = this.full_company.vision_census

        this.Var_CalcForm_HI_Census = this.health_census;
        this.Var_CalcForm_DI_Census = this.dental_census;
        this.Var_CalcForm_VI_Census = this.vision_census;
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('exclude_emp')) {
            this.exclude_employee_contributions = urlParams.get('exclude_emp');
        }
    },
    methods: {
        filladdress() {
            this.employee.address_line_1 = this.company.addr1;
            this.employee.address_line_2 = this.company.addr2;
            this.employee.city = this.company.city;
            this.employee.state = this.company.state;
            this.employee.zip = this.company.zip;
        },
        getBenefitsTypes() {
            let app = this;
            app.viewLoader = true;

            axios.get(app.url + '/webapp/employees/get-benefit-types?employee_id=' + app.employee.id).then((response) => {
                if (response.data.success) {
                    app.benefit_types = response.data.data.benefitTypes;

                    // Sorting the benefit based on order_sequence key
                    app.benefit_types.forEach((value, benefitTypesIndex) => {
                        app.sortByKey(benefitTypesIndex, 'order_sequence')
                    });

                    if (response.data.data.benefits_from) {
                        this.benefits_from = response.data.data.benefits_from;
                    }

                    app.initiateOrdering();
                } else {
                    showErrorMessage(response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                showErrorMessage(error);
                app.viewLoader = false;
            });
        },
        updateCompany(e) {
            e.preventDefault();
            let app = this;
            app.viewLoader = true;

            jQuery('select, input').removeClass('border-2 border-rose-600');

            let benefit_types_arr = Array();

            this.benefit_types.forEach((benefit_type, index) => {
                let benefits_arr = Array();
                benefit_type.benefits.forEach((benefit) => {
                    benefits_arr.push({
                        'additional_benefit_name': benefit.additional_benefit_name,
                        'employee_default_value': benefit.employee_default_value,
                        'employer_default_value': benefit.employer_default_value,
                        'id': benefit.id,
                        'name': benefit.name,
                        'show': benefit.show,
                        'category_id': benefit.category_id,
                        'can_categorize': benefit.can_categorize,
                        'order_sequence': (benefit.order_sequence + 1),
                    });
                })

                if (benefits_arr && benefits_arr.length > 0) {
                    benefit_types_arr.push({ 'id': benefit_type.id, 'name': benefit_type.name, 'benefits': benefits_arr });
                }
            });

            axios.post(app.url + '/webapp/employees/update/' + app.employee.id, { 'employee': app.employee, 'benefit_types': benefit_types_arr }).then((response) => {
                if (response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    // setTimeout(() =>location.reload(), 1000);
                    
                } else {
                    app.showFormError(response.data.data.key, response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        sendEmployeeALink(e) {
            e.preventDefault();
            let app = this;

            if (this.employee.email.trim() === '') 
            {
                alert("You must provide an email for each employee to whom you wish to delivery digitally.");
                return;
            }

            app.viewLoader = true;

            axios.post(app.url + '/webapp/employee/send-dd-instructions', { 'employee': app.employee,}).then((response) => {
                    if (response.data.success) {
                        showSuccessMessage(response.data.data.msg);
                    } else {
                        showErrorMessage(response.data.data.msg);
                    }
                    app.viewLoader = false;
                }).catch((error) => {
                    showErrorMessage("Something went wrong!");
                });
        },
        /* Show error message on the form */
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
            // moveUp();
        },
        addCustomBenefits(benefit_type_index, benefit_index) {
            let copiedObject = Object.assign({}, this.benefit_types[benefit_type_index].benefits[benefit_index])

            copiedObject.additional_benefit_name = "";
            copiedObject.employee_default_value = "0.00";
            copiedObject.employer_default_value = "0.00";
            copiedObject.id = 0;
            benefit_index += 1;
            copiedObject.name = "Custom Benefit " + (parseInt(benefit_index) + 1);


            this.benefit_types[benefit_type_index].benefits.push(copiedObject);
        },
        removeCustomBenefits(benefit_type_index, benefit_index) {
            this.benefits_to_be_deleted.push(this.benefit_types[benefit_type_index].benefits[benefit_index].id);
            this.benefit_types[benefit_type_index].benefits.splice(benefit_index, 1);
        },
        sortByKey(benefitTypesIndex, sortKey) {
            this.benefit_types[benefitTypesIndex].benefits = Object.values(this.benefit_types[benefitTypesIndex].benefits).sort((a, b) => a.order_sequence - b.order_sequence);
        },
        initiateOrdering() {
            let app = this;
            setTimeout(() => {
                this.benefit_types.forEach((value, index) => {
                    var el = document.getElementById('items' + index);
                    
                    var sortable = Sortable.create(el, {
                        handle: ".sortableColumn",
                        onChoose: function (evt) {
                            evt.item.style = 'background-color: rgb(229 231 235); border: 1px solid rgb(163 163 163);';  // element index within parent
                        },
                        onUnchoose: function (evt) {
                            evt.item.style = 'background-color: " "';  // element index within parent
                        },
                        onEnd: function (evt) {
                            app.viewLoader = true;
                            var oldIndex = evt.item.getAttribute("data-pos");
                            var benefit_id = evt.item.getAttribute("data-benefit_id");
                            var benefitType = evt.item.getAttribute("data-benefittype");
                            var newIndex = evt.newIndex;

                            console.log(oldIndex, benefitType, newIndex);

                            app.benefit_types.find((benefit_type) => {
                                if (benefit_type.id == benefitType ) {
                                    for( let i in benefit_type.benefits ) {
                                        if( oldIndex == i ) {
                                            let removed_benefit = benefit_type.benefits.splice(i, 1);
                                            benefit_type.benefits.splice((newIndex-1), 0, removed_benefit[0])
                                        }
                                    }
                                }
                            });
                            // return false;
                            axios.post( process.env.MIX_API_URL + '/benefits/re-ordering', {
                                "oldIndex": oldIndex,
                                "newIndex": newIndex,
                                "benefitType": benefitType,
                                "benefit_id": benefit_id, 
                                "benefit_types": app.benefit_types,
                                "employee_id": app.employee.id
                            }).then((res) => {
                                app.viewLoader = false;
                                app.getBenefitsTypes();
                            });
                        }
                    });
                });
            }, 1000);
        },
        vueCalculate( id, employeer_id, employee_id, benefit_type_index, benefit_index ) {
            /**
             * benefit_id
             * employeer_id
             * employee_id
             */
            this.calculate( id, employeer_id, employee_id, benefit_type_index, benefit_index );
        },
        calculate(id, employer_id, employee_id, benefit_type_index, benefit_index) {
            // Show notification to user for the first time when they use auto-calculators.
            if ( ! this.notifyNoAutoRecalc ) {
                alert('IMPORTANT: After using the COMPackage calculators, please note that the values will NOT be automatically recalculated if you change the data in any of the Base Pay or Other Income fields.');
                this.notifyNoAutoRecalc = true;
            }
            console.log('123456789000000000000000ss0');
            var wages = this.getWages();
            switch ( id + '') {
                // DONE: Social Security case '31':
                case '7': // 07
                    var tempSS_wages = wages;
                    var tempSS_year = 168600;
                    var tempSS_rate_employee = 0.062;
                    var tempSS_rate_employer = 0.062;

                    //if ( jQuery(".year_type:checked").val() == 'C' ) {
                    //    tempSS_year             = this.social_security.social_security_this_year;
                    //    tempSS_rate_employee    = this.social_security.social_security_this_year_rate_employee;
                    //    tempSS_rate_employer    = this.social_security.social_security_this_year_rate_employer;
                    //} else {
                   //     tempSS_year             = this.social_security.social_security_last_year;
                   //     tempSS_rate_employee    = this.social_security.social_security_last_year_rate_employee;
                    //    tempSS_rate_employer    = this.social_security.social_security_last_year_rate_employer;
                   // }

                    if (tempSS_wages > tempSS_year) tempSS_wages = tempSS_year;
                    this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(tempSS_wages * tempSS_rate_employer));
                    this.setBenefitValues(benefit_type_index, benefit_index, 'employee', nf(tempSS_wages * tempSS_rate_employee));
                    
                break;
                
                // DONE: Medicare case '32':
                case '8': // 08
                    this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(wages * 0.0145));
                    this.setBenefitValues(benefit_type_index, benefit_index, 'employee', nf(wages * 0.0145));
                break;
                
                // DONE: Federal Unemployment case '35':
                case '11':
                    var tempFUTA_wages = wages;
                    if (tempFUTA_wages > 7000) tempFUTA_wages = 7000;
                    this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(tempFUTA_wages * 0.006));
                break;
                
                // DONE: Default
                default:
                    this.showCalc(id, employer_id, employee_id, benefit_type_index, benefit_index);
                break;
            }
        },
        getWages() {
            console.log('000000DWS0000000Karwa');
            var wages = 0;
            var tempNum = 0;
            var tempStr = '';
            var tempObj = null;
            tempObj = this.getTotal('total_wages');
            
            if (tempObj) {
                tempStr = tempObj;
                tempNum = parseFloat(tempStr);
                if (!isNaN(tempNum))
                    wages += tempNum;
            }

            return wages;
        },
        getTotal( key = '' ) {
            var total_pay = 0;
            var total_wages = 0;
            for( let benefit_type_t of this.benefit_types ) {
                for( let benefit_t of benefit_type_t.benefits) {
                    /*Pay and Other Income Start*/
                    if( this.edit_employee.hourly_pay_functionality == false && benefit_t && benefit_t.name == 'Salary' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                        total_pay = total_pay + parseFloat(benefit_t.employer_default_value);
                    }
                    if( this.edit_employee.hourly_pay_functionality == false && benefit_t && benefit_t.name == 'Hourly Wages' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                        total_pay = total_pay + parseFloat(benefit_t.employer_default_value);
                    }
                    if( this.edit_employee.hourly_pay_functionality == false && benefit_t && benefit_t.name == 'Overtime' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    /*Pay and Other Income END*/

                    /*COMMON START*/
                    if( benefit_t && benefit_t.name == 'Performance Bonus' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Annual Incentive' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Annual Bonus' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Holiday Bonus' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Draw' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Commissions' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Health Insurance Opt Out Pay' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Bereavement Time Off' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Vacation Paid, not taken' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Unused Sick Time' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Long Term Incentive' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Short Term Incentive' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Sunday Incentive' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Trainer Incentive' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Field Sales Incentive' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Sign-on Bonus' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Referral Bonus' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Market Differential' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Mid Shift Premium' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'On Call Service' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Night Service' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Shift Differential' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Garnishment Reimbursement' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Vaccination Validation Bonus' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'COVID-19 Supplemental Pay' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Military Active Duty' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Short Term Disability Pay' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    if( benefit_t && benefit_t.name == 'Jury Duty' ) {
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    /*COMMON END*/
                    
                    /*Hourly Pay Functionality END*/
                    if( this.edit_employee.hourly_pay_functionality == true && benefit_t && benefit_t.name == 'Regular Hours Total'){
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                        total_pay = total_pay + parseFloat(benefit_t.employer_default_value);
                    }
                    if( this.edit_employee.hourly_pay_functionality == true && benefit_t && benefit_t.name == 'Overtime Total'){
                        total_wages = total_wages + parseFloat(benefit_t.employer_default_value);
                    }
                    /*Hourly Pay Functionality END*/
                }
            }

            if( key == 'total_wages' ) {
                return total_wages;
            }
            if( key == 'total_pay' ) {
                return total_pay;
            }

            return 0;
        },
        showCalc(id, employer_id, employee_id, benefit_type_index, benefit_index) {
            if (document.getElementById) {
                var wages = this.getWages();
                var lastCalc = null;
                                
                var objCalcLoc = document.getElementById(id + '_Calc');
                
                switch (id + '')
                {
                    // DONE: 401K case '33':
                    case '9': //09
                        this.calcPop = 9;
                        setTimeout(() => {
                            document.getElementById(id + '_CalcForm_Pay').value = (this.getTotal('total_pay'));
                            document.getElementById(id + '_CalcForm_EmployeeContrib').value = (document.getElementById(employee_id).value);
                            document.getElementById(id + '_CalcForm_Result').value = '';
                            document.getElementById(id + '_CalcForm_MatchLimit').value = this.Var_CalcForm_401K_MatchLimit;
                            document.getElementById(id + '_CalcForm_Rate').value = this.Var_CalcForm_401K_MatchRate;

                            document.COMP_strLastCalc = id;
                        }, 10);
                    break;
                    
                    // DONE: State Unemployment case '36':
                    case '12':
                        this.calcPop = 12;
                        setTimeout(() => {
                            document.getElementById(id + '_CalcForm_Wages').value = nf(wages);
                            document.getElementById(id + '_CalcForm_Result').value = '';
                            document.getElementById(id + '_CalcForm_WageLimit').value = nf(this.Var_CalcForm_SUTA_WageLimit);
                            document.getElementById(id + '_CalcForm_Rate').value = nf(this.Var_CalcForm_SUTA_Rate);
                            
                            document.COMP_strLastCalc = id;
                        }, 10);
                        
                    break;

                    // DONE: Worker's Compensation case '37':
                    case '13':
                        this.calcPop = 13;
                        setTimeout(() => {
                            document.getElementById(id + '_CalcForm_Wages').value = nf(wages);
                            document.getElementById(id + '_CalcForm_WageLimit').value = nf(this.Var_CalcForm_WC_WageLimit);
                            document.getElementById(id + '_CalcForm_Result').value = '';
                            document.getElementById(id + '_CalcForm_EstimatedPremium').value = nf(this.Var_CalcForm_WC_EstimatedPremium);
                            document.getElementById(id + '_CalcForm_ManualPremium').value = nf(this.Var_CalcForm_WC_ManualPremium);
                            document.getElementById(id + '_CalcForm_JobClass').value = nf(this.S_13_JobClass);
                            document.getElementById(id + '_CalcForm_Rate').value = nf(this.S_13_Rate);
                            
                            var arrTemp = this.Var_CalcForm_WC_JobClasses.split('|');
                            document.getElementById(id + '_CalcForm_JobClassSelect').options.length = 0;
                            document.getElementById(id + '_CalcForm_JobClassSelect').options[0] = new Option('', '');

                            var splitTemp;
                            for (var i=0; i < arrTemp.length; i++) {
                                if (arrTemp[i] != '')
                                {
                                    splitTemp = arrTemp[i].split(';');
                                    document.getElementById(id + '_CalcForm_JobClassSelect').options[i+1] = new Option(splitTemp[0] + ' | ' + splitTemp[1] + '%', splitTemp[0] + ' | ' + splitTemp[1] + '%');
                                }
                            }

                            if (document.getElementById(id + '_CalcForm_JobClassSelect').options.length == 1) {
                                document.getElementById(id + '_CalcForm_JobClassSelect').options[i] = new Option('No presets available.', '');
                            }
                            
                            if (this.Var_CalcForm_WC_HideHelp == '1')
                                document.getElementById(id + '_CalcForm_Help').style.visibility = 'hidden';
                            else
                                document.getElementById(id + '_CalcForm_Help').style.visibility = 'visible';
                            
                            document.COMP_strLastCalc = id;
                        });
                    break;

                    // DONE: Holiday Time case '39':
                    case '14':
                    // DONE: Sick Time case '40':
                    case '15':
                    // DONE: Vaction Time case '41':
                    case '16':
                    case '45': //case '109':
                        this.calcPop = id;
                        setTimeout(() => {
                            document.getElementById(id + '_CalcForm_Pay').value = nf(this.getTotal('total_pay'));
                            document.getElementById(id + '_CalcForm_Result').value = '';
                            document.getElementById(id + '_CalcForm_WorkDays').value = nf(this.Var_CalcForm_TimeOff_WorkDays);
                            if (id == '14') document.getElementById(id + '_CalcForm_DaysOff').value = nf(this.Var_CalcForm_TimeOff_PaidHolidays);
                            
                            document.COMP_strLastCalc = id;
                        });
                    break;

                    // DONE: Health Insurance case '42':
                    case '23':
                        this.calcPop = 23;
                        // this.calcPop = 42;
                        setTimeout(() => {
                            
                            document.getElementById(id + '_CalcForm_Payrolls').value = nf(this.S_23_Payrolls);
                                
                            document.getElementById(id + '_CalcForm_PerPayCost').value = nf(this.S_23_PerPayCost);
                            
                            document.getElementById(id + '_CalcForm_EmployeePPC').value = nf(this.S_23_EmployeePPC);
                                
                            document.getElementById(id + '_CalcForm_Census').value = nf(this.S_23_Census);
                                
                            document.getElementById(id + '_CalcForm_Result').value = '';
                            
                            document.getElementById(id + '_CalcForm_Result2').value = '';

                            var arrTemp = this.Var_CalcForm_HI_Census.split('|');
                            document.getElementById( id + '_CalcForm_CensusSelect').options.length = 0;
                            document.getElementById( id + '_CalcForm_CensusSelect').options[0] = new Option('Select Census', '');
                            var splitTemp;
                            for (var i=0; i < arrTemp.length; i++)
                            {
                                if (arrTemp[i] != '')
                                {
                                    splitTemp = arrTemp[i].split(';');
                                    document.getElementById( id + '_CalcForm_CensusSelect').options[i+1] = new Option(splitTemp[0] + ' | ' + splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '', splitTemp[0] + ' | ' +  splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '');
                                }
                            }
                            if (document.getElementById( id + '_CalcForm_CensusSelect').options.length == 1)
                            {
                                document.getElementById( id + '_CalcForm_CensusSelect').options[i] = new Option('No presets available.', '');
                            }
                            
                            if (document.getElementById(employer_id).disabled == true)
                            {
                                document.getElementById( id + '_CalcForm_PerPayCost').disabled = true;
                                document.getElementById( id + '_CalcForm_Result').disabled = true;
                                document.getElementById( id + '_CalcForm_PerPayCost').style.backgroundColor = '#CCCCCC';
                                document.getElementById( id + '_CalcForm_Result').style.backgroundColor = '#CCCCCC';
                            }
                            else
                            {
                                document.getElementById( id + '_CalcForm_PerPayCost').disabled = false;
                                document.getElementById( id + '_CalcForm_Result').disabled = false;
                                document.getElementById( id + '_CalcForm_PerPayCost').style.backgroundColor = '';
                                document.getElementById( id + '_CalcForm_Result').style.backgroundColor = '';
                            }
                                
                            if (document.getElementById(employee_id).disabled == true)
                            {
                                document.getElementById( id + '_CalcForm_EmployeePPC').disabled = true;
                                document.getElementById( id + '_CalcForm_Result2').disabled = true;
                                document.getElementById( id + '_CalcForm_EmployeePPC').style.backgroundColor = '#CCCCCC';
                                document.getElementById( id + '_CalcForm_Result2').style.backgroundColor = '#CCCCCC';
                            }
                            else
                            {
                                document.getElementById( id + '_CalcForm_EmployeePPC').disabled = false;
                                document.getElementById( id + '_CalcForm_Result2').disabled = false;
                                document.getElementById( id + '_CalcForm_EmployeePPC').style.backgroundColor = '';
                                document.getElementById( id + '_CalcForm_Result2').style.backgroundColor = '';
                            }
                            
                            if (this.Var_CalcForm_HI_HideHelp == '1')
                                document.getElementById( id + '_CalcForm_Help').style.visibility = 'hidden';
                            else
                                document.getElementById( id + '_CalcForm_Help').style.visibility = 'visible';
                            
                            document.COMP_strLastCalc = id;
                        });
                    break;
                    
                    /* Dental Insurance DONE:  case '43':*/
                    case '24':
                        this.calcPop = 24;
                        // this.calcPop = 43;
                        setTimeout(() => {
                            document.getElementById(id + '_CalcForm_Payrolls').value = nf(this.S_23_Payrolls);
                                
                            document.getElementById(id + '_CalcForm_PerPayCost').value = nf(this.S_24_PerPayCost);
                            
                            document.getElementById(id + '_CalcForm_EmployeePPC').value = nf(this.S_24_EmployeePPC);
                                
                            document.getElementById(id + '_CalcForm_Census').value = nf(this.S_23_Census);
                                
                            document.getElementById(id + '_CalcForm_Result').value = '';
                            
                            document.getElementById(id + '_CalcForm_Result2').value = '';

                            var arrTemp = this.Var_CalcForm_DI_Census.split('|');
                            document.getElementById(id + '_CalcForm_CensusSelect').options.length = 0;
                            document.getElementById(id + '_CalcForm_CensusSelect').options[0] = new Option('Select Census', '');
                            var splitTemp;
                            for (var i=0; i < arrTemp.length; i++)
                            {
                                if (arrTemp[i] != '')
                                {
                                    splitTemp = arrTemp[i].split(';');
                                    document.getElementById(id + '_CalcForm_CensusSelect').options[i+1] = new Option(splitTemp[0] + ' | ' + splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '', splitTemp[0] + ' | ' +  splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '');
                                }
                            }
                            if (document.getElementById(id + '_CalcForm_CensusSelect').options.length == 1)
                            {
                                document.getElementById(id + '_CalcForm_CensusSelect').options[i] = new Option('No presets available.', '');
                            }
                            
                            if (document.getElementById(employer_id).disabled == true)
                            {
                                document.getElementById(id + '_CalcForm_PerPayCost').disabled = true;
                                document.getElementById(id + '_CalcForm_Result').disabled = true;
                                document.getElementById(id + '_CalcForm_PerPayCost').style.backgroundColor = '#CCCCCC';
                                document.getElementById(id + '_CalcForm_Result').style.backgroundColor = '#CCCCCC';
                            }
                            else
                            {
                                document.getElementById(id + '_CalcForm_PerPayCost').disabled = false;
                                document.getElementById(id + '_CalcForm_Result').disabled = false;
                                document.getElementById(id + '_CalcForm_PerPayCost').style.backgroundColor = '';
                                document.getElementById(id + '_CalcForm_Result').style.backgroundColor = '';
                            }
                                
                            if (document.getElementById(employee_id).disabled == true)
                            {
                                document.getElementById(id + '_CalcForm_EmployeePPC').disabled = true;
                                document.getElementById(id + '_CalcForm_Result2').disabled = true;
                                document.getElementById(id + '_CalcForm_EmployeePPC').style.backgroundColor = '#CCCCCC';
                                document.getElementById(id + '_CalcForm_Result2').style.backgroundColor = '#CCCCCC';
                            }
                            else
                            {
                                document.getElementById(id + '_CalcForm_EmployeePPC').disabled = false;
                                document.getElementById(id + '_CalcForm_Result2').disabled = false;
                                document.getElementById(id + '_CalcForm_EmployeePPC').style.backgroundColor = '';
                                document.getElementById(id + '_CalcForm_Result2').style.backgroundColor = '';
                            }
                            
                            if (this.Var_CalcForm_DI_HideHelp == '1')
                                document.getElementById(id + '_CalcForm_Help').style.visibility = 'hidden';
                            else
                                document.getElementById(id + '_CalcForm_Help').style.visibility = 'visible';
                            
                            document.COMP_strLastCalc = id;
                        });
                    break;

                    /* Vision Insurance DONE:  case '44':*/
                    case '25':
                        this.calcPop = 25;
                        // this.calcPop = 44;
                        setTimeout(() => {
                            
                            document.getElementById(id + '_CalcForm_Payrolls').value = nf(this.S_23_Payrolls);
                                
                            document.getElementById(id + '_CalcForm_PerPayCost').value = nf(this.S_25_PerPayCost);
                            
                            document.getElementById(id + '_CalcForm_EmployeePPC').value = nf(this.S_25_EmployeePPC);
                                
                            document.getElementById(id + '_CalcForm_Census').value = nf(this.S_23_Census);
                                
                            document.getElementById(id + '_CalcForm_Result').value = '';
                            
                            document.getElementById(id + '_CalcForm_Result2').value = '';

                            var arrTemp = this.Var_CalcForm_VI_Census.split('|');
                            document.getElementById(id + '_CalcForm_CensusSelect').options.length = 0;
                            document.getElementById(id + '_CalcForm_CensusSelect').options[0] = new Option('Select Census', '');
                            var splitTemp;
                            for (var i=0; i < arrTemp.length; i++)
                            {
                                if (arrTemp[i] != '')
                                {
                                    splitTemp = arrTemp[i].split(';');
                                    document.getElementById(id + '_CalcForm_CensusSelect').options[i+1] = new Option(splitTemp[0] + ' | ' + splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '', splitTemp[0] + ' | ' +  splitTemp[1] + ' | ' + '$' + splitTemp[2] + '' + ' | ' + '$' + splitTemp[3] + '');
                                }
                            }
                            if (document.getElementById(id + '_CalcForm_CensusSelect').options.length == 1)
                            {
                                document.getElementById(id + '_CalcForm_CensusSelect').options[i] = new Option('No presets available.', '');
                            }
                            
                            if (document.getElementById(employer_id).disabled == true)
                            {
                                document.getElementById(id + '_CalcForm_PerPayCost').disabled = true;
                                document.getElementById(id + '_CalcForm_Result').disabled = true;
                                document.getElementById(id + '_CalcForm_PerPayCost').style.backgroundColor = '#CCCCCC';
                                document.getElementById(id + '_CalcForm_Result').style.backgroundColor = '#CCCCCC';
                            }
                            else
                            {
                                document.getElementById(id + '_CalcForm_PerPayCost').disabled = false;
                                document.getElementById(id + '_CalcForm_Result').disabled = false;
                                document.getElementById(id + '_CalcForm_PerPayCost').style.backgroundColor = '';
                                document.getElementById(id + '_CalcForm_Result').style.backgroundColor = '';
                            }
                                
                            if (document.getElementById(employee_id).disabled == true)
                            {
                                document.getElementById(id + '_CalcForm_EmployeePPC').disabled = true;
                                document.getElementById(id + '_CalcForm_Result2').disabled = true;
                                document.getElementById(id + '_CalcForm_EmployeePPC').style.backgroundColor = '#CCCCCC';
                                document.getElementById(id + '_CalcForm_Result2').style.backgroundColor = '#CCCCCC';
                            }
                            else
                            {
                                document.getElementById(id + '_CalcForm_EmployeePPC').disabled = false;
                                document.getElementById(id + '_CalcForm_Result2').disabled = false;
                                document.getElementById(id + '_CalcForm_EmployeePPC').style.backgroundColor = '';
                                document.getElementById(id + '_CalcForm_Result2').style.backgroundColor = '';
                            }
                            
                            if (this.Var_CalcForm_VI_HideHelp == '1')
                                document.getElementById(id + '_CalcForm_Help').style.visibility = 'hidden';
                            else
                                document.getElementById(id + '_CalcForm_Help').style.visibility = 'visible';
                            
                            document.COMP_strLastCalc = id;
                        });
                    break;
                            
                    default:
                        // Check for custom Time Off Calculator
                        if (document.COMP_arrCustomTimeOffBenefits[id] && lastCalc != id && objCalcLoc && objCalcLoc.style != null)
                        {
                            objCalcLoc.style.visibility = 'visible';
                            
                            document.getElementById(id + '_CalcForm_Pay').value = nf(getPay());
                            document.getElementById(id + '_CalcForm_Result').value = '';
                            document.getElementById(id + '_CalcForm_WorkDays').value = this.Var_CalcForm_TimeOff_WorkDays;
                            if (id == '14') document.getElementById(id + '_CalcForm_DaysOff').value = this.Var_CalcForm_TimeOff_PaidHolidays;
                            
                            document.COMP_strLastCalc = id;
                        }
                    break;
                }
                
            }
        },
        closePopup() {
            this.calcPop = false;
        },
        calculateFromCalc(id, employer_id, employee_id, benefit_type_index, benefit_index)
        {
            if (document.getElementById)
            {
                var matchLimit, employeeContrib;
                var wages, tempWages, wageLimit, rate, result;
                var pay, workDays, daysOff;
                var errMsg = '';
                
                switch (id + '')
                {
                    /* 401K DONE: case '33':*/
                    case '9': // 09
                        // Validate
                        
                        pay = document.getElementById(id+'_CalcForm_Pay').value;
                        pay = pay.replace('$', '');
                        pay = pay.replace(',', '');
                        pay = parseFloat(pay);
                        if (isNaN(pay) || pay < 0)
                            errMsg += '- The Pay Field must contain a number and it cannot be negative.\n';
                        
                        matchLimit = document.getElementById(id+'_CalcForm_MatchLimit').value;
                        matchLimit = matchLimit.replace('$', '');
                        matchLimit = matchLimit.replace(',', '');
                        matchLimit = parseFloat(matchLimit);
                        if (isNaN(matchLimit) || matchLimit < 0)
                            errMsg += '- The Match Limit Field must contain a number and it cannot be negative.\n';
                        else
                            document.getElementById(id+'_CalcForm_MatchLimit').value = matchLimit;
                        
                        rate = document.getElementById(id+'_CalcForm_Rate').value;
                        rate = rate.replace('$', '');
                        rate = rate.replace(',', '');
                        rate = parseFloat(rate);
                        if (isNaN(rate) || rate < 0)
                            errMsg += '- The Match Rate Field must contain a number and it cannot be negative.\n';
                        else
                            document.getElementById(id+'_CalcForm_Rate').value = rate;
                        
                        employeeContrib = document.getElementById(id+'_CalcForm_EmployeeContrib').value;
                        employeeContrib = employeeContrib.replace('$', '');
                        employeeContrib = employeeContrib.replace(',', '');
                        employeeContrib = parseFloat(employeeContrib);
                        if (isNaN(employeeContrib) || employeeContrib < 0)
                            errMsg += '- The Employee Contribution Field must contain a number and it cannot be negative.\n';
                        
                        
                        // Calculate
                        if (errMsg == '')
                        {
                            result = employeeContrib * (rate/100);
                            if ( result > pay * (matchLimit/100) ) result = pay * (matchLimit/100);
                            document.getElementById(id+'_CalcForm_Result').value = nf(result);
                            this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(result));
                            this.setBenefitValues(benefit_type_index, benefit_index, 'employee', nf(employeeContrib));
                            this.Var_CalcForm_401K_MatchLimit = matchLimit;
                            this.Var_CalcForm_401K_MatchRate = rate;
                        }
                    break;
                    
                    /* State Unemployment DONE: */
                    case '12':
                        
                        // Validate
                        
                        wages = document.getElementById('12_CalcForm_Wages').value;
                        wages = wages.replace('$', '');
                        wages = wages.replace(',', '');
                        wages = parseFloat(wages);
                        if (isNaN(wages) || wages < 0)
                            errMsg += '- The Wages Field must contain a number and it cannot be negative.\n';
                        
                        wageLimit = document.getElementById('12_CalcForm_WageLimit').value;
                        wageLimit = wageLimit.replace('$', '');
                        wageLimit = wageLimit.replace(',', '');
                        wageLimit = parseFloat(wageLimit);
                        if (isNaN(wageLimit) || wageLimit < 0)
                            errMsg += '- The Wage Limit Field must contain a number and it cannot be negative.\n';
                        
                        rate = document.getElementById('12_CalcForm_Rate').value;
                        rate = rate.replace('$', '');
                        rate = rate.replace(',', '');
                        rate = parseFloat(rate);
                        if (isNaN(rate) || rate < 0)
                            errMsg += '- The Rate Field must contain a number and it cannot be negative.\n';
                        else
                            document.getElementById('12_CalcForm_Rate').value = rate;
                        
                        
                        // Calculate
                        if (errMsg == '')
                        {
                            tempWages = wages;
                            if (tempWages > wageLimit) tempWages = wageLimit;
                            result = tempWages * (rate/100);
                            document.getElementById('12_CalcForm_Result').value = nf(result);
                            // document.getElementById(employer_id).value = (result);
                            this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(result));
                            this.Var_CalcForm_SUTA_WageLimit = wageLimit;
                            this.Var_CalcForm_SUTA_Rate = rate;
                        }
                    break;
                    
                    /* Worker's Compensation DONE:*/
                    case '13':
                        
                        // Validate
                        
                        wages = document.getElementById('13_CalcForm_Wages').value;
                        wages = wages.replace('$', '');
                        wages = wages.replace(',', '');
                        wages = parseFloat(wages);
                        if (isNaN(wages) || wages < 0)
                            errMsg += '- The Wages Field must contain a number and it cannot be negative.\n';
                        
                        wageLimit = document.getElementById('13_CalcForm_WageLimit').value;
                        
                        if (wageLimit != '')
                        {
                            wageLimit = wageLimit.replace('$', '');
                            wageLimit = wageLimit.replace(',', '');
                            wageLimit = parseFloat(wageLimit);

                            // WageLimit Not Required  10-23-2006
                            if (isNaN(wageLimit) || wageLimit < 0)
                                errMsg += '- The Wage Limit Field must contain a number and it cannot be negative or the Field must be blank.\n';
                        }
                        
                        var estimatedPremium = 0;
                        estimatedPremium = document.getElementById('13_CalcForm_EstimatedPremium').value;
                        estimatedPremium = estimatedPremium.replace('$', '');
                        estimatedPremium = estimatedPremium.replace(',', '');
                        estimatedPremium = parseFloat(estimatedPremium);
                        if (isNaN(estimatedPremium) || estimatedPremium < 0)
                            errMsg += '- The Estimated Premium Field must contain a number and it cannot be negative.\n';
                        
                        var manualPremium = 0;
                        manualPremium = document.getElementById('13_CalcForm_ManualPremium').value;
                        manualPremium = manualPremium.replace('$', '');
                        manualPremium = manualPremium.replace(',', '');
                        manualPremium = parseFloat(manualPremium);
                        if (isNaN(manualPremium) || manualPremium <= 0)
                            errMsg += '- The Manual Premium Field must contain a number and it must be greater than zero.\n';
                        
                        var jobClass = '';
                        jobClass = document.getElementById('13_CalcForm_JobClass').value;
                        jobClass = jobClass.replace('|', '');
                        jobClass = jobClass.replace(';', '');
                        if (jobClass == '')
                            errMsg += '- The Job Class Field is required and must not be blank.\n';
                        
                        rate = document.getElementById('13_CalcForm_Rate').value;
                        rate = rate.replace('$', '');
                        rate = rate.replace(',', '');
                        rate = parseFloat(rate);
                        if (isNaN(rate) || rate < 0)
                            errMsg += '- The Rate Field must contain a number and it cannot be negative.\n';
                        else
                            document.getElementById('13_CalcForm_Rate').value = rate;
                        
                        
                        // Calculate
                        if (errMsg == '')
                        {
                            tempWages = wages;

                            // tempWages is WageLimit If WageLimit is Blank 10-23-2006
                            if ((tempWages > wageLimit) && (wageLimit != '')) tempWages = wageLimit;

                            result = ((estimatedPremium / manualPremium) * rate) * (tempWages / 100);
                            document.getElementById('13_CalcForm_Result').value = nf(result);
                            // document.getElementById(employer_id).value = nf(result);
                            this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(result));
                            this.S_13_JobClass = jobClass;
                            this.S_13_Rate = rate;
                            this.Var_CalcForm_WC_WageLimit = wageLimit;
                            this.Var_CalcForm_WC_EstimatedPremium = estimatedPremium;
                            this.Var_CalcForm_WC_ManualPremium = manualPremium;
                            
                        }
                    break;
                    
                    /* Time Off */

                    /* Holiday Time DONE:*/
                    case '14':
                    /* Holiday Time DONE:*/
                    case '15':
                    /* Holiday Time DONE:*/
                    case '16':
                    case '45':
                        
                        // Validate
                        
                        pay = document.getElementById(id+'_CalcForm_Pay').value;
                        pay = pay.replace('$', '');
                        pay = pay.replace(',', '');
                        pay = parseFloat(pay);
                        if (isNaN(pay) || pay < 0)
                            errMsg += '- The Pay Field must contain a number and it cannot be negative.\n';
                        
                        workDays = document.getElementById(id+'_CalcForm_WorkDays').value;
                        workDays = workDays.replace('$', '');
                        workDays = workDays.replace(',', '');
                        workDays = parseFloat(workDays);
                        if (isNaN(workDays) || workDays < 0)
                            errMsg += '- The Work Days Field must contain a number and it cannot be negative.\n';
                        else
                            document.getElementById(id+'_CalcForm_WorkDays').value = workDays;
                        
                        daysOff = document.getElementById(id+'_CalcForm_DaysOff').value;
                        daysOff = daysOff.replace('$', '');
                        daysOff = daysOff.replace(',', '');
                        daysOff = parseFloat(daysOff);
                        if (isNaN(daysOff) || daysOff < 0)
                            errMsg += '- The Days Off Field must contain a number and it cannot be negative.\n';
                        else
                            document.getElementById(id+'_CalcForm_DaysOff').value = daysOff;
                        
                        
                        // Calculate
                        if (errMsg == '')
                        {
                            result = daysOff * (pay/workDays);
                            document.getElementById(id+'_CalcForm_Result').value = nf(result);
                            // document.getElementById(employer_id).value = nf(result);
                            this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(result));
                            this.Var_CalcForm_TimeOff_WorkDays = workDays;
                            if (id == '14') this.Var_CalcForm_TimeOff_PaidHolidays = daysOff;
                            
                        }
                    break;

                    // --------------------- Calculations  10-23-2006

                    /* Health Insurance DONE:*/
                    case '23':

                        // Validate
                        var payperyr = document.getElementById(id+'_CalcForm_Payrolls').value;
                        payperyr = parseFloat(payperyr);
                        if (isNaN(payperyr) || payperyr < 0)
                            errMsg += '- The N of Payrolls in a Year Field must contain a number and it cannot be negative.\n';

                        var perpaycost = document.getElementById(id+'_CalcForm_PerPayCost').value;
                        perpaycost = perpaycost.replace('$', '');
                        perpaycost = perpaycost.replace(',', '');
                        perpaycost = parseFloat(perpaycost);
                            
                        if (document.getElementById(employer_id).disabled == false)
                        {
                            if (isNaN(perpaycost) || perpaycost < 0)
                                errMsg += '- The Employer Per-Pay Cost Field must contain a number and it cannot be negative.\n';
                        }
                            
                        var employeeppc = document.getElementById(id+'_CalcForm_EmployeePPC').value;
                        employeeppc = employeeppc.replace('$', '');
                        employeeppc = employeeppc.replace(',', '');
                        employeeppc = parseFloat(employeeppc);
                                
                        if (document.getElementById(employee_id).disabled == false)
                        {
                            if (isNaN(employeeppc) || employeeppc < 0)
                                errMsg += '- The Employee Per-Pay Cost Field must contain a number and it cannot be negative.\n';
                        }

                        var Census = '';
                        Census = document.getElementById(id+'_CalcForm_Census').value;
                        Census = Census.replace('|', '');
                        Census = Census.replace(';', '');
                        if (Census == '')
                            errMsg += '- The Census Field is required and must not be blank.\n';
                            
                        // Calculate
                        if (errMsg == '')
                        {
                            if (document.getElementById(employer_id).disabled == false)
                            {
                                var result = payperyr * perpaycost;
                                document.getElementById(id+'_CalcForm_Result').value = nf(result);
                                // document.getElementById(employer_id).value = nf(result);
                                this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(result));
                            }
                            if (document.getElementById(employee_id).disabled == false)
                            {
                                var result2 = payperyr * employeeppc;
                                document.getElementById(id+'_CalcForm_Result2').value = nf(result2);
                                // document.getElementById(employee_id).value = nf(result2);
                                this.setBenefitValues(benefit_type_index, benefit_index, 'employee', nf(result2));
                            }

                            
                            this.Var_CalcForm_TimeOff_WorkDays = workDays;
                            this.S_23_Payrolls = payperyr;
                            this.S_23_PerPayCost = perpaycost;
                            this.S_23_EmployeePPC = employeeppc;
                            this.S_23_Census = Census;
                            
                        }
                    break;
                    
                    /* Dental Insurance DONE:*/
                    case '24':

                        // Validate
                        

                        var payperyr = document.getElementById(id+'_CalcForm_Payrolls').value;
                        payperyr = parseFloat(payperyr);
                        if (isNaN(payperyr) || payperyr < 0)
                            errMsg += '- The N of Payrolls in a Year Field must contain a number and it cannot be negative.\n';

                        var perpaycost = document.getElementById(id+'_CalcForm_PerPayCost').value;
                        perpaycost = perpaycost.replace('$', '');
                        perpaycost = perpaycost.replace(',', '');
                        perpaycost = parseFloat(perpaycost);
                            
                        if (document.getElementById(employer_id).disabled == false)
                        {
                            if (isNaN(perpaycost) || perpaycost < 0)
                                errMsg += '- The Employer Per-Pay Cost Field must contain a number and it cannot be negative.\n';
                        }
                            
                        var employeeppc = document.getElementById(id+'_CalcForm_EmployeePPC').value;
                        employeeppc = employeeppc.replace('$', '');
                        employeeppc = employeeppc.replace(',', '');
                        employeeppc = parseFloat(employeeppc);
                                
                        if (document.getElementById(employee_id).disabled == false)
                        {
                            if (isNaN(employeeppc) || employeeppc < 0)
                                errMsg += '- The Employee Per-Pay Cost Field must contain a number and it cannot be negative.\n';
                        }

                        var Census = '';
                        Census = document.getElementById(id + '_CalcForm_Census').value;
                        Census = Census.replace('|', '');
                        Census = Census.replace(';', '');
                        if (Census == '')
                            errMsg += '- The Census Field is required and must not be blank.\n';
                            
                        // Calculate
                        if (errMsg == '')
                        {
                            if (document.getElementById(employer_id).disabled == false)
                            {
                                var result = payperyr * perpaycost;
                                document.getElementById(id+'_CalcForm_Result').value = nf(result);
                                document.getElementById(employer_id).value = nf(result);
                                this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(result));
                            }
                            if (document.getElementById(employee_id).disabled == false)
                            {
                                var result2 = payperyr * employeeppc;
                                document.getElementById(id+'_CalcForm_Result2').value = nf(result2);
                                document.getElementById(employee_id).value = nf(result2);
                                this.setBenefitValues(benefit_type_index, benefit_index, 'employee', nf(result2));
                            }

                            
                            //document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value = workDays;
                            this.S_23_Payrolls = payperyr;
                            this.S_24_PerPayCost = perpaycost;
                            this.S_24_EmployeePPC = employeeppc;
                            this.S_23_Census = Census;
                            
                        }
                    break;

                    /* Vision Insurance DONE:*/
                    case '25':

                        // Validate
                        

                        var payperyr = document.getElementById(id+'_CalcForm_Payrolls').value;
                        payperyr = parseFloat(payperyr);
                        if (isNaN(payperyr) || payperyr < 0)
                            errMsg += '- The N of Payrolls in a Year Field must contain a number and it cannot be negative.\n';

                        var perpaycost = document.getElementById(id+'_CalcForm_PerPayCost').value;
                        perpaycost = perpaycost.replace('$', '');
                        perpaycost = perpaycost.replace(',', '');
                        perpaycost = parseFloat(perpaycost);
                            
                        if (document.getElementById(employer_id).disabled == false)
                        {
                            if (isNaN(perpaycost) || perpaycost < 0)
                                errMsg += '- The Employer Per-Pay Cost Field must contain a number and it cannot be negative.\n';
                        }
                            
                        var employeeppc = document.getElementById(id+'_CalcForm_EmployeePPC').value;
                        employeeppc = employeeppc.replace('$', '');
                        employeeppc = employeeppc.replace(',', '');
                        employeeppc = parseFloat(employeeppc);
                                
                        if (document.getElementById(employee_id).disabled == false)
                        {
                            if (isNaN(employeeppc) || employeeppc < 0)
                                errMsg += '- The Employee Per-Pay Cost Field must contain a number and it cannot be negative.\n';
                        }

                        var Census = '';
                        Census = document.getElementById(id + '_CalcForm_Census').value;
                        Census = Census.replace('|', '');
                        Census = Census.replace(';', '');
                        if (Census == '')
                            errMsg += '- The Census Field is required and must not be blank.\n';
                            
                        // Calculate
                        if (errMsg == '')
                        {
                            if (document.getElementById(employer_id).disabled == false)
                            {
                                var result = payperyr * perpaycost;
                                document.getElementById(id+'_CalcForm_Result').value = nf(result);
                                document.getElementById(employer_id).value = nf(result);
                                this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(result));
                            }
                            if (document.getElementById(employee_id).disabled == false)
                            {
                                var result2 = payperyr * employeeppc;
                                document.getElementById(id+'_CalcForm_Result2').value = nf(result2);
                                // document.getElementById(employee_id).value = nf(result2);
                                this.setBenefitValues(benefit_type_index, benefit_index, 'employee', nf(result2));
                            }

                            
                            //document.aspnetForm.Var_CalcForm_TimeOff_WorkDays.value = workDays;
                            this.S_23_Payrolls = payperyr;
                            this.S_25_PerPayCost = perpaycost;
                            this.S_25_EmployeePPC = employeeppc;
                            this.S_23_Census = Census;
                            
                        }
                    break;
                    
                    default:
                        // Check for custom Time Off Calculator
                        if (document.COMP_arrCustomTimeOffBenefits[id])
                        {
                        // Validate
                        
                        pay = document.getElementById(id+'_CalcForm_Pay').value;
                        pay = pay.replace('$', '');
                        pay = pay.replace(',', '');
                        pay = parseFloat(pay);
                        if (isNaN(pay) || pay < 0)
                            errMsg += '- The Pay Field must contain a number and it cannot be negative.\n';
                        
                        workDays = document.getElementById(id+'_CalcForm_WorkDays').value;
                        workDays = workDays.replace('$', '');
                        workDays = workDays.replace(',', '');
                        workDays = parseFloat(workDays);
                        if (isNaN(workDays) || workDays < 0)
                            errMsg += '- The Work Days Field must contain a number and it cannot be negative.\n';
                        else
                            document.getElementById(id+'_CalcForm_WorkDays').value = workDays;
                        
                        daysOff = document.getElementById(id+'_CalcForm_DaysOff').value;
                        daysOff = daysOff.replace('$', '');
                        daysOff = daysOff.replace(',', '');
                        daysOff = parseFloat(daysOff);
                        if (isNaN(daysOff) || daysOff < 0)
                            errMsg += '- The Days Off Field must contain a number and it cannot be negative.\n';
                        else
                            document.getElementById(id+'_CalcForm_DaysOff').value = daysOff;
                        
                        
                        // Calculate
                        if (errMsg == '')
                        {
                            result = daysOff * (pay/workDays);
                            document.getElementById(id+'_CalcForm_Result').value = nf(result);
                            // document.getElementById(employer_id).value = nf(result);
                            this.setBenefitValues(benefit_type_index, benefit_index, 'employer', nf(result));
                            this.Var_CalcForm_TimeOff_WorkDays = workDays;
                            if (id == '14') this.Var_CalcForm_TimeOff_PaidHolidays = daysOff;
                            
                        }
                        }
                    break;
                }
                
                if (errMsg != '')
                    alert('Please correct the following errors:\n\n' + errMsg);
                
            }
        },
        /* Worker's Compensation */
        Function_13_CalcForm_JobClassSelect_onchange(e)
        {
            let value = e.target.value;
            if (value) {
                var arrTemp = value.split(' | ');
                document.getElementById('13_CalcForm_JobClass').value = arrTemp[0];
                document.getElementById('13_CalcForm_Rate').value = arrTemp[1].replace('%', '');
                
                document.getElementById('13_CalcForm_JobClassSelect').selectedIndex = 0;
            }
        },
        /* Health Insurance */
        Function_23_CalcForm_CensusSelect_onchange(e)
        {
            let value = e.target.value;
            if ((value != '') && (value != 'Select Census'))
            {
                var arrTemp = value.split(' | ');
                document.getElementById('23_CalcForm_Census').value = arrTemp[0];
                if ((arrTemp[1] != '') && (arrTemp[2] != '$') && (arrTemp[3] != '$'))
                {
                    document.getElementById('23_CalcForm_Payrolls').value = arrTemp[1];
                    document.getElementById('23_CalcForm_PerPayCost').value = arrTemp[2];
                    document.getElementById('23_CalcForm_EmployeePPC').value = arrTemp[3];
                }
                
                document.getElementById('23_CalcForm_CensusSelect').selectedIndex = 0;
            }
        },
        /* Dental Insurance */
        Function_24_CalcForm_CensusSelect_onchange(e)
        {
            let value = e.target.value;
            if ((value != '') && (value != 'Select Census'))
            {
                var arrTemp = value.split(' | ');
                document.getElementById('24_CalcForm_Census').value = arrTemp[0];
                if ((arrTemp[1] != '') && (arrTemp[2] != '$') && (arrTemp[3] != '$'))
                {
                    document.getElementById('24_CalcForm_Payrolls').value = arrTemp[1];
                    document.getElementById('24_CalcForm_PerPayCost').value = arrTemp[2];
                    document.getElementById('24_CalcForm_EmployeePPC').value = arrTemp[3];
                }
                
                document.getElementById('24_CalcForm_CensusSelect').selectedIndex = 0;
            }
        },
        /* Vision Insurance */
        Function_25_CalcForm_CensusSelect_onchange(e)
        {
            let value = e.target.value;
            if ((value != '') && (value != 'Select Census'))
            {
                var arrTemp = value.split(' | ');
                document.getElementById('25_CalcForm_Census').value = arrTemp[0];
                if ((arrTemp[1] != '') && (arrTemp[2] != '$') && (arrTemp[3] != '$'))
                {
                    document.getElementById('25_CalcForm_Payrolls').value = arrTemp[1];
                    document.getElementById('25_CalcForm_PerPayCost').value = arrTemp[2];
                    document.getElementById('25_CalcForm_EmployeePPC').value = arrTemp[3];
                }
                
                document.getElementById('25_CalcForm_CensusSelect').selectedIndex = 0;
            }
        },
        setBenefitValues(benefit_type_index, benefit_index, key, value) {
            if( key && key == 'employer' ) {
                this.benefit_types[benefit_type_index].benefits[benefit_index].employer_default_value = value;
            }
            if( key && key == 'employee' ) {
                this.benefit_types[benefit_type_index].benefits[benefit_index].employee_default_value = value;
            }
        }
    }
}
</script>
<style scoped>
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
</style>


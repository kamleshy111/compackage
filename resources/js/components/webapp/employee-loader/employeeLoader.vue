<template>
    <div>
        <div v-if="currentStep == 1">
            <p class="text-black text-base mb-4">Use the Employee Loader to bulk upload your employee data.</p>
            <ol class="list-decimal pl-5 mb-5">
                <li>Download the <a :href="url + '/csv/compackage-template.xlsx'" download="compackage-template.xlsx" class="text-[#164900] underline underline-offset-1">template</a> or create your own CSV file.
                <strong>Before importing, check your CSV file for the following:</strong>
                <ul class="pl-5 list-disc">
                    <li>We have built error checking into the Loader to be able to identify any specific cells that have issues. Because of this, all non-benefit categories must use these specific names. If you are using your own template, make sure these column headings match our template: first name, middle name, last name, employee ID, email, phone, address line 1, address line 2, supervisor, digital delivery, digital delivery ID, city, state, zip, group/department.</li>
                    <li>The above fields are the only fields that can have letters within the fields. All other fields should have either a 0/blank cell oran annual dollar value in the field.</li>
                    <!-- <li>When saving your Excel file to a CSV, do not use CSV UTF-8-all other CSV options are fine.</li> -->
                    <li>If you are using the COMPackage template, any of the columns can be removed or customized to your own benefit name.</li>
                    <li>If your template benefit headings match what you have in the Benefits page in COMPackage, then they will load automatically; otherwise, COMPackage will help you map them.</li>
                    <li>If you want your co-pays to automatically match what's in COMPackage, add "Employee "before the item. E.g., the employee match for "Dental Insurance" would be "Employee Dental Insurance".</li>
                </ul>
                </li>
                <li>Select the CSV file using the Employee LOADER tool and click the <strong> Next </strong>button.</li>
                <li>Click <strong>Match Benefit Name</strong> to match up the benefit names you are importing with the benefit names from the Benefits page.</li>
                <li>Peruse the list of imported employees to confirm that employee names look correct. Click <strong>Next.</strong></li>
                <li>Peruse the list and click <strong>Finalize Import.</strong></li> 
            </ol>
            <ul class="pl-5 list-disc">
                <li><strong>NOTE: </strong>If you receive an error, this usually indicates an issue with something in the CSV sheet. Review the list of importing rules above, and if you still need assistance,contact <a class="text-[#164900] underline underline-offset-1" href="mailto:support@compackage.com">support@compackage.com</a>.</li>
            </ul>
        </div>
        <div class="multistep-form">
            <div id="step1" v-show="currentStep == 1">
                <div v-if="sheetErrors.length > 0" class="mb-4 p-2 shadow-sm w-full max-w-[600px] border border-[#d8d8d8]">
                    <ul class="text-[12px]">
                        <li class="font-bold mb-2 last:mb-0 text-red-700" v-for="error in sheetErrors">
                            {{error.msg}}
                        </li>
                    </ul>
                </div>
                <div class="flex flex-wrap mb-4">
                    <label class="mb-1 w-full">Select CSV File</label>
                    <input type="file" accept="text/csv" @change="updateCsv($event)" />
                </div>
                
                <div class="w-full">
                    <input class="cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" type="button" value="Next" @click.prevent="goToStep(2)" />
                </div>
            </div>
            
            <div id="step2" v-show="currentStep == 2">
                <strong>Next Steps:</strong>
                <br/>
                <ol type="1" class="pl-5 list-decimal mb-3">
                    <li>If you have changed any of the category headers in the template (or just used your own template), you will need to select that category from any of the blank items.
                        <ol type="a" class="pl-5 list-decimal">
                            <li>If your item is close to one of COMPackage’s, use that category. E.g., if your last name category in your file was L-Name, then choose L-Name from the Last Name dropdown cell.</li>
                            <li>If your item is not relevant to COMPackage’s (e.g., Free Jet Ski Rentals), then – on one (any) of the Custom Benefits, choose Free Jet Ski Rentals from the dropdown menu for that cell.</li>
                        </ol>
                    </li>
                    <li>When you are done, click the Right Arrow to look at some or all of our entries to ensure they are populating correctly. If so, click Next to continue.</li>
                </ol>
                <strong>NOTE:</strong> Once you’ve imported all employees , you can go to Company Benefits and change any category name in the default field to match what you call it at your company. 
                <br/><strong>NOTE:</strong> Whenever you have a co-pay, if you want a direct (automatic) match with the CSV loader file, put "Employer " (including the space) before the item. E.g., the co-pay for "Health Insurance" would be "Employer Health Insurance" in your CSV file. 
                <br/><strong>NOTE:</strong> SSN cannot be used for Employee ID.
                <br/><br/>
                <p class="text-red-700"><strong>NOTE:</strong> If you are not seeing any benefits column then, please update company benefits <a target="_blank" class="curor-pointer underline text-blue-400" :href="url + '/webapp/benefits-list'">here.</a></p>

                <div class="mt-4 flex flex-wrap -m-2.5 w-full max-w-[650px]">
                    <div class="w-full px-2.5 mb-3">
                        <div class="flex flex-wrap -mx-2.5 item-center">
                            <div class="w-1/3 px-2.5">
                                <h3 class="font-semibold">Benefits Tab</h3>
                            </div>
                            <div class="w-1/3 px-2.5">
                                <h3 class="font-semibold">Loader Spreadsheet</h3>
                            </div>
                            <div class="w-1/3 px-2.5">
                                <h3 class="font-semibold">Employee co-pay</h3>
                            </div>
                            
                        </div>
                    </div>
                    <div v-for="(c_benefit, index_v) in compackage_benefits" class="w-full px-2.5 mb-3">
                        <div class="flex flex-wrap -mx-2.5 item-center">
                            <div class="w-1/3 px-2.5">
                                <label :data-id="c_benefit.id" class="mb-1">{{(c_benefit.benefit_custom_name != "") ? c_benefit.benefit_custom_name :c_benefit.name}}:</label>
                            </div>
                                <!-- v-model="c_benefit.csv_heading" -->
                            <div class="w-1/3 px-2.5">
                                <select v-on:change="columnMapping($event, index_v)" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                                    <option value="">Match Benefit Name</option>
                                    <option v-for="col in csv_col" :disabled="! isNaN(c_benefit.id) && fixed_columns_arr.includes(col)" :selected="c_benefit.csv_heading == col" :value="col" >{{col}}</option>
                                </select>
                            </div>
                            <div class="w-1/3 px-2.5">
                                <select v-if="c_benefit.employee_co_pay" v-on:change="employeeColumnMapping($event, index_v)" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                                    <option value="">Match Benefit Name</option>
                                    <option v-for="col in csv_col" :disabled="! isNaN(c_benefit.id) && fixed_columns_arr.includes(col)" :selected="'Employee '+c_benefit.csv_heading == col" :value="col" >{{col}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2.5 flex space-x-0.5">
                        <input class="cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" type="button" value="Prev" @click.prevent="goToStep(1)" />
                        <input class="cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" type="button" value="Next" @click.prevent="goToStep(3)" />
                    </div>
                </div>
            </div>

            <div id="step3" v-show="currentStep == 3">
                <p>Please confirm that all employees's names are correctly spelled, as you will not be able to correct them later.</p>
                <p>Committing the name is how COMPackage controls the consumption of your license.</p>
                <strong class="mt-4 inline-block">Employee Information</strong>
                <div v-for="(record, current) in csv" v-show="empcurrent == current" class="w-full max-w-[650px]"> 
                    <div class="mt-4 flex flex-wrap -m-2.5">
                        <div class="lg:w-1/3 w-full px-2.5">
                            <label class="mb-1">First Name</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['First Name']" />
                        </div>
                        <div class="lg:w-1/3 w-full px-2.5">
                            <label class="mb-1">Last Name</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Last Name']" />
                        </div>
                        <div class="lg:w-1/3 w-full px-2.5">
                            <label class="mb-1">Email</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Email']" />
                        </div>
                        <div class="lg:w-1/3 w-full px-2.5">
                            <label class="mb-1">Phone</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Phone']" />
                        </div>
                        <div class="lg:w-1/3 w-full px-2.5">
                            <label class="mb-1">Employee ID</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Employee ID']" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap -m-2.5">
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">Supervisor</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Supervisor']" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap -m-2.5">
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">Hourly Pay Functionality</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Hourly']" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap -m-2.5">
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">Digital Delivery ID</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Digital Delivery ID']" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap -m-2.5">
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">Address Line 1</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Address Line 1']" />
                        </div>
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">Address Line 2</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Address Line 2']" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap -m-2.5">
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">City</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['City']" />
                        </div>
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">State</label>
                            <select class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['State']">
                                <option value=""></option>
                                <option value="USA">--------USA--------</option>
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
                                <option selected="selected" value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                                <option value="CAN">-------CANADA-------</option>
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
                    </div>
                    <div class="mt-4 flex flex-wrap -m-2.5">
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">Zip Code</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['ZIP']"/>
                        </div>
                        <div class="lg:w-1/2 w-full px-2.5">
                            <label class="mb-1">Group/Department</label>
                            <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record['Group/Department']"/>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between border-b border-neutral-400 items-center py-1.5">
                            <span>Benefits</span>
                            <button v-on:click="Clcktoggle" class="hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" :class="[showBenefits == true ? 'hidden' : 'inline']">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" :class="[showBenefits == true ? 'inline' : 'hidden']">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-4 flex flex-wrap -m-2.5" :class="[showBenefits == true ? 'opacity-100 visible block' : 'hidden opacity-0 invisible']">
                            <!-- <div class="text-red-700 px-2.5">Benefits editing disabled for now as some validations are pending.</div> -->
                            <div v-for="(benefit_col, key) in filter(record)" class="lg:w-1/2 w-full px-2.5">
                                <label class="mb-1">{{key}}</label>
                                <input type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" v-model="record[key]"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap justify-between w-full max-w-[650px] mt-5 items-center">
                    <a href="javascript:void(0)" v-on:click="previousEmployee()" :class="(empcurrent == 0) ? 'cursor-no-drop opacity-50 gradient-green' : 'cursor-pointer'" class="hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                    </a>
                    <div class="">{{(empcurrent+1)}}/{{csv.length}}</div>
                    <a href="javascript:void(0)" v-on:click="nextEmployee()" :class="((this.csv.length-1) == this.empcurrent) ? 'cursor-no-drop opacity-50 gradient-green' : 'cursor-pointer'" class="hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    
                </div>

                <div class="w-full mt-10 flex space-x-0.5">
                    <input class="cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" type="button" value="Prev" @click.prevent="goToStep(2)" />
                    <input class="cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" type="button" value="Next" @click.prevent="goToStep(4)" />
               </div>
            </div>

            <div id="step4" v-show="currentStep == 4">
                <p>Review this list before committing to the database:</p>
                <p>You have unlimited reports.</p>
                <p><strong>Note:</strong> This will take about 0.5 seconds per employee. E.g., 120 employees will take about 2 minutes.</p>
                <div>
                    <select size="5" multiple name="" v-model="employeeRemove" class="h-[80px] focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
			            <option v-for="(record, index) in csv"  :value="index">{{record['First Name']}} {{record['Last Name']}}</option>
		            </select>
                    <input class="cursor-pointer hover:bg-red-900 flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center bg-red-700 text-white font-sans font-bold text-sm" type="button" value="Remove" v-on:click="removeEmployee()" />
                </div>
                <div class="mt-3">
                    <p class="text-sm">To remove an employee, select the name from the list and click "Remove."</p>
                    <p class="text-sm">To select multiple employees, hold down Ctrl or Shift and select.</p>
                </div>
                <div class="w-full mt-10 flex space-x-0.5">
                    <input class="cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" type="button" value="Prev" @click.prevent="goToStep(3)" />
                    <input class="cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" type="button" value="Finalize Import" v-on:click="commitImport()" />
                </div>
            </div>

            <div id="step4" v-show="currentStep == 5">
                <div class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20"></div>
                <div class="min-h-[200px] cpgmodal-container w-full max-w-[600px] flex flex-wrap items-center justify-center p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7] text-center">
                    <span v-on:click="Rloadclick()" class="cpgclose-popup absolute w-7 h-7 text-center bg-black text-white text-[26px] leading-[25px] border-2 border-white shadow-md top-0 right-0 lg:-top-2.5 lg:-right-2.5 rounded-full cursor-pointer">&times;</span>
                    <div class="w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mb-2 w-14 text-[#07521e] h-14 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                        <p class="text-md">Successfully Imported: {{imported}}</p>
                        <p class="text-md">Failed: {{failed}}</p>
                        <div class="max-h-[150px] overflow-auto"><p class="text-red-600">Issues:</p>
                            <p v-if="failed_record.length>0" v-for="(failed_rec, i) in failed_record" class="text-[14px]">{{i+1}}{{'. First Name: ' + failed_rec[0]['First Name']}} {{' Columns: ' + failed_rec[1]}}</p>
                            <p v-else class="text-red-600">No Issues Found</p>
                            <!-- <div>{{failed_record}}</div> -->
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full flex justify-center items-center top-0 left-0" v-show="viewLoader">
            <div v-show="showCommitCount" class="text-[25px] text-greenback fixed text-center md:top-[45%] top-[40%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">Importing {{commitCount}}/{{totalCommitCount}}</div>
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>

<script>
export default {
    props:["compackage_benefits"],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            csv:[],
            prev_csv:{},
            csv_col: [],
            fixed_columns:{
                "firstname": "First Name",
                "lastname": "Last Name",
                "employee_id": "Employee ID",
                "supervisor": "Supervisor",
                "address_line_1": "Address Line 1",
                "address_line_2": "Address Line 2",
                "city": "City",
                "state": "State",
                "zip": "ZIP",
                "group": "Group/Department",
                "email": "Email",
                "phone": "Phone",
                "digital_delivery_value": 'Digital Delivery ID'
            },
            columns_mapping: [],
            employeeRemove:[],
            currentStep: 1,
            empcurrent: 0,
            sheetErrors: [],
            showBenefits: false,
            showCommitCount: false,
            commitCount: 0,
            totalCommitCount:0,
            failed:0,
            failed_record:[],
            imported:0,
            final1: [],
            fixed_columns_arr: [
                "First Name",
                "Last Name",
                "Employee ID",
                "Supervisor",
                "Address Line 1",
                "Address Line 2",
                "Digital Delivery ID",
                "City",
                "State",
                "ZIP",
                "Zip",
                "Group/Department",
                "Email",
                "Phone"
            ]
        }
    },
    created() {
        // Show a loader on the page reload.
        //if( this.currentStep != 1 && this.currentStep != 5) {
            /* console.log(this.currentStep);
            window.onbeforeunload = function() {
                return false; //"Data will be lost if you leave the page, are you sure?";
            }; */
        //}
    },
    methods: {
        Rloadclick(){
            location.href = this.url + '/webapp/employees';
        },
        Clcktoggle () {
            this.showBenefits = !this.showBenefits;
        },
        goToStep(step) {
            let app = this;
            app.viewLoader = true;
            if( step == 2 && app.currentStep < step ) {
                alert(`Tip: Remember, you must have updated your benefits before importing employees!`);
                app.viewLoader = true;

                jQuery('select, input').removeClass('border-2 border-rose-600');
                
                var form = new FormData();

                let endpoint = this.url + '/webapp/employee-loader/readcsv';
            
                form.append("csv", this.csv);
                
                axios.post( endpoint, form ).then((response) => {
                    if(response.data.success) {
                        
                        app.currentStep = step;
                        app.csv_col = response.data.data.cols;
                        app.csv = response.data.data.csv_data;
                        app.prev_csv = response.data.data.prev_csv;

                        // Change mapping for employee
                        // :selected="'Employee '+c_benefit.csv_heading == col"
                        // console.log(app.compackage_benefits);
                        // console.log(app.csv[0]);
                        for( let i in app.compackage_benefits ) {
                            /* if( app.csv[0]['Employee '+app.compackage_benefits[i].name] ) {
                                // this.compackage_benefits[i].employee_default_value = app.csv[0]['Employee '+app.compackage_benefits[i].name];
                                this.compackage_benefits[i].employee_default_value = 'Employee '+app.compackage_benefits[i].name;
                            } else if( app.csv[0]['Employee '+app.compackage_benefits[i].benefit_custom_name] ) {
                                // this.compackage_benefits[i].employee_default_value = app.csv[0]['Employee '+app.compackage_benefits[i].benefit_custom_name];
                                this.compackage_benefits[i].employee_default_value = 'Employee '+app.compackage_benefits[i].benefit_custom_name;
                            } */

                            if( app.compackage_benefits[i].benefit_custom_name ) {
                                app.compackage_benefits[i].employee_default_value = 'Employee '+app.compackage_benefits[i].benefit_custom_name;
                            } else {
                                app.compackage_benefits[i].employee_default_value = 'Employee '+app.compackage_benefits[i].name;
                            }
                        }
                        

                        app.viewLoader = false;

                    } else {
                        if( response.data.data.errors ) {
                            app.sheetErrors = response.data.data.errors;
                        } else {
                            app.sheetErrors.push(response.data.data);
                        }
                    }
                    
                    app.viewLoader = false;
                }).catch((error) => {
                    app.viewLoader = false;
                    showErrorMessage(error);
                });
            } else if( step == 3 ) {

                app.currentStep = step;
                app.viewLoader = false;
            } else {
                app.currentStep = step;
                app.viewLoader = false;
            }
        },
        updateCsv(e) {
            this.csv = e.target.files[0];
        },
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
        },
        previousEmployee() {
            if( this.empcurrent > 0 ) {
                this.empcurrent--;
            }
        },
        nextEmployee() {
            if( (this.csv.length-1) > this.empcurrent ) {
                this.empcurrent++;
            }
        },
        removeEmployee() {
            if(this.employeeRemove && typeof this.employeeRemove == 'object' && this.csv.length > 0) {
                // First reversed the array to remove last element first due to index mis-match if we remvoe indexes from the start
                this.employeeRemove.reverse().forEach((i, v) => {
                    // Remove only selected index from the csv array.
                    this.csv.splice(i,(i+1));
                });
            }
        },
        commitImport() {
            this.totalCommitCount = this.csv.length;

            this.final1 = this.csv.chunk(50);

            this.viewLoader = true;
            this.recurringCommit(0)
        },
        recurringCommit(i) {
            let app = this;
            
            if( app.final1[i] && app.final1[i] != '' ) {
                this.showCommitCount = true;
                axios.post( this.url + '/webapp/employee-loader/commitimport', {"csv": app.final1[i], "mapping": this.compackage_benefits} ).then((response) => {
                    if( response.data.success ) {
                        this.commitCount = (i+1) * 50;
                        i = i+1;

                        app.failed      = app.failed + response.data.data.res.failed;
                        app.imported    = app.imported + response.data.data.res.imported;

                        if( response.data.data.res.failed_record ) {
                            app.failed_record.push([response.data.data.res.failed_record, response.data.data.res.failed_msg]);
                        }

                        app.recurringCommit(i)
                        
                    } else {
                        app.viewLoader = false;
                        showErrorMessage(response.data.data.msg)
                    }
                }).catch((error) => {
                    app.viewLoader = false;
                    showErrorMessage(error);
                });
            } else {
                app.currentStep = 5;
            }
        },
        columnMapping(e, index) {
            let oldV = this.compackage_benefits[index].benefit_custom_name;
            let newV = jQuery(e.target).val();

            for( let i in this.csv) {
                this.csv[i][oldV] = this.prev_csv[i][newV];
            }
        },
        employeeColumnMapping(e, index) {
            let oldV = this.compackage_benefits[index].benefit_custom_name;
            let newV = jQuery(e.target).val();
            
            for( let i in this.csv) {
                // this.csv[i][oldV] = this.prev_csv[i][newV];
                this.compackage_benefits[index].employee_default_value = newV;
                // this.compackage_benefits[index].employee_default_value = this.prev_csv[i][newV];
            }
        },
        filter(record) {
            let copy = Object.assign({}, record);
            for( let i in this.fixed_columns ) {
                delete copy[this.fixed_columns[i]];
            }

            for( let i in copy ) {
                let flag = false;
                for( let j in this.compackage_benefits ) {
                    if( i == this.compackage_benefits[j]['name'] ) {
                        flag = true;
                    }
                }
                if( ! flag ) {
                    delete copy[i];
                }
            }

            return copy;
        },
        cleanup() {
            delete this.prev_csv;
            delete this.csv;
            delete this.csv_col;
            delete this.fixed_columns;
            delete this.columns_mapping;
            delete this.employeeRemove   ;
        }
    }
}
</script>
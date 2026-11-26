<template>
    <form action="#" method="POST" enctype="multipart/form-data" v-on:submit="createCompany">
    <div class="flex flex-wrap row -mx-4">
        <div class="md:w-1/2 w-full px-4">
            <h3 class="text-2xl text-black mb-2">Company Information</h3>
            <div class="w-full mb-3 mb-3">
                <label class="mb-1">Company Name</label>
                <input name="name" type="text" maxlength="100" v-model="company_details.name" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
            </div>
            <div class="w-full mb-3">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="md:w-1/2 xl:w-1/2">
                        <label class="mb-1 w-full">Company Logo</label>
                        <input class="w-full py-2.5" type="file" name="logo" @change="updatePhoto($event)"/>
                        <!-- <span class="w-full block text-red-700 text-[12px]"><em>The image size should be around 240x130</em></span> -->
                    </div>
                    <div class="md:w-1/2 xl:w-1/2 relative mt-4 md:mt-0">    
                        <img v-if="company_details.logo_url" :src="company_details.logo_url" class="w-auto max-w-[235px] ml-auto border border-[#a3a3a3]" />
                        <!--  rounded-full md:w-[100px] md:h-[100px] w-[50px] h-[50px] w-[350px]  -->
                    </div>
                    
                </div>
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Industry</label>
                <input name="industry" type="text" v-model="company_details.industry" maxlength="50" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
                <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                    <label class="mb-1">Address Line 1</label>
                    <input name="addr1" type="text" v-model="company_details.addr1" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="lg:w-1/2 w-full px-4">
                    <label class="mb-1">Address Line 2</label>
                    <input name="addr2" type="text" v-model="company_details.addr2" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
                <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                    <label class="mb-1">City</label>
                    <input name="city" type="text" v-model="company_details.city" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                </div>
                <div class="lg:w-1/2 w-full px-4">
                    <label class="mb-1">State</label>
                    <select name="state" v-model="company_details.state" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
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
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
                <div class="md:w-1/2 w-full px-4 mb-3 md:mb-0">
                    <label class="mb-1">Zip Code</label>
                    <input name="zip" type="text" v-model="company_details.zip" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="md:w-1/2 w-full px-4">
                    <label class="mb-1">Telephone</label>
                    <input name="telephone" type="text" v-model="company_details.telephone" maxlength="15" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Ext.</label>
                <input name="phone_ext" type="text" v-model="company_details.phone_ext" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Letter</label>
                <textarea class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-36 px-2.5 rounded bg-neutral-100 w-full form-control" name="letter" rows="2" cols="20"
                            v-model="company_details.letter">Enclosed is a personalized Total Compensation Statement prepared specifically for you. This statement shows the contributions made by your company toward your total compensation package. As you review this statement, you will see that the value of your benefits, added to your annual pay, produce your total compensation. The statement is designed to show how much your service is valued by your company.</textarea>
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Closing Line</label>
                <input name="closing" type="text" v-model="company_details.closing" maxlength="255" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
                <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                    <label class="mb-1">Executive's Name 1</label>
                    <input maxlength="50" name="exec_name" type="text" v-model="company_details.exec_name" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="lg:w-1/2 w-full px-4">
                    <label class="mb-1">Executive's Position 1</label>
                    <input maxlength="50" name="exec_position" type="text" v-model="company_details.exec_position" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
                <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                    <label class="mb-1">Executive's Name 2</label>
                    <input maxlength="50" name="exec_name2" type="text" v-model="company_details.exec_name2" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="lg:w-1/2 w-full px-4">
                    <label class="mb-1">Executive's Position 2</label>
                    <input maxlength="50" name="exec_position2" type="text" v-model="company_details.exec_position2" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
                <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                    <label class="mb-1">Executive's Name 3</label>
                    <input maxlength="50" name="exec_name3" type="text" v-model="company_details.exec_name3" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="lg:w-1/2 w-full px-4">
                    <label class="mb-1">Executive's Position 3</label>
                    <input maxlength="50" name="exec_position3" type="text" v-model="company_details.exec_position3" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
            </div>

            <!-- Digital Delivery -->
            <h3 class="text-2xl text-black mb-2">Digital Delivery</h3>
            <i>If you are using Digital Delivery for any of your employees, the following fields are required.</i>
            <div class="w-full mb-3">
                <label class="mb-1">COMPANY NAME for the email</label>
                <input name="name" type="text" maxlength="30" v-model="company_details.company_name_email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">DIGITAL DELIVERY MESSAGE for the email</label>&nbsp;
                <span class="cursor-pointer" @click="showConfirmation">(?)</span>
                <!-- <span class="cursor-pointer" @mouseover="showTooltip" title="The DIGITAL DELIVERY ID is a unique identifier that each employee will know that is personal to them. Examples: Last four of SSI, DOB, mobile number, Employee ID, etc. Employees will need their email plus this DIGITAL DELIVERY ID in order to access their report online. (You might want to test this by sending yourself the Digital Delivery email notification.)">(?)</span> -->
                <input name="name" type="text" maxlength="255" v-model="company_details.dd_field_message_email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">CLOSING LINE for the email</label>
                <input name="closing" type="text" v-model="company_details.closing_email" maxlength="255" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">EXECUTIVE NAME(S) for the email</label>
                <input maxlength="50" name="exec_name" type="text" v-model="company_details.exec_name_email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
            </div>
            
            <!-- Digital Delivery -->
            <div v-if="permissions.update || permissions.create" class="back-btnend"><input type="submit" name="btn_Submit" value="Save Information" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm" id="company-submit"></div>
        </div>
        <div class="md:w-1/2 w-full px-4 pt-5 md:pt-0">
            <h3 class="text-2xl text-black mb-2">Report Information</h3>
            <div class="w-full mb-3">
                <label class="mb-1">Disclaimer</label>
                <textarea name="disclaimer" rows="2" cols="20" v-model="company_details.disclaimer"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-36 px-2.5 rounded bg-neutral-100 w-full form-control">Neither COMPackage Corp. nor your employer shall be liable for any errors or omissions in this report generated using the COMPackage software.  The contents of this report are for illustrative purposes only and are not intended to be, nor shall they constitute, a definitive statement of your compensation package.  Calculation totals may differ on account of rounding.  Any questions regarding your compensation package should be directed to your employer.</textarea>
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Report Footer Information</label>
                <textarea name="report_footer" rows="2" cols="20"
                            v-model="company_details.report_footer" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-18 px-2.5 rounded bg-neutral-100 w-full form-control">This Total Compensation Report was created by COMPackage.com &amp;copy;</textarea>
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Year Ending Date</label>
                <input name="ending_date_label" type="text" v-model="company_details.ending_date_label" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control mb-3" />
                <div class="flex flex-wrap -mx-4">
                    <div class="md:w-1/3 w-full mb-2 md:mb-0 px-4">
                        <select name="month" v-model="company_details.month" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option value="">Select a month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                    <div class="md:w-1/3 w-1/2 md:mb-0 px-4">
                        <select name="day" v-model="company_details.day" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                                <option value="">Select a day</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </div>
                        <div class="md:w-1/3 w-1/2 md:mb-0 px-4">
                            <select name="year" v-model="company_details.year" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                                <option value="">Select a year</option>
                                <option v-for="i in 20" :value="(2009 + i)">{{(2009+i)}}</option>
                            </select>
                        </div>
                </div>    
            </div>
            <div class="w-full mb-3 text-center">
                <h3 class="text-lg text-black mb-2">Top Box Score Labels</h3>
            </div>
            <div class="tbsl-heading flex">
                <div class="tbsl-col1-heading lg:w-1/2 w-full text-center">
                    <h2>Total Comp</h2>
                </div>
                <div class="tbsl-col2-heading lg:w-1/2 w-full text-center">
                    <h2>Hourly Pay</h2>
                </div>
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
				<div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
					<label class="mb-1">Base Pay</label>
					<input name="base_pay_heading" type="text" maxlength="255" 
								v-model="company_details.base_pay_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
				</div>
				<div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                    <label class="mb-1">Base Hourly</label>
                    <input name="base_pay_hourly_heading" type="text" maxlength="255" v-model="company_details.base_pay_hourly_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
				<div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
					<label class="mb-1">Other Income</label>
					<input name="other_cash_heading" type="text" maxlength="255"
								v-model="company_details.other_cash_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
				</div>
				<div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
					<label class="mb-1">Other Income/hr</label>
                	<input name="other_cash_hourly_heading" type="text" maxlength="255" 
                            v-model="company_details.other_cash_hourly_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
				</div>			
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
				<div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
					<label class="mb-1">Company Paid Benefits</label>
					<input name="company_paid_heading" type="text" maxlength="255"
								v-model="company_details.company_paid_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
				</div>
				<div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
					<label class="mb-1">Benefits/hr</label>
                	<input name="company_paid_hourly_heading" type="text" maxlength="255" 
                            v-model="company_details.company_paid_hourly_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
				</div>
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
				<div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                <label class="mb-1">Total Compensation</label>
                <input name="total_compensation_heading" type="text" maxlength="255" 
                            v-model="company_details.total_compensation_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
				</div>
				<div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
					<label class="mb-1">Total Pkg/hr</label>
                	<input name="total_compensation_hourly_heading" type="text" maxlength="255" 
                            v-model="company_details.total_compensation_hourly_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
				</div>
            </div>

            <div class="flex flex-wrap -mx-4 mb-3">
                <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                    <label class="mb-1">Employee Contributions Color</label>
                    
                    <div class="flex">
                        <VSwatches v-model="company_details.color1" popover-x="left" swatches="text-advanced" />
                        <!-- <v-swatches v-model="company_details.color1" popover-x="left" swatches="text-advanced"></v-swatches> -->
                        <input name="color1" type="text" maxlength="10" v-model="company_details.color1" class="pl-14 focus:border-lbrwnclr outline-0 border border-neutral-400 h-[42px] px-2.5 rounded-[10px] bg-neutral-100 w-full form-control" />
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-4">
                    <label class="mb-1">Employer Contributions Color</label>
                    <div class="flex">
                        <VSwatches v-model="company_details.color2" popover-x="left" swatches="text-advanced" />
                        <!-- <v-swatches v-model="company_details.color2" popover-x="left" swatches="text-advanced"></v-swatches> -->
                        <input name="color2" type="text" maxlength="10" v-model="company_details.color2" class="pl-14 focus:border-lbrwnclr outline-0 border border-neutral-400 h-[42px] px-2.5 rounded-[10px] bg-neutral-100 w-full form-control" />
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-4 mb-3">
                <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                    <label class="mb-1">Base Pay Color</label>
                    <div class="flex">
                        <VSwatches v-model="company_details.color3" popover-x="left" swatches="text-advanced" />
                        <!-- <v-swatches v-model="company_details.color3" popover-x="left" swatches="text-advanced"></v-swatches> -->
                        <input name="color3" type="text" maxlength="10" v-model="company_details.color3" class="pl-14 focus:border-lbrwnclr outline-0 border border-neutral-400 h-[42px] px-2.5 rounded-[10px] bg-neutral-100 w-full form-control" />
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-4">
                    <label class="mb-1">Total Compensation Color</label>
                    <div class="flex">
                        <!---<v-swatches></v-swatches>-->
                        <VSwatches v-model="company_details.color4" popover-x="left" swatches="text-advanced" />
                        <input name="color4" type="text" maxlength="10" v-model="company_details.color4" class="pl-14 rounded-[10px] focus:border-lbrwnclr outline-0 border border-neutral-400 h-[42px] px-2.5  bg-neutral-100 w-full form-control" />
                    </div>
                </div>
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Company Designation</label>
                <input name="company_designation" type="text" maxlength="255" 
                            v-model="company_details.company_designation" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                <span class="text-xs text-black">This will change the designation "company" in the 6 locations in the report (e.g., organization, university, agency, etc.).</span>            
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Currency Symbol</label>
                <input name="currency_symbol" type="text" maxlength="7"
                            v-model="company_details.currency_symbol" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
            </div>
            <div class="w-full mb-3">
                <label class="mb-1">Benefits Total</label>
                <input name="benefits_total_heading" type="text" maxlength="255" v-model="company_details.benefits_total_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
            </div>
            
            <div class="w-full mb-3 text-center">
                <h3 class="text-lg text-black mb-2">Benefits Headings (report body part)</h3>
            </div>
            
            <div class="base_pay">
                <div class="w-full mb-3">
                    <h3 class="text-lg text-black mb-2">Base Pay Labels</h3>
                </div>
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Base Pay</label>
                        <input name="base_pay_new_heading" type="text" maxlength="255" v-model="company_details.base_pay_new_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Other Income</label>
                        <input name="other_cash_benefits_heading" type="text" maxlength="255" v-model="company_details.other_cash_benefits_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>				
                </div>
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Additional Benefits</label>
                        <input name="other_benefits_information_heading" type="text" maxlength="255" v-model="company_details.other_benefits_information_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Government Benefits Total</label>
                        <input name="welfare_benefits_total_heading" type="text" maxlength="255" v-model="company_details.welfare_benefits_total_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>				
                </div>
                
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Time Off Benefits Total</label>
                        <input name="time_off_benefits_total_heading" type="text" maxlength="255" v-model="company_details.time_off_benefits_total_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Insurance Benefits Total</label>
                        <input name="insurance_benefits_total_heading" type="text" maxlength="255" v-model="company_details.insurance_benefits_total_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
                
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Special Benefits Total</label>
                        <input name="special_benefits_total_heading" type="text" maxlength="255" v-model="company_details.special_benefits_total_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Retirement Benefits</label>
                        <input name="retirement_benefits_total_heading" type="text" maxlength="255" v-model="company_details.retirement_benefits_total_heading" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
            </div>
            <div class="hourly_pay">
                <div class="w-full mb-3">
                    <h3 class="text-lg text-black mb-2">Hourly Pay Labels</h3>
                </div>
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Base Hourly</label>
                        <input name="base_pay_new_heading_hourly" type="text" maxlength="255" v-model="company_details.base_pay_new_heading_hourly" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Other Income Hourly</label>
                        <input name="other_cash_benefits_heading_hourly" type="text" maxlength="255" v-model="company_details.other_cash_benefits_heading_hourly" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>				
                </div>
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Additional Benefits Hourly</label>
                        <input name="other_benefits_information_heading_hourly" type="text" maxlength="255" v-model="company_details.other_benefits_information_heading_hourly" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Government Benefits Hourly Total</label>
                        <input name="welfare_benefits_total_heading_hourly" type="text" maxlength="255" v-model="company_details.welfare_benefits_total_heading_hourly" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>				
                </div>
                
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Time Off Benefits Hourly Total</label>
                        <input name="time_off_benefits_total_heading_hourly" type="text" maxlength="255" v-model="company_details.time_off_benefits_total_heading_hourly" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Insurance Benefits Hourly Total</label>
                        <input name="insurance_benefits_total_heading_hourly" type="text" maxlength="255" v-model="company_details.insurance_benefits_total_heading_hourly" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
                
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Special Benefits Hourly Total</label>
                        <input name="special_benefits_total_heading_hourly" type="text" maxlength="255" v-model="company_details.special_benefits_total_heading_hourly" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Retirement Benefits Hourly</label>
                        <input name="retirement_benefits_total_heading_hourly" type="text" maxlength="255" v-model="company_details.retirement_benefits_total_heading_hourly" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
            </div>	
            <!-- <div class="back-btnend"><input type="submit" name="btn_defaults" value="Restore Default Report Information Settings" id="content_main_btn_defaults" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm"></div> -->
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
//import VSwatches from 'vue-swatches'
// Import the styles too, typically in App.vue or main.js
//import 'vue-swatches/dist/vue-swatches.css'

import { createApp } from "vue";
import VSwatches from "vue3-swatches";

export default {
    props: ['editcompany', 'permissions'],
    
    components: { VSwatches },
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            showTooltip: false,
            company_details: {
                name: '',
                logo: '',
                logo_url: '',
                industry: '',
                addr1: '',
                addr2: '',
                city: '',
                state: '',
                zip: '',
                telephone: '',
                phone_ext: '',
                letter: "Enclosed is a personalized statement prepared specifically for you. This statement shows the contributions made by your company toward your total compensation package. As you review this statement, you will see that the value of your benefits, added to your annual pay, produce your total compensation. The statement is designed to show how much your service is valued by your company.",
                closing: '',
                exec_name: '',
                exec_position: '',
                exec_name2: '',
                exec_position2: '',
                exec_name3: '',
                exec_position3: '',
                disclaimer: "Neither COMPackage Corp. nor your employer shall be liable for any errors or omissions in this report generated using the COMPackage software. The contents of this report are for illustrative purposes only and are not intended to be, nor shall they constitute, a definitive statement of your compensation package. Calculation totals may differ on account of rounding. Any questions regarding your compensation package should be directed to your employer.",
                report_footer: "This Total Compensation Report was created by YOUR COMPANY and COMPackage Corp.",
                month: '',
                day: '',
                year: '',
                base_pay_heading: '',
                other_cash_heading: '',
                company_paid_heading: '',
                total_compensation_heading: '',
                company_designation: '',
                color1: '#000000',
                color2: '#000000',
                color3: '#000000',
                color4: '',
                currency_symbol: '$',
                company_name_email: '',
                dd_field_message_email: '',
                closing_email: '',
                exec_name_email: '',
                ending_date_label: '',
                base_pay_hourly_heading: '',
                other_cash_hourly_heading: '',
                company_paid_hourly_heading: '',
                total_compensation_hourly_heading: '',
                welfare_benefits_total_heading: '',
                time_off_benefits_total_heading: '',
                insurance_benefits_total_heading: '',
                special_benefits_total_heading: '',
                benefits_total_heading: '',
                base_pay_new_heading: '',
                other_benefits_information_heading: '',
                other_cash_benefits_heading: '',
                retirement_benefits_total_heading: '',
                other_benefits_information_heading_hourly: '',
                other_cash_benefits_heading_hourly: '',
                base_pay_new_heading_hourly: '',
                welfare_benefits_total_heading_hourly: '',
                time_off_benefits_total_heading_hourly: '',
                insurance_benefits_total_heading_hourly: '',
                special_benefits_total_heading_hourly: '',
                retirement_benefits_total_heading_hourly: '',
            }
        }
    },
    created() {
        if( this.editcompany ) {
            if( this.editcompany.logo_url ) {
                this.editcompany.logo_url = this.url+'/'+this.editcompany.logo_url;
            }
            this.company_details = this.editcompany;
            /*
            if(this.company_details.base_pay_hourly_heading == null || this.company_details.base_pay_hourly_heading == '')
            {
                this.company_details.base_pay_hourly_heading = 'Base Hourly';
            }
            if(this.company_details.other_cash_hourly_heading == null || this.company_details.other_cash_hourly_heading == '')
            {
                this.company_details.other_cash_hourly_heading = 'Other Cash Ben/hr';
            }
            if(this.company_details.company_paid_hourly_heading == null || this.company_details.company_paid_hourly_heading == '')
            {
                this.company_details.company_paid_hourly_heading = 'Benefits/hr';
            }
            if(this.company_details.total_compensation_hourly_heading == null || this.company_details.total_compensation_hourly_heading == '')
            {
                this.company_details.total_compensation_hourly_heading = 'Total Pkg/hr';
            }
            */
        }
    },
    methods: {
        createCompany(e) {
            e.preventDefault();
            let app = this;
            app.viewLoader = true;

            jQuery('select, input').removeClass('border-2 border-rose-600');
            
            var form = new FormData();

            let endpoint = '/webapp/companies/store';
            if( this.editcompany && this.editcompany.id ) {
                // form.set('id', this.editcompany.id);
                endpoint = '/webapp/companies/update/' + this.editcompany.id;
                
            }

            form.set('name', this.company_details.name);
            form.set('logo', this.company_details.logo);
            form.set('industry', this.company_details.industry);
            form.set('addr1', this.company_details.addr1);
            form.set('addr2', this.company_details.addr2 ? this.company_details.addr2 : '');
            form.set('city', this.company_details.city);
            form.set('state', this.company_details.state);
            form.set('zip', this.company_details.zip);
            form.set('telephone', this.company_details.telephone);
            form.set('phone_ext', this.company_details.phone_ext);
            form.set('letter', this.company_details.letter);
            form.set('closing', this.company_details.closing ? this.company_details.closing : '');
            form.set('exec_name', this.company_details.exec_name);
            form.set('exec_position', this.company_details.exec_position);
            form.set('exec_name2', this.company_details.exec_name2);
            form.set('exec_position2', this.company_details.exec_position2);
            form.set('exec_name3', this.company_details.exec_name3);
            form.set('exec_name3', this.company_details.exec_name3);
            form.set('exec_position3', this.company_details.exec_position3);
            form.set('disclaimer', this.company_details.disclaimer);
            form.set('report_footer', this.company_details.report_footer);
            form.set('month', this.company_details.month);
            form.set('day', this.company_details.day);
            form.set('year', this.company_details.year);
            form.set('base_pay_heading', this.company_details.base_pay_heading);
            form.set('other_cash_heading', this.company_details.other_cash_heading);
            form.set('company_paid_heading', this.company_details.company_paid_heading);
            form.set('total_compensation_heading', this.company_details.total_compensation_heading);
            form.set('company_designation', this.company_details.company_designation);
            form.set('color1', this.company_details.color1);
            form.set('color2', this.company_details.color2);
            form.set('color3', this.company_details.color3);
            form.set('color4', this.company_details.color4);
            form.set('currency_symbol', this.company_details.currency_symbol);
            form.append("logo", this.company_details.logo);

            form.set('company_name_email', this.company_details.company_name_email ? this.company_details.company_name_email : '');
            form.set('dd_field_message_email', this.company_details.dd_field_message_email ? this.company_details.dd_field_message_email : '');
            form.set('closing_email', this.company_details.closing_email ? this.company_details.closing_email : '');
            form.set('exec_name_email', this.company_details.exec_name_email ? this.company_details.exec_name_email : '');
            form.set('ending_date_label', this.company_details.ending_date_label ? this.company_details.ending_date_label : '');

            form.set('base_pay_hourly_heading', this.company_details.base_pay_hourly_heading ? this.company_details.base_pay_hourly_heading : '');
            form.set('other_cash_hourly_heading', this.company_details.other_cash_hourly_heading ? this.company_details.other_cash_hourly_heading : '');
            form.set('company_paid_hourly_heading', this.company_details.company_paid_hourly_heading ? this.company_details.company_paid_hourly_heading : '');
            form.set('total_compensation_hourly_heading', this.company_details.total_compensation_hourly_heading ? this.company_details.total_compensation_hourly_heading : '');
            form.set('welfare_benefits_total_heading', this.company_details.welfare_benefits_total_heading ? this.company_details.welfare_benefits_total_heading : '');
            form.set('time_off_benefits_total_heading', this.company_details.time_off_benefits_total_heading ? this.company_details.time_off_benefits_total_heading : '');
            form.set('insurance_benefits_total_heading', this.company_details.insurance_benefits_total_heading ? this.company_details.insurance_benefits_total_heading : '');
            form.set('special_benefits_total_heading', this.company_details.special_benefits_total_heading ? this.company_details.special_benefits_total_heading : '');
            form.set('benefits_total_heading', this.company_details.benefits_total_heading ? this.company_details.benefits_total_heading : '');

            /** New code strat */
            form.set('retirement_benefits_total_heading', this.company_details.retirement_benefits_total_heading ? this.company_details.retirement_benefits_total_heading : '');
            form.set('base_pay_new_heading', this.company_details.base_pay_new_heading ? this.company_details.base_pay_new_heading : '');
            form.set('other_benefits_information_heading', this.company_details.other_benefits_information_heading ? this.company_details.other_benefits_information_heading : '');
            form.set('other_cash_benefits_heading', this.company_details.other_cash_benefits_heading ? this.company_details.other_cash_benefits_heading : '');
            /** Hourly Pay code  */
            form.set('other_benefits_information_heading_hourly', this.company_details.other_benefits_information_heading_hourly ? this.company_details.other_benefits_information_heading_hourly : '');
            form.set('other_cash_benefits_heading_hourly', this.company_details.other_cash_benefits_heading_hourly ? this.company_details.other_cash_benefits_heading_hourly : '');
            form.set('base_pay_new_heading_hourly', this.company_details.base_pay_new_heading_hourly ? this.company_details.base_pay_new_heading_hourly : '');
            form.set('welfare_benefits_total_heading_hourly', this.company_details.welfare_benefits_total_heading_hourly ? this.company_details.welfare_benefits_total_heading_hourly : '');
            form.set('time_off_benefits_total_heading_hourly', this.company_details.time_off_benefits_total_heading_hourly ? this.company_details.time_off_benefits_total_heading_hourly : '');
            form.set('insurance_benefits_total_heading_hourly', this.company_details.insurance_benefits_total_heading_hourly ? this.company_details.insurance_benefits_total_heading_hourly : '');
            form.set('special_benefits_total_heading_hourly', this.company_details.special_benefits_total_heading_hourly ? this.company_details.special_benefits_total_heading_hourly : '');
            form.set('retirement_benefits_total_heading_hourly', this.company_details.retirement_benefits_total_heading_hourly ? this.company_details.retirement_benefits_total_heading_hourly : '');
            
            axios.post( this.url + endpoint, form ).then((response) => {
                if(response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    if( this.editcompany && this.editcompany.id ) {
                        setTimeout(() => {location.reload()}, 3000);
                    } else {
                        location.href = app.url + '/webapp/companies';
                    }
                } else {
                    app.showFormError(response.data.data.key, response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        showConfirmation() {
            Swal.fire({
                title: '<div><h2>Digital Delivery</h2><hr></div>',
                //text: "You won't be able to revert the data!",
                html: `
                <div class="com_popup">
                    <p class="mb-3">With Digital Delivery, COMPackage will send your employee an email to the address you specify. That email (second image) will have a link that tells the employee how to access their report.</p>
                    <p>Here are the steps:</p>
                    <ol>
                    <li>
                        <p>In the Loader template, you’ll need three new columns:</p>
                        <ol class="sub_ol" type="a">
                        <li><strong>Digital Delivery:</strong> For all employees in which you have a “1” or “Yes” or anything in the column, Digital Delivery will be enabled.</li>
                        <li><strong>Digital Delivery ID:</strong> This is to validate the account. An example might be the last four digits of the employee’s social security number (or any other unique identifier that both you and only the employee know).</li>
                        <li><strong>Employee’s Email:</strong> for the email addresses of each employee to whom you wish to digitally deliver.</li>
                        </ol>
                    </li>
                    <li>
                        <p>If you’re not using the Loader, then you must:</p>
                        <ol class="sub_ol" type="a">
                        <li>Populate each employee’s Digital Delivery ID manually in the employee record.</li>
                        <li>Populate each employee’s email manually in the employee record.</li>
                        <li>Click the Allow Digital Delivery toggle in each employee’s record.</li>
                        </ol>
                    </li>
                    <li>
                        <p>Whether you are using the Loader or sending manually, here’s how it will work:</p>
                        <ol class="sub_ol_roman" type="i">
                        <li>The employee will enter their email and their Digital Delivery ID (see 1b above)</li>
                        <li>The employee clicks “Get One-time passcode”(OTP)</li>
                        <li>The system will send an OTP to the employee’s email.</li>
                        <li>The employee enters the OTP and presses Submit (button changes from “Get One-time passcode” to “Submit”).</li>
                        <li>The system provides the employee a link.</li>
                        <li>The employee clicks the link to generate the report in their browser. This report can then be viewed or printed by the employee.</li>
                        </ol>
                    </li>
                    <li>
                        <p>On the <strong>Company Profile</strong> page, you’ll see the form shown below (first image below). For Digital Delivery you must enter at a minimum:</p>
                        <ol class="sub_ol" type="a">
                        <li>COMPANY NAME for the email</li>
                        <li>DIGITAL DELIVERY MESSAGE for the email</li>
                        </ol>
                        <p class="mb-3">These actual words are used for the email to your employees (second image below). Test this by sending an email to yourself.</p>
                    </li>
                    <li>To send to employee(s), click on their name(s) in the Employee tab and then click Digital Delivery.</li>
                    </ol>
                </div>
                <div class="popup_img_border text-center mb-3 ml-4"><img src="${this.url}/images/comp_3.png"></div>
                <div class="popup_img_border text-center mb-3 ml-4"><img src="${this.url}/images/comp_8.jpg"></div>
                <div class="popup_img_border text-center mb-3 ml-4"><img src="${this.url}/images/comp_dd_1.png"></div>
                `,
                //icon: '<img :src="getImageUrl("comp_7.jpg")">',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Close'
            });
        },
        updatePhoto( e ) {
            this.company_details.logo = e.target.files[0];
            this.company_details.logo_url = URL.createObjectURL(e.target.files[0]);
        },
        /* Show error message on the form */
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
            // moveUp();
        }
    }
}
</script>
<style>
    :where(.swal2-container) :where(.swal2-popup) {
    width: 60em !important; /* Set the desired width */
    }
    .com_popup {
        text-align: left !important;
    }

    .com_popup ol {
        list-style: decimal;
        margin-inline: 20px;
        margin-bottom: 20px;
    }
    .com_popup ol.sub_ol {
        list-style: lower-alpha;
    }
    .com_popup ol.sub_ol_roman {
        list-style: lower-roman;
    }
    .popup_img_border img {
        border: solid 2px #999;
    }
</style>
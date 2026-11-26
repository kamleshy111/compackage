@extends('layouts.public')

@section('content')
<div class="container mx-auto px-3.5">
        <div class="row flex flex-wrap">
            <div class="w-full md:w-[60%] lg:w-[70%]">
                <div class="h-full bg-white py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                    <h1 class="border-b border-lgray pb-3 mb-4 md:pb-5 md:mb-5 text-xl md:text-3xl text-greendarkclr font-bold">Benefit Statement Software Frequently Asked Questions</h1>
                    <h2 class="mb-5 text-3xl text-greendarkclr font-bold">Questions and Answers About COMPackage Employee Benefit Statement Software and Personalized Benefit Statements</h2>
                    <p class="font-serif text-[13px] text-dgray mb-3">If you’ve never worked with personalized benefit statements before, you may initially have some questions about COMPackage’s <a class="text-greendarkclr underline" href="{{route('totalCompensationDemo')}}">benefit statement software</a>. How will this technology help me? Is it easy to use? What are the benefits of using COMPackage benefit statement software over an outside source? Over the years, we’ve collected the questions we most often receive from clients, and we’ve assembled them all on one easy-to-read page. We’ve provided answers to these and other questions below.</p>    
                    <p class="font-serif text-[13px] text-dgray mb-3">If you have a question about personalized benefit statements that is not listed below, feel free to <a class="text-greendarkclr underline" href="{{route('contact')}}">contact us</a> today.</p>

                    <!-- <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Can COMPackage's benefit statement software help resolve employee-related issues such as high turnover, poor productivity and low morale?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>A lack of consistent, accurate and reliable <a class="text-greendarkclr underline" href="{{route('employeePerformanceReviews')}}">employee communications</a> is at the heart of many of these problems. There is a disconnect in communicating the difference between the actual dollar value of an employee's total compensation and the perceived value that an employee realizes when he/she reads the "after tax amount" recorded on their paycheck, which represents only about 50% to 65% of their total compensation. The employer's financial commitment to provide competitive wages, security, safety and future economic health for their employees is seldom communicated and many times, this lack of communication results in the difference between productive, <a class="text-greendarkclr underline" href="http://blog.compackage.com/how-can-benefit-statement-software-help-reduce-my-turnover/" target="_blank">loyal employees</a> and poor job performance caused by low <a class="text-greendarkclr underline" href="http://blog.compackage.com/twenty-creative-employee-outings/" target="_blank">employee morale</a>. It can be a costly miscalculation for the employer who does not realize the importance of providing accurate and timely communication in not reporting sensitive compensation information to their employees on personalized benefit statements.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Our company needs an easy solution that does not require technical know-how. Will your <a class="text-greendarkclr underline" href="{{route('totalCompensationDemo')}}">benefit statement software</a> be too technical for our small company?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Whether you have one employee or 3,000 employees, COMPackage can provide a simple solution and allow you to better communicate with your employees. Your employees deserve to know how much you they are really worth - usually 40% more than their base salary – why not tell them so? The "Report Builder" is menu-driven with help screens that take you through a simple five-step process. Most personalized employee benefit statements (the ones that you choose to do one-at-a-time) take about six minutes to build and can be printed at any time on demand, within seconds. Read our blog post on how <a class="text-greendarkclr underline" target="_blank" href="http://blog.compackage.com/how-big-should-my-company-be-to-consider-employee-benefit-statements/">companies of all sizes</a> can benefit from total compensation software or learn more about our <a class="text-greendarkclr underline" href="{{route('smallBusinessBenefitsSoftware')}}">compensation software for small businesses</a>.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>When should I use the personalized compensation and fringe benefit statements?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>COMPackage Total Compensation Reports can be used for <a class="text-greendarkclr underline" href="{{route('employeeYearEndReports')}}">year-end reporting</a>, <a class="text-greendarkclr underline" href="{{route('employeePerformanceReviews')}}">employee performance reviews</a>, <a class="text-greendarkclr underline" target="_blank" href="http://blog.compackage.com/save-reducing-employee-turnover/">employee retention</a>, and even <a class="text-greendarkclr underline" href="{{route('employeeRecruitment')}}">recruitment strategies</a>.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How can I customize COMPackage Benefit Statements for my unique company requirements?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>The beauty of COMPackage is that it automatically customizes each personalized benefit statement when you input the information into the "Report Builder" database. Each report that you build is unique and exclusive to your company and your people. Custom information on each personalized benefit statement includes: your company name, address and employee communications policy statement, personal information about each employee, a list of standard benefits that you offer to all of your employees and the special benefits or fringe benefits that pertain to individual employees.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Will confidential employee information be secure when using COMPackage? Can personalized employee benefit information be hijacked, hacked or misappropriated by others?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>With COMPackage's personalized benefit statements, your information is never at risk. All employee name info is encrypted so that no Internet hacker could identify which person the financial data belongs to.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Does the <a class="text-greendarkclr underline" href="{{route('compensationStatementPricing')}}">pricing of employee benefit statements</a> have any flexibility within the package prices?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Yes. Single statements in addition to limited quantity packages are only $20 per report, with the purchase of any package. Extra reports also make great recruitment tools for new employees throughout the year.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>I only have a few employees and don't need 15 licenses. Isn't there a way to buy only a few?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Presently, there's nothing on the market that we know of available for less that 50 - 100 employees, so let's say you only have 5 employees? For $299.00, or less than $50.00 each, you have a best practice productivity tool available to your small company. If you tried to emulate this copyrighted benefit statement software yourself, it could take you an endless number of hours. Your time is worth more than $299.00, isn't it?</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Times are tough. Why would I want to use personalized benefit statements, especially if we're cutting back on compensation strategies?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Now is the most important time for personalized benefit statements. Your employees should know that their package is 40% more than their pay. The best way to tell your employees about the value they bring to your company is through Total Compensation Reports. These statements will assure them that your company is doing the best it can to reward its employees and keep them satisfied in an economic downturn.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>We have our employee data in a database. Is there an easy way to load this into COMPackage's benefit software?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Yes. If you can export your employee data to Excel, or to any file than can be opened in Excel, one employee per line, your data can easily be imported into COMPackage using the Employee LOADER feature.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How long does it take to input 100 or 1000 employees into COMPackage?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Not long at all! Before COMPackage developed the Employee LOADER, it took 5-10 minutes to create each employee record. Using the Employee LOADER, you can import all of your employees from an Excel file. If you have, or can create, an Excel file of your employees, it takes a few minutes to map your column headings to the headings in COMPackage. Once that's done, importing employees takes only minutes, whether you have 100 or 1,000 employees.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>We do our employee reporting using a manual system we created. Are there benefits to using COMPackage benefit statement software instead?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-6"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Customers tell us that creating total compensation reports internally takes days or weeks to complete. COMPackage lets you accomplish this in a few hours, and provides compelling, colorful, professional reports that clearly present the employee’s total compensation package.</p>
                    <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>We use an outside service for our personalized benefit statements. Are there benefits to using COMPackage instead?</p>
                    <p class="font-serif text-[13px] text-[#436ae9] mb-8"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Yes. Firstly, there is cost savings. For example, if you have 5000 employees, the cost can be less than $0.40 per employee. In contrast, many companies outsource this function for tens of thousands of dollars. Also, companies tell us that even though they outsource this function, there is a level of effort to prepare employee files for the vendor providing the reports. In fact, using COMPackage can take you less time than you currently take in outsourcing your personalized benefit statements. Choose the <a class="text-greendarkclr underline" href="{{route('compensationStatementPricing')}}">price package</a> that is right for you!</p> -->
                    
                    <div class="benefit_sw_faq">                    
                        <h2 class="font-serif text-base mb-2 font-bold">Frequently Asked Questions</h2>
                        <p>To view the answer to a question, please click on the question.</p>
                        <p class="mb-2">Re-click on the question again to hide the answer.</p>
                        <div class="faq_question pr-3">
                            <!-- <div class="accordion_img open"> -->
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>I am having issues with importing my Excel <span class="underline">CSV</span> data on the Employee Loader page.</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Below are common steps to follow before importing your Excel <span class="underline">CSV</span> sheet.</p>
                                <h3 class="pl-5">Before Importing – Check your data-filled Excel <span class="underline">CSV</span> file for the following:</h3>
                                <ol class="ollist_revert">
                                    <li>Download the COMPackage Employee Loader template, or create your own Excel CSV file.</li>
                                        <ul class="ullist_revert">
                                            <li>The First Name, Last Name, Address, City, State, Zip Code (Canadian Province postal codes) and Group/Department are the only fields that can have letters within the fields. <span class="underline">The headings for these need to match the headings in the COMPackage template.</span> All other fields should have either a 0, a blank cell, or a yearly dollar value.</li>
                                            <li>If you are using the COMPackage template, any of the columns can be removed or customized to your own benefit name.</li>
                                            <li>The custom benefit names that you include in your spreadsheet must be labeled exactly the same in the Benefits section in COMPackage for them to match up properly after importing.</li>
                                            <li>The fields in the State column must either contain the two-letter abbreviation or a blank field. If there is any extra spaces after the two-letter state/province abbreviation or if the entire state/province name is filled out, the import will fail.</li>
                                            <li>All yearly dollar amounts must be in a two decimal point format, for example $150 would be 150.00 and $19.0930303 would be 19.09.</li>
                                            <li>Zip codes with a 0 in front must be saved as text, so that the 0 is recognized in the import.</li>
                                        </ul>
                                    <li>Save the file as a <span class="underline">CSV</span>.</li>
                                    <li>Select the <span class="underline">CSV</span> file and click the Next button.</li>
                                    <li>Match up the benefits that you would like to import. All benefits from COMPackage are on the left side and must be matched with all of the custom benefit names from your <span class="underline">CSV</span> on the right side. Select the Next button.</li>
                                <li>Go through the list of imported employees to confirm that all employee names are correct. The Employee’s Names and ID’s are NOT editable after importing.</li>
                                    <li>Once you are sure that everything is correct, select the Next button.</li>
                                    <li>Review the list and select the ‘Commit Import’ button.</li>
                                        <ul class="ullist_revert">
                                            <li>NOTE: If you receive an error, this usually indicates an issue with something in the <span class="underline">CSV</span>. Review the list of importing rules above, and if you still need additional assistance, contact <a href="mailto:support@compackage.com">support@compackage.com</a>.</li>
                                        </ul>
                                  </ol>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How does Hourly Pay Functionality with Hourly Top Box Scores work?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>COMPackage lets you show employees what their total hourly compensation is. You can enable Hourly Pay Functionality by either a) putting a “1” in the Hourly column in the loader CSV or b) toggling the Hourly Pay Functionality button on the page for any given employee. This will create a second set of top box scores with .</p>
                                <ol class="ollist_revert">
                                    <li>Base Hourly (e.g., $28/hr.)</li>
                                    <li>Other Cash Ben/hr. (the total other cash benefits divided by the number of hours worked).</li>
                                    <li>Benefits/hr. (the total other benefits divided by the number of hours worked).</li>
                                    <li>Total Pkg./hr. (the combined hourly rate with all benefits taken into consideration).</li>
                                </ol>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How might I use Illuminative Metrics™?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Users can now include other benefits which will be excluded from any totals, and include them anywhere on the sheet that you desire. For example, one client wanted to show revenue per mile driven and revenue per day driven. They wanted to highlight both of these. Neither are in addition to the employee’s compensation, but both were important. As these have ability to choose whether you make it bold, italic, and/or have a dollar sign, they were able to implement as follows:</p>
                                <h3>Total Comp per Day Worked: $186.29</h3>
                                <p># Days Worked (to calculate comp/day): 330</p>
                                <h3>Total Comp per Mile Driven: $.49</h3>
                                <p>Total Miles Driven (to calculate comp/mile): 125,000</p>
                                <p>Other clients want to show ESOP granted, but income is not affected until some future point in time. But the granting is important. The section is a great area to express important information as text that are not additive to past compensation. Be creative! Here are several more idea starters: stock granted, your stock value as of 12/31/XX, key account value contracted, your H1B Fees paid, work from home estimated value, # of vacation days earned. The possibilities are only limited to your imagination and benefit programming.</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I remove a company?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>You must have a Professional Version account to utilize this feature. To remove a company, contact Tech Admin at <a href="mailto:support@compackage.com">support@compackage.com</a> for assistance. ALL data, including employee information, associated with the company will be permanently removed.</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I add users?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>You must have a Professional Version account to utilize this feature. If you would like to utilize this feature, but are not a professional account user, please contact <a href="mailto: support@compackage.com">support@compackage.com</a> to upgrade your purchase.</p>
                                <ul class="ullist_revert">
                                    <li>Click on the Utilities tab.</li>
                                    <li>Select the Users tab.</li>
                                    <li>Select the Add New User button.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I commit employees and remove the watermark from reports?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>If you have a Standard license, you can add and delete employees at will until you commit them. Until you commit them, any reports you generate for an employee will have a large watermark on it. This allows you to experiment with your loader CSV file repeatedly until you’re sure you’ve loaded your data correctly. Once you commit an employee, it irreversibly decrements your overall count. To commit an employee: .</p>
                                <ul class="ullist_revert">
                                    <li>Click the Employees tab.</li>
                                    <li>Click on the box next to the employee(s) you wish to commit.</li>
                                    <li>Click on Final Commit.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I remove employee(s) from my account?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>To permanently delete an employee:</p>
                                <ul class="ullist_revert">
                                    <li>Click the Employees tab.</li>
                                    <li>Select the employees that you would like removed by checking the box next to their name. Click the Select All button to select all employees on your current page.</li>
                                    <li>Click Delete Selected Employees to remove the employees permanently.</li>
                                    <li><span>NOTE:</span>Once an employee has been deleted, their information cannot be recovered.</li>
                                </ul>
                                <p>If you are a Standard user, you can only delete employees you have not committed. See above for committing employees. </p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I make employee(s) inactive?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>When you make an employee inactive, it simply hides the employee from view. If you have a Standard license, inactive employees are still part of your overall count. To make employees inactive:</p>
                                <ul class="ullist_revert">
                                    <li>Select the Employees tab.</li>
                                    <li>Select the employees that you would like to make inactive. Click the box next to Select to select all employees on the current page.</li>
                                    <li>Choose Mark as inactive from the dropdown</li>
                                    <li>Click Apply.</li>
                                </ul>
                                <p>To reactivate inactive employees:</p>
                                <ul>
                                    <li>Click on the View Census dropdown and select All Inactive Employees</li>
                                    <li>Select the employees that you would like to reactivate. Click the box next to Select to select all employees on the current page.</li>
                                    <li>Choose Mark as active from the dropdown.</li>
                                    <li>Click Apply.</li>
                                </ul>
                                <p>If you are a Standard user, you can only delete employees you have not committed. See above for committing employees. </p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Can I move benefits around to different categories?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>You can move any benefit category to a different section on your reports. This can be done by un-checking the section (e.g., Overtime). Then, curser down to the Custom Benefits section to check the box next to Custom Benefit. Add the category name (e.g., Overtime) and use the dropdown to select where you’d like the benefit to appear.</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Can I sort my employee list?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>There are several headings that have an up/down arrow to the right. Clicking on these does an alphanumeric sort. Clicking again does a reverse sort.</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I keep the report from printing onto two pages?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>There are two reasons why the report will print onto two pages. Listed below are ways to manage the amount of pages that the report prints onto.</p>
                                <ol class="ollist_revert">
                                    <li>The copy in the letter to employee is too long. Consider shortening it.</li>
                                    <li>The number of benefits in either column is very long. If it’s important to get this on one page, there are a number of things you can do. You can possibly move some benefits from one column/category to another. You can consolidate some of your benefits, e.g., PTO instead of three separate time-off benefits. If it is still going onto a second page, congratulations for your generosity, and consider showing two pages just to those employees.</li>
                                </ol>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I upload a logo?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>To upload a new logo:</p>
                                <ul class="ullist_revert">
                                    <li>Go to the Company Profile tab.</li>
                                    <li>Click Choose File and select your JPEG image.</li>
                                    <li>Click Save Information.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How can I customize any of: year-ending date, employee letter, report disclaimer, report footers, and report colors?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>All of these are editable in the Company Profile tab.</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Can the top box headings and gray bar section names be changed in reports?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>Yes – these are easily edited on the right side of the Company Profile page.</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I view/print Employee Reports?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>To view/print reports:</p>
                                    <ul class="ullist_revert">
                                        <li>For an individual employee,
                                            <ul class="ullist_revert">
                                                <li>Click Employees then click on the employee name for whom you wish to view or print a report.</li>
                                                <li>Click Create PDF Report</li>
                                                <li>The report will be displayed in your browser – and you can print or save from there</li>
                                             </ul>
                                         </li>   
                                        <li>For multiple employees
                                            <ul class="ullist_revert">
                                                <li>Select the employees that you would like to print reports for, or you can select all by clicking on the box next to the SELECT heading.</li>
                                                <li>Click Download/Print. A file called COMPackage Reports.zip will be created. Save this to your computer.</li>
                                             </ul> 
                                        </li>  
                                    </ul>
                                <h3 class="text-[13px]">To View and/or Print Reports - Windows</h3>
                                <ul class="ullist_revert">
                                    <li>Right-click the folder and select "Extract All."</li>
                                    <li>Select all the files (Ctrl-a)</li>
                                    <li>Right-click on any selected file and select Print. This will print all selected files.</li>
                                </ul>
                                <h3 class="text-[13px]">To View and/or Print Reports - Mac</h3>
                                <ul class="ullist_revert">
                                    <li>Double-click the .zip file to extract it</li>
                                    <li>In the extracted folder, select all of the files (Command-a) or just the files you want to print by holding down the Command key and clicking once on each file.</li>
                                    <li>Once you have the files you want to print selected, choose File > Print from the main Mac menu.</li>
                                </ul>
                                <p>If you want to view a single report, click on the employee's name and then click "Create PDF Report."</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How can I digitally deliver (notified by email and viewable on our portal) reports?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>With Digital Delivery, COMPackage will send your employee an email to the address you specify. That email will have a link that tells the employee how to access their report. Click here for detailed instructions with examples.</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>Is there a limit to the number of benefits?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>COMPackage has more benefits than you could conceivably use. There are 90 standard benefit entries that you can rename at will. There are 5 benefit slots where you can provide benefits with no financial value, e.g., company picnic. There are 40 custom benefit fields – to name and place as you choose. And 10 fields for our exclusive Illuminative Metrics™ - these are benefits that are not included in total compensation calculations (e.g., ESOP value). If you exceed all of these, please give me a call – because I want to come work for you!</p>
                            </div>
                        </div>
                        <div class="faq_question pr-3">
                            <div class="accordion_img">
                                <p class="font-serif text-base text-black mb-3 font-bold"><span class="text-greendarkclr">Q.</span>How do I not show a benefit category name on any employee report who does not earn said benefit?</p>
                                <span class="arrow_accordion_down"><img style="width:25px;" src="{{ asset('images/arrow-accordion-down.png') }}" alt=""></span>
                            </div>
                            <div style="display: none;" class="faq_answer pl-4 pb-5">
                                <p class="font-serif text-[13px] text-[#436ae9] mb-2"><span class="text-red-800 font-bold mr-1 text-[15px]">A.</span>If you put a zero or do not input any value in the employee’s applicable field, the benefit category does not appear on the statement.</p>
                            </div>
                        </div>
                	</div>
                    
                    <p class="font-serif text-[13px] text-dgray">If you would like more information about COMPackage's personalized benefit statements, please <a class="text-greendarkclr underline" href="{{route('contact')}}">contact us</a> today.</p>                    
                </div>
            </div>
            <div class="w-full md:w-[40%] lg:w-[30%] py-5 px-5 lg:pt-20 lg:pb-5 lg:px-8 bg-bgbrwn">
                <public-sidebar pcurrent_route="{{ url()->current() }}"></public-sidebar>
            </div>
        </div>
</div>
<div class="container mx-auto px-3.5">
    <div class="bg-greendarkclr p-5 rounded-b-lg"></div>
</div>
@endsection
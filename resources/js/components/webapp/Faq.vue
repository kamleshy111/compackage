<template>
    <div>
        <div class="card mb-3" v-for="item in items" :key="item.id">
            <div class="cursor-pointer card-header" @click.prevent="toggleExpand(item)">
                <span class="mr-1 font-bold text-base text-greendarkclr">Q.</span><span class="font-bold" v-html="item.title"></span>
            </div>
            <div class="card-body h-0 overflow-hidden transition-[0.3s]" :ref="'content' + item.id" :style="[item.isExpand ? {height: item.computedHeight} : {}]">
                <div class="card-content">
                    <span class="mr-1 font-bold text-base text-red-600">A.</span><span v-html="item.content"></span>
                    <div class="pl-8" v-for="childitem in item.listContent">
                        <div v-html="childitem.contentOl"></div>
                    </div>
                    </div>
            </div>
            
        </div>
    </div>
</template>

<script>
export default {
    
    data() {
        return {
            items:[
                {
                id: 1,
                title: "I am having issues with importing my Excel <u>CSV</u> data on the Employee Loader page.",
                content: "Below are common steps to follow before importing your Excel <u>CSV</u> sheet.",
                listContent:[
                    {
                        contentOl:"<ol class='pt-2 list-decimal'><li>Download the COMPackage Employee <u>Loader</u> template, or create your own Excel <u>CSV</u> file.<ul class='pl-5 list-disc text-base text-black'><strong>Before Importing – Check your data-filled Excel <u>CSV</u> file for the following:</strong><li>The First Name, Last Name, Address, City, State, Zip Code (Canadian Province postal codes) and Group/Department are the only fields that can have letters within the fields. <u>The headings for these need to match the headings in the COMPackage template.</u> All other fields should have either a 0, a blank cell, or a yearly dollar value.</li><li>If you are using the COMPackage template, any of the columns can be removed or customized to your own benefit name.</li><li>The custom benefit names that you include in your spreadsheet must be labeled exactly the same in the Benefits section in COMPackage for them to match up properly after importing.</li><li>The fields in the State column must either contain the two-letter abbreviation or a blank field. If there is any extra spaces after the two-letter state/province abbreviation or if the entire state/province name is filled out, the import will fail.</li><li>All yearly dollar amounts must be in a two decimal point format, for example $150 would be 150.00 and $19.0930303 would be 19.09.</li><li>Zip codes with a 0 in front must be saved as text, so that the 0 is recognized in the import.</li></ul></li><li>Save the file as a CSV.</li><li>Select the CSV file and click the Next button.</li><li>Match up the benefits that you would like to import. All benefits from COMPackage are on the left side and must be matched with all of the custom benefit names from your <u>CSV</u> on the right side. Select the Next button.</li><li>Go through the list of imported employees to confirm that all employee names are correct. The Employee’s Names and ID’s are NOT editable after importing.</li><li>Once you are sure that everything is correct, select the Next button.</li><li>Review the list and select the 'Commit Import' button.<ul class='pl-5 list-disc text-base text-black'><li><strong>NOTE</strong>: <em>If you receive an error, this usually indicates an issue with something in the <u>CSV</u>. Review the list of importing rules above, and if you still need additional assistance, contact <a class='text-greendarkclr underline' href='mailto:support@compackage.com'>support@compackage.com</a>.</em></li></ul></li></ol>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 2,
                title: "How does Hourly Pay Functionality with Hourly Top Box Scores work?",
                content: "COMPackage lets you show employees what their total hourly compensation is. You can enable Hourly Pay Functionality by either a) putting a “1” in the Hourly column in the loader CSV or b) toggling the Hourly Pay Functionality button on the page for any given employee. This will create a second set of top box scores with",
                listContent:[
                    {
                        contentOl:"<ol class='pl-2 list-decimal text-base text-black'><li>Base Hourly (e.g., $28/hr.)</li><li>Other Cash Ben/hr. (the total other cash benefits divided by the number of hours worked)</li><li>Benefits/hr. (the total other benefits divided by the number of hours worked)</li><li>Total Pkg./hr. (the combined hourly rate with all benefits taken into consideration)</li></ol>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 3,
                title: "How might I use Illuminative Metrics™?",
                content: "Users can now include other benefits which will be excluded from any totals, and include them anywhere on the sheet that you desire. For example, one client wanted to show revenue per mile driven and revenue per day driven. They wanted to highlight both of these. Neither are in addition to the employee’s compensation, but both were important. As these have ability to choose whether you make it bold, italic, and/or have a dollar sign, they were able to implement as follows:<br><br><p><strong>Total Comp per Day Worked: $186.29</strong></p><p># Days Worked (to calculate comp/day): 330</p><p><strong>Total Comp per Mile Driven: $.49</strong></p><p>Total Miles Driven (to calculate comp/mile): 125,000</p><br><p>Other clients want to show ESOP granted, but income is not affected until some future point in time. But the granting is important. The section is a great area to express important information as text that are not additive to past compensation. Be creative! Here are several more idea starters: stock granted, your stock value as of 12/31/XX, key account value contracted, your H1B Fees paid, work from home estimated value, # of vacation days earned. The possibilities are only limited to your imagination and benefit programming.</p>",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 4,
                title: "How do I remove a company?",
                content: "You must have a Professional Version account to utilize this feature. To remove a company, contact Tech Admin at <a class='text-greendarkclr underline' href='mailto:support@compackage.com'>support@compackage.com</a> for assistance. ALL data, including employee information, associated with the company will be permanently removed.",
                
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 5,
                title: "How do I add users?",
                content: "You must have a Professional Version account to utilize this feature. If you would like to utilize this feature, but are not a professional account user, please contact <a class='text-greendarkclr underline' href='mailto:support@compackage.com'>support@compackage.com</a> to upgrade your purchase.",
                listContent:[
                    {
                        contentOl:"<ul class='pl-2 list-disc text-base text-black'><li>Click on the Utilities tab.</li><li>Select the Users tab.</li><li>Select the Add New User button.</li></ul>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 6,
                title: "How do I commit employees and remove the watermark from reports?",
                content: "If you have a Standard license, you can add and delete employees at will until you commit them. Until you commit them, any reports you generate for an employee will have a large watermark on it. This allows you to experiment with your loader CSV file repeatedly until you’re sure you’ve loaded your data correctly. Once you commit an employee, it irreversibly decrements your overall count. To commit an employee:",
                listContent:[
                    {
                        contentOl:"<ul class='pl-2 list-disc text-base text-black'><li>Click the <em>Employees<em> tab.</li><li>Click on the box next to the employee(s) you wish to commit.</li><li>Click on Final Commit.</li></ul>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 7,
                title: "How do I remove employee(s) from my account?",
                content: "To permanently delete an employee:",
                listContent:[
                    {
                        contentOl:"<ul class='pl-2 mb-3 list-disc text-base text-black'><li>Click the Employees tab.</li><li>Select the employees that you would like removed by checking the box next to their name. Click the Select All button to select all employees on your current page.</li><li>Click Delete Selected Employees to remove the employees permanently.</li><li><strong>NOTE: </strong>Once an employee has been deleted, their information cannot be recovered.</li></ul><p>If you are a Standard user, you can only delete employees you have not committed. See above for committing employees.</p>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 8,
                title: "How do I make employee(s) inactive?",
                content: "When you make an employee inactive, it simply hides the employee from view. If you have a Standard license, inactive employees are still part of your overall count. To make employees inactive:",
                listContent:[
                    {
                        contentOl:"<ul class='pl-2 mb-3 list-disc text-base text-black'><li>Select the Employees tab.</li><li>Select the employees that you would like to make inactive. Click the box next to <em>Select</em> to select all employees on the current page.</li><li>Choose <em>Mark as inactive</em> from the dropdown.</li><li>Click Apply.</li></ul><p>To reactivate inactive employees:</p><ul class='pl-2 mb-3 list-disc text-base text-black'><li>Click on the View Census dropdown and select <em>All Inactive Employees</em>.</li><li>Select the employees that you would like to reactivate. Click the box next to Select to select all employees on the current page.</li><li>Choose Mark as active from the dropdown.</li><li>Click <em>Apply</em>.</li></ul>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 9,
                title: "Can I move benefits around to different categories?",
                content: "You can move any benefit category to a different section on your reports. This can be done by un-checking the section (e.g., Overtime). Then, curser down to the Custom Benefits section to check the box next to Custom Benefit. Add the category name (e.g., Overtime) and use the dropdown to select where you’d like the benefit to appear.",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 10,
                title: "Can I sort my employee list?",
                content: "There are several headings that have an up/down arrow to the right. Clicking on these does an alphanumeric sort. Clicking again does a reverse sort.",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 11,
                title: "How do I keep the report from printing onto two pages?",
                content: "There are two reasons why the report will print onto two pages. Listed below are ways to manage the amount of pages that the report prints onto.",
                listContent:[
                    {
                        contentOl:"<ol class='pl-2 mb-3 list-decimal text-base text-black'><li>The copy in the letter to employee is too long. Consider shortening it.</li><li>The number of benefits in either column is very long. If it’s important to get this on one page, there are a number of things you can do. You can possibly move some benefits from one column/category to another. You can consolidate some of your benefits, e.g., PTO instead of three separate time-off benefits. If it is still going onto a second page, congratulations for your generosity, and consider showing two pages just to those employees.</li></ol>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 12,
                title: "How do I upload a logo?",
                content: "To upload a new logo:",
                listContent:[
                    {
                        contentOl:"<ul class='pl-2 mb-3 list-disc text-base text-black'><li>Go to the <em>Company Profile</em> tab.</li><li>Click <em>Choose File</em> and select your JPEG image.</li><li><em>Click</em> Save Information.</li></ul>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 13,
                title: "How can I customize any of: year-ending date, employee letter, report disclaimer, report footers, and report colors?",
                content: "All of these are editable in the Company Profile tab.",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 14,
                title: "Can the top box headings and gray bar section names be changed in reports?",
                content: "Yes – these are easily edited on the right side of the Company Profile page.",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 15,
                title: "How do I view/print Employee Reports?",
                content: "To view/print reports:",
                listContent:[
                    {
                        contentOl:"<ul class='pl-2 mb-3 list-disc text-base text-black'><li>Go to the Company Profile tab.<ul class='pl-2 mb-3 list-disc text-base text-black'><li>Click <em>Employees</em> then click on the employee name for whom you wish to view or print a report.</li><li>Click Create <em>PDF Report</em>.</li><li>The report will be displayed in your browser – and you can print or save from there.</li></ul></li><li>For multiple employees.<ul class='pl-2 mb-3 list-disc text-base text-black'><li>Select the employees that you would like to print reports for, or you can select all by clicking on the box next to the SELECT heading.</li><li>Click Download/Print. A file called <em>COMPackage Reports.zip</em> will be created. Save this to your computer.</li></ul></li></ul><br><p><strong>To View and/or Print Reports - Windows</strong></p><ol class='pl-2 mb-3 list-decimal text-base text-black'><li>Right-click the folder and select \"Extract All.\"</li><li>Select all the files (Ctrl-a).</li><li>Right-click on any selected file and select Print. This will print all selected files.</li></ol><p><strong>To View and/or Print Reports - Mac</strong></p><ol class='pl-2 mb-3 list-decimal text-base text-black'><li>Double-click the .zip file to extract it.</li><li>In the extracted folder, select all of the files (Command-a) or just the files you want to print by holding down the Command key and clicking once on each file.</li><li>Once you have the files you want to print selected, choose File > Print from the main Mac menu.</li></ol><p>If you want to view a single report, click on the employee's name and then click \"Create PDF Report.\"</p>",
                    }
                ],
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 16,
                title: "How many reports can I print as one large PDF?",
                content: "Printing to a single PDF combining many statements can be done for up to about 400 reports. If you have more than 400 reports to print, you can either print as more than one large PDF in batches e.g., for 700, two batches of 350. Alternatively, you can download a Zip file of all reports, unzip them, and print from a folder. How many reports you can print from a folder depends on how much memory your computer has. Here again, if you have insufficient memory, you can put them in different folders and print in batches.",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 17,
                title: "How can I digitally deliver (notified by email and viewable on our portal) reports?",
                content: 'With Digital Delivery, COMPackage will send your employee an email to the address you specify. That email will have a link that tells the employee how to access their report.<a class="text-greendarkclr underline" href="'+process.env.MIX_API_URL+ '/images/Digital-Delivery-Documentation.pdf" target="_blank"> Click here for detailed instructions with examples.</a>',
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 18,
                title: "Is there a limit to the number of benefits?",
                content: "COMPackage has more benefits than you could conceivably use. There are 90 standard benefit entries that you can rename at will. There are 5 benefit slots where you can provide benefits with no financial value, e.g., company picnic. There are 40 custom benefit fields – to name and place as you choose. And 10 fields for our exclusive Illuminative Metrics™ - these are benefits that are not included in total compensation calculations (e.g., ESOP value). If you exceed all of these, please give me a call – because I want to come work for you!",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 19,
                title: "How do I not show a benefit category name on any employee report who does not earn said benefit?",
                content: "If you put a zero or do not input any value in the employee’s applicable field, the benefit category does not appear on the statement.",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 20,
                title: "Do we need to set up two separate templates using this software? Do I need one for hourly employees and salary employees?",
                content: "There is no need. Each employee has their own record, so you could easily enter information per employee type. For example, on the bulk upload, salaried employees would have a value in the Salary column, whereas hourly employees would have a value in the Hourly column and nothing in the Salary column. For each employee, the category will not appear if it’s value is blank or zero.",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 21,
                title: "What is the difference between the unlimited and professional version of COMPackage?",
                content: "The unlimited version only allows you to have one entity (company or division). The professional provides the ability to have multiple companies, subsidiaries, divisions, or departments. And can also provide for limited access to employees entering data, each with their own set of employees. This is also a good way to split up large organizations (West Coast vs. East Coast or SF Office vs. NY Office). This is the product that insurance agencies use for their customers.",
                isExpand: false,
                computedHeight: 0,
                },
                {
                id: 22,
                title: "Can I print non-committed employees (using the Standard version)?",
                content: "Yes. You can print reports for non-committed employees with a watermark on them.",
                isExpand: false,
                computedHeight: 0,
                }
            ]    
        }
    },
    methods: {
        toggleExpand(item) {
            item.isExpand = !item.isExpand;
        },
        getComputedHeight() {
            this.items.forEach(item => {
                var content = this.$refs["content" + item.id][0];
                content.style.height = 'auto';
                content.style.position = 'absolute';
                content.style.visibility = 'hidden';
                content.style.display = 'block';
                var height = 'auto';
                item.computedHeight = height;
                content.style.height = 0;
                content.style.position = null;
                content.style.visibility = null;
                content.style.display = null;
            });
        }
    },
    mounted() {
        this.getComputedHeight();
    }
}
</script>
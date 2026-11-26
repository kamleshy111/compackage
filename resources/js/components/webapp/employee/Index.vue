<template>
    <div>
        <p class="mb-1 cpation text-black text-base">Employees: {{pagination.total}}</p>

        <!-- <p class="cpation text-black text-base">You have {{permissions.user_permissions.reports}} reports left.</p> -->
        <p v-if="(permissions.user_permissions.reports >= 10000 || permissions.user_permissions.reports < 0)" class="cpation text-black text-base">You have unlimited reports.</p>

        <p class="cpation text-black text-base" v-if="(permissions.user_permissions.reports < 10000 && permissions.user_permissions.reports > 0)">
            <p><strong>Your subscription:</strong> {{ (totalreport) }} reports </p>
            <p><strong>You have:</strong> {{ commited }} committed employees and {{permissions.user_permissions.reports}} available</p>
            <!-- <p><strong>You have:</strong> {{ uncommited }} uncommitted (Active + Inactive) employees</p>
            <p><strong>You have:</strong> {{ inactiveempcount }} Inactive employees</p> -->
            <p><strong>You can load up to:</strong> {{ (totalEmployees+permissions.user_permissions.reports) - (commited+uncommited+inactiveempcount) }} more employees</p>
            <p>To load more, you must delete some uncommitted active or inactive employees. Your license doesn’t allow you to delete committed employees. If you need additional reports, please <u><a href="https://www.compackage.com/total-compensation-statements/software-purchase" style="color: #16612e;">click here</a></u> to purchase more reports.</p>

            <!--<p>To load more, you must delete some uncommitted active or inactive employees. Your license doesn’t allow you to delete committed employees. If you need additional reports, please contact <a href="mailto:support@compackage.com">support@compackage.com</a>.</p>-->

                <!-- If needed: <a class="underline text-blue-400" :href="url+'/webapp/account-information'">purchase additional reports</a>.</p> -->
        </p>
        <p v-if="! permissions.user_permissions.is_reports_expired" class="cpation text-red-600 text-base font-bold">Your reports have expired.</p>
        
        <p><br><strong>Note, if you are using Digital Delivery, you must:</strong></p>
        <p><span>1. </span>Have loaded the employee's email</p>
        <p><span>2. </span>Have loaded the Digital Delivery ID</p>
        <p><span>3. </span>Optional: If you add a "1" in the Loader file, the system will mark the employee as someone who gets Digital Delivery, but you can still subsequently send to employees who are not so marked.</p>
        <p>For detailed instructions, <a :href="url + '/images/Digital-Delivery-Documentation.pdf'" target="_blank" class="text-[#164900] underline underline-offset-1">click here.</a></p>

        <div class="my-5 flex flex-wrap -mx-2.5 items-center justify-end">
            <div class="w-full md:w-3/4 flex flex-wrap mb-3 md:mb-0 items-end">
                <div class="w-1/2 md:w-1/3 px-2.5 mb-3 md:mb-0">
                    <label>View Census</label>
                    <select v-on:change="employeeByStatus()" v-model="status"
                        class="w-full focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 form-control">
                        <option value="active">All Active Employees</option>
                        <option value="inactive">All Inactive Employees</option>
                        <option value="all">All Employees</option>
                    </select>
                </div>
                <div class="w-1/2 md:w-1/3 px-2.5">
                    <label>Supervisor</label>
                    <select v-on:change="supervisorChange()" v-model="supervisorM"
                        class="w-full focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 form-control">
                        <option value="">Supervisor</option>
                        <option v-for="supervisor in supervisors" :value="supervisor">{{supervisor}}</option>
                    </select>
                </div>
                <div class="w-1/2 md:w-1/3 px-2.5">
                    <label>Report Type</label>
                    <select v-on:change="ddChange()" v-model="ddfilter" class="w-full focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 form-control">
                        <option value="both">Print+Digital</option>
                        <option value="print">Print</option>
                        <option value="digital">Digital</option>
                    </select>
                </div>
            </div>
            <div class="w-full md:w-1/4 px-2.5 flex gap-4 md:justify-end">
                <a :href="url + '/webapp/employees/create'"
                    class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Add
                    New Employee</a>
                <a :href="url + '/webapp/employee-loader'"
                    class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Bulk
                    Load Employees</a>
                <!-- <input class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" type="submit" name="" value="Bulk Load Employees" id="" /> -->
            </div>
        </div>
        <div class="my-5 flex flex-wrap -mx-2.5 items-center">
            <div class="w-full flex flex-wrap mb-3 md:mb-0 items-end">
                <div class="w-full lg:w-1/3 md:w-1/2 px-2.5 flex flex-wrap">
                    <label># of Employees to View</label>
                    <select v-model="changePagination_count" v-on:change="changePagination()" class="w-full focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 form-control">
                        <option value="50">50 Employees</option>
                        <option value="100">100 Employees</option>
                        <option value="200">200 Employees</option>
                        <option value="300">300 Employees</option>
                        <option value="400">400 Employees</option>
                        <option value="500">500 Employees</option>
                        <option value="1000">1000 Employees</option>
                        <option value="2000">2000 Employees</option>
                        <option value="all">All Employees</option>
                    </select>
                </div>
                <div class="w-full lg:w-1/3 md:w-1/2 px-2.5 mb-3 md:mb-0">
                    <label>Active/Inactive</label>
                    <div class="flex">
                        <select v-model="mstatus" class="w-full focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 mr-3 px-2.5 rounded bg-neutral-100 form-control">
                            <option value="active">Mark as active</option>
                            <option value="inactive">Mark as inactive</option>
                        </select>
                        <!-- </div>
                        <div class="w-1/2 md:w-1/4 px-2.5"> -->
                        <a href="javascript:void(0)" v-on:click="changeStatus()" class="inline-block h-[28px] leading-[19px] rounded px-3 py-1 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">
                            Apply
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 mb-3 flex flex-wrap -mx-2.5">
            <div class="order-2 md:order-1 w-full px-2.5 flex flex-wrap gap-4 justify-start">
                <!-- <a href="javascript:void(0)"
                    class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Apply</a> -->
                <!-- <a href="javascript:void(0)" v-on:click="SelectAll"
                    class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Select
                    All</a> -->
                <!-- <a href="javascript:void(0)" v-on:click="ClearAll"
                    class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Clear
                    Selection</a> -->
                <a href="javascript:void(0)" v-on:click="printSelected()"
                    class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md w-1/5">Download/Print</a> <!--Create PDF Report(s)-->
                <a href="javascript:void(0)" v-on:click="digitalDeliverySelected()"
                    class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md w-1/5">Digital Delivery</a>
                    
                <a href="javascript:void(0)" v-on:click="deleteSelected()"
                    class="rounded px-3 py-1.5 leading-4 text-center hover:bg-red-400 bg-red-700 text-white font-sans font-bold text-md w-1/5">Delete
                    Selected Employees</a>
                <a href="javascript:void(0)" v-on:click="finalCommit()" v-if="permissions.user_permissions.reports < 10000"
                    title="Attantion: The employees will not be editable/deletable after final commit the employees."
                    class="rounded px-3 py-1.5 leading-4 text-center hover:bg-red-400 bg-red-700 text-white font-sans font-bold text-md w-1/5">Final
                    Commit</a>
                <a href="javascript:void(0)" v-on:click="printSelectedMerge()" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md w-1/5">Print as One Combined PDF</a> 
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3"><input type="checkbox" v-model="allSelected"
                                v-on:change="selectAll" /><span class="ml-3">Select</span></th>
                        <th scope="col" class="px-2 py-3" v-on:click="sortTable()">
                            <span class="flex items-center">
                                <span class="mr-2">Employee Name</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th scope="col" class="px-2 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">Employee ID</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th v-on:click="sortTable()" scope="col" class="px-2 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">Group/Dept</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th class="px-2 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">Supervisor</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                        </th>
                        <th class="px-2 py-3" v-if="permissions.user_permissions.reports < 10000">
                            <span class="flex items-center">
                                <span class="mr-2">Committed</span>
                            </span>
                        </th>
                        <th class="px-2 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">Report Type</span>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="employee in employees" v-if="employees.length > 0"
                        class="data-employee border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <!-- v-show="this.supervisorM == '' || employee.supervisor == this.supervisorM" -->
                        <td data-label="Select" class="px-2 py-2">
                            <input type="checkbox" v-model="selected" :value="employee.id" number />
                        </td>
                        <td data-label="Employee Name" class="px-2 py-2">
                            <a :href="url + '/webapp/employees/edit/' + employee.id"
                                class="underline underline-offset-2">{{employee.lastname}}, {{employee.firstname}}</a>
                        </td>
                        <td data-label="Employee ID" class="px-2 py-2">
                            {{employee.employee_id}}
                        </td>
                        <td data-label="Group/Dept" class="px-2 py-2">
                            {{employee.group}}
                        </td>
                        <td data-label="Supervisor" class="px-2 py-2">
                            {{employee.supervisor}}
                        </td>
                        <td data-label="Group/Dept" class="px-2 py-2" v-if="permissions.user_permissions.reports < 10000">
                            {{(employee.final_commited) ? 'Yes' : 'No'}}
                        </td>
                        <td data-label="Digital Delivery" class="px-2 py-2">
                            {{(employee.is_digital_delivery) ? 'Digital' : 'Print'}}
                        </td>
                    </tr>
                    <tr v-else>
                        <td data-label="Select" class="px-2 py-2 text-center" colspan="4">
                        No record found!!
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <pagination v-if="pagination && pagination.last_page > 1" :pagination="pagination" :offset="5" :paginate="getEmployees"></pagination>

        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <div v-if="showCounter" class="text-[25px] text-greenback fixed text-center md:top-[45%] top-[40%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
                Downloading {{pdf_current_counter}}/{{pdf_counter}}
            </div>
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoaderCreating">
            <div v-if="showCountercreatingpdf" class="text-[25px] text-greenback fixed text-center md:top-[45%] top-[40%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
                Creating PDF, please wait...
            </div>
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>


<script>
export default {
    props: ['permissions', 'supervisors', 'plan', 'empcount', 'activeempcount', 'inactiveempcount', 'totalreport', 'final_commited_employee_count', 'totaladditionalReport'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            sort: '',
            status: 'active',
            mstatus: 'active',
            viewLoader: false,
            viewLoaderCreating: false,
            selected: [],
            dataList: [],
            allSelected: false,
            supervisorM: '',
            ddfilter: 'both',
            zip: new JSZip(),
            total: 0,
            employees: {},
            pagination: {},
            pdf_counter: 0,
            pdf_current_counter: 0,
            showCounter: false,
            changePagination_count:50,
            showCountercreatingpdf: false,
            commited: 0,
            uncommited: 0,
            totalEmployees: 0,
            error_msg: '',
        }
    },
    created() {
        this.getEmployees(false);
        setTimeout(() => {
            console.log(this.activeempcount);
            console.log(this.inactiveempcount);
        }, 2000)
    },
    methods: {
        getEmployees(filters = false, page = 1) {
            let app = this;
            app.viewLoader = true;
            if (!filters) {
                filters = {};
            }

            axios.post(app.url + '/webapp/employees/get?page=' + page + '&limit=' + this.changePagination_count, filters).then((response) => {
                if (response.data.success) {
                    app.employees = response.data.data.employees;
                    app.pagination = response.data.data.pagination;
                    // app.total = response.data.data.employees.length;

                    app.commited = app.employees.filter(employee => employee.final_commited).length;
                    app.uncommited = app.employees.filter(employee => ! employee.final_commited).length;
                    app.totalEmployees = app.empcount;
                    

                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        async selectAll() {
            if (this.allSelected) {
                const selected = this.employees.map((u) => u.id);
                this.selected = selected;
            } else {
                this.selected = [];
            }
        },
        SelectAll() {
            const selected = this.employees.map((u) => u.id);
            this.selected = selected;
        },
        ClearAll() {
            this.selected = [];
        },
        deleteSelected() {
            let commited_employees_count = 0;
            let uncommited_employees_count = 0;
            this.selected.forEach((employee_id) => {
                if(this.employees.find(employee => employee.id == employee_id && employee.final_commited == 1)) {
                    commited_employees_count++;
                } else {
                    uncommited_employees_count++;
                }
            });

            if( this.plan && (this.plan == 'unlimited' || this.plan == 'professional') ) {
                //alert( this.selected.length + " employee(s) will be deleted.");
                this.error_msg = this.selected.length + " employee(s) and their data will be permanently deleted. Are you sure you want to continue?";
            } else {
                if( ! uncommited_employees_count ) {
                    alert("You have not selected any uncommitted employees.");
                    return;
                } else {
                    if( parseInt( commited_employees_count ) && parseInt( commited_employees_count ) > 0 ) {
                        //alert( uncommited_employees_count + " employee(s) will be deleted, "+commited_employees_count+" employee(s) can't be deleted as they are committed.");
                        //this.error_msg = uncommited_employees_count + " employee(s) will be deleted, "+commited_employees_count+" employee(s) can't be deleted as they are committed.";
                        this.error_msg = uncommited_employees_count + " employee(s) and their data will be permanently deleted, "+commited_employees_count+" employee(s) can't be deleted as they are committed. Are you sure you want to continue?";
                    } else {
                        //alert( uncommited_employees_count + " employee(s) will be deleted.");
                        this.error_msg = uncommited_employees_count + " employee(s) and their data will be permanently deleted. Are you sure you want to continue?";
                    }
                }
            }

            //if( confirm("Warning: Are you sure? This will permanently delete these employees and their data.") ) {
            if( confirm(this.error_msg) ) {
                let app = this;
                app.viewLoader = true;
                axios.post(app.url + '/webapp/employee/delete', { employee_ids: this.selected }).then((response) => {
                    app.viewLoader = false;
                    if (response.data.success) {
                        showSuccessMessage(response.data.data.msg);
                        this.selected = [];
                        app.employees = {};
                        app.pagination = {};
                        app.getEmployees(false);
                    } else {
                        showErrorMessage(response.data.data.msg);
                    }
                }).catch((error) => {
                    showErrorMessage("Something went wrong!");
                });
            }
        },
        printSelected() {
            if ( ! this.selected.length ) {
                alert('Please select at least 1 employee.');
                return false;
            }

            this.viewLoader = true;
            this.showCounter = true;
            this.pdf_counter = this.selected.length;
            this.zip = new JSZip();
            this.getPDFs(0);
        },
        printSelectedMerge() {
            if (!this.selected.length) {
                alert('Please select at least 1 employee.');
                return false;
            }
            
            let reportsCount = this.permissions.user_permissions.reports;
            if(reportsCount < 10000)
            {
                let userConfirmed = confirm("Note: Only the employees that you commit will print.");
                if (!userConfirmed) {
                    return false;
                }
            }

            this.viewLoader = true;
            this.showCounter = true;
            this.pdf_counter = this.selected.length;
            this.dataList = [];
            this.allprintSelected(0);
            
        },
        digitalDeliverySelected() {

            let commited_employees_count = 0;
            let uncommited_employees_count = 0;
            this.selected.forEach((employee_id) => {
                if(this.employees.find(employee => employee.id == employee_id && employee.final_commited == 1)) {
                    commited_employees_count++;
                } else {
                    uncommited_employees_count++;
                }
            });
            
            if ( ! this.selected.length ) {
                alert('Please select at least 1 employee.');
                return false;
            }

            let msg0 = `One or more of your selections have not been committed. Until you click "Final Commit" reports will appear with a watermark DRAFT FOR REVIEW ONLY. `;
            if( uncommited_employees_count  ) {
                if( ! confirm( msg0 ) ) {
                    return false;
                }
            }

            let msg = `This will email each selected employee instructing them on how to get their report. Make sure you have set up the customizable email options in the Company Profile page. Continue?`;
            if( confirm( msg ) ) {
                let app = this;
                app.viewLoader = true;
                axios.post(app.url + '/webapp/employee/send-bulk-email', {employee_ids: app.selected}).then((response) => {
                    if (response.data.success) {
                        showSuccessMessage(response.data.data.msg);
                    } else {
                        showErrorMessage(response.data.data.msg);
                    }
                    app.viewLoader = false;
                }).catch((error) => {
                    showErrorMessage("Something went wrong!");
                });
            }

        },
        allprintSelected(i) {
            let app = this;
            if (this.selected && this.selected[i]) {
                this.viewLoader = true;
                this.pdf_current_counter = i + 1;

                let name = '';
                for (let j in app.employees) {
                    if (app.employees[j].id == app.selected[i]) {
                        name = app.employees[j].lastname + " " + app.employees[j].firstname + '-' + app.selected[i];
                    }
                }

                const params = {
                    employee_id: this.selected[i]
                };

                axios.get(app.url + '/combined_pdf', { params })
                    .then((response) => {
                        app.viewLoader = false; 
                        if (response.data) {
                            if(response.data.data.msg != undefined)
                            {
                                alert(response.data.data.msg);
                            }
                            else
                            {
                                if(response.data.data.allrecords != undefined)
                                {
                                    app.dataList.push(response.data.data.allrecords);
                                }
                                app.allprintSelected(parseInt(i) + 1);
                            }
                        } else {
                            // Handle failure case here
                            console.error("Response data not available.");
                        }
                    })
                    .catch((error) => {
                        app.viewLoader = false;
                        console.error("An error occurred:", error);
                    });
            } else {
                let app = this;
                if(app.dataList.length > 0)
                {
                    app.viewLoaderCreating = true;
                    this.showCountercreatingpdf = true;
                    const dataListString = JSON.stringify(app.dataList);
                    const postData = new FormData();
                    postData.append('allrecords', dataListString);
                    axios({
                        url: app.url + '/convert_pdf',
                        method: 'POST',
                        data: app.dataList,
                        responseType: 'blob'
                    })
                    .then((response) => {
                        if (response.data) {
                            const blob = new Blob([response.data], { type: 'application/pdf' });
                            /* Create a link element to trigger download */
                            const link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = 'combined.pdf';
                            link.click();
                            window.URL.revokeObjectURL(link.href);
                            app.selected = [];
                            app.dataList = [];
                        } else {
                            // Handle failure case here
                            console.error("Response data not available.");
                        }
                        app.viewLoaderCreating = false;
                    })
                    .catch((error) => {
                        app.viewLoaderCreating = false;
                        console.error("An error occurred:", error);
                    });
                }
            }
        },
        getPDFs(i) {
            let app = this;
            if (this.selected && this.selected[i]) {
                this.pdf_current_counter = i+1;
                
                let name = '';
                for (let j in app.employees) {
                    if (app.employees[j].id == app.selected[i]) {
                        name = app.employees[j].lastname + " " + app.employees[j].firstname + '-' + app.selected[i];
                    }
                }
                axios({
                    url: app.url + '/create-report?employee_id=' + this.selected[i],
                    method: 'GET',
                    responseType: 'blob', // important
                }).then((response) => {
                    this.zip.file(name.toLowerCase().replace(" ", "-") + '.pdf', response.data);
                    app.getPDFs(parseInt(i) + 1);
                });
            } else {
                this.showCounter = false;
                this.zip.generateAsync({ type: "blob", compression: "DEFLATE", compressionOptions: { level: 9 } }).then(function (content) {
                    app.viewLoader = false;
                    app.selected = [];
                    // let zip_name = jQuery(".company-header select option:selected").text().toLowerCase().replaceAll(",", "").replaceAll(" ", "-").replaceAll(".", "");
                    let zip_name = 'COMPackage Reports.zip';
                    saveAs(content, zip_name);
                    // saveAs(content, zip_name + " " + new Date().getTime() + '.zip');
                });
            }
        },
        sortTable() {

            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
            )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

            document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
                const table = th.closest('table');
                Array.from(table.querySelectorAll('tr.data-employee'))
                    .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                    .forEach(tr => table.appendChild(tr));
            })));
        },
        employeeByStatus() {
            let filters = {
                'status': (this.status != 'all') ? ((this.status == 'active') ? 'active' : 'inactive') : 'all',
            };

            this.getEmployees(filters);
        },
        supervisorChange() {
            let app = this;
            app.viewLoader = true;
            // this.employees.filter((employee) => {employee.supervisor == this.supervisorM;} );
            axios.post(app.url + '/webapp/employees/get', {'supervisor': this.supervisorM, 'ddfilter': this.ddfilter}).then((response) => {
                if (response.data.success) {
                    app.employees = response.data.data.employees;
                    app.pagination.total = response.data.data.employees.length;//response.data.data.pagination;
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        ddChange() {
            let app = this;
            app.viewLoader = true;
            // this.employees.filter((employee) => {employee.supervisor == this.supervisorM;} );
            axios.post(app.url + '/webapp/employees/get', {'supervisor': this.supervisorM, 'ddfilter': this.ddfilter}).then((response) => {
                if (response.data.success) {
                    app.employees = response.data.data.employees;
                    app.pagination.total = response.data.data.employees.length;//response.data.data.pagination;
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        finalCommit() {
            if ( ! this.selected.length ) {
                alert('Please select at least 1 employee.');
                return false;
            }
            //console.log(this.final_commited_employee_count);
            if (this.final_commited_employee_count !== '') {
                let finalcommitedcount = parseInt(this.final_commited_employee_count, 10);
                let totalreport = parseInt(this.totalreport, 10);

                // Assuming totaladditionalReport is defined in your component data
                let totaladditionalReport = parseInt(this.totaladditionalReport, 10);

                var totalreports = totalreport + totaladditionalReport;
                let count = totalreports - finalcommitedcount;

                if (count < this.selected.length) {
                    alert('Only ' + totalreports + ' employees are allowed.');
                    return false;
                }
            }

            if( confirm("Warning: once you commit, your employee count will be decreased and committed for each employee name.") ) {
                let app = this;
                axios.post(app.url + '/webapp/employee/commit', {employees_id: this.selected}).then((response) => {
                    if (response.data.success) {
                        showSuccessMessage(response.data.data.msg);
                        app.getEmployees(false);
                        setTimeout(() => location.reload(), 1000 );
                    } else {
                        showErrorMessage(response.data.data.msg);
                    }
                }).catch((error) => {
                    showErrorMessage("Something went wrong!");
                });
            } else {
                alert("Not Commited");
            }
        },
        changeStatus() {
            let app = this;
            app.viewLoader = true;
            axios.post(app.url + '/webapp/employee/changestatus', {staus:app.mstatus, employee_ids: app.selected}).then((response) => {
                if (response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    app.getEmployees(false);
                    setTimeout(() => location.reload(), 1000 );
                } else {
                    showErrorMessage(response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                showErrorMessage("Something went wrong!");
            });
        },
        changePagination() {
            // console.log(this.changePagination_count);
            let filters = {
                'status': (this.status != 'all') ? ((this.status == 'active') ? 'active' : 'inactive') : 'all',
            };
            this.getEmployees(filters);
        }
    }
}
</script>
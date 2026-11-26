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
            <p>To load more, you must delete some uncommitted active or inactive employees. Your license doesn’t allow you to delete committed employees. If you need additional reports, please <u><a href="https://phplaravel-778694-6095291.cloudwaysapps.com/total-compensation-statements/software-purchase" style="color: #16612e;">click here</a></u> to purchase more reports.</p>

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
            <div class="w-full mb-3 mb-3">
                <label for="toggleB" class="flex items-center cursor-pointer">
                    <div>Exclude Employee Contributions from Report</div>
                    <div class="relative ml-3">
                        <input type="checkbox" id="toggleB" class="sr-only" v-model="exclude_employee_contributions">
                        <div class="block bg-gray-600 w-8 h-5 rounded-full"></div>
                        <div class="dot absolute left-1 top-1 bg-white w-3 h-3 rounded-full transition"></div>
                    </div>
                </label>
                </div>
            </div>
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
                <!-- <a href="javascript:void(0)" v-on:click="printSelectedMerge()" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md w-1/5">Print as One Combined PDF</a> -->
                <a href="javascript:void(0)" v-on:click="exportAllEmployee()"
                    class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md w-1/5">Export Employee</a>
                    <a href="javascript:void(0)" v-on:click="generateCombinedReport()"
                    class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md w-1/5"><i class="fa fa-file-pdf"></i> Generate Combined PDF Report</a>
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
                            <a :href="url + '/webapp/employees/edit/' + employee.id+'?exclude_emp='+this.exclude_employee_contributions"
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
        <!-- Progress Modal for Combined PDF Generation -->
        <div v-if="showProgressModal" class="modal-overlay" @click.self="cancelProgress">
            <div class="progress-modal">
                <div class="modal-header">
                    <h3>Generating Combined Report</h3>
                    <button @click="cancelProgress" class="close-btn">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div class="status-info">
                        <p v-if="jobProgress.status === 'pending'">
                            <strong>Status:</strong> Waiting to start...
                        </p>
                        <p v-else-if="jobProgress.status === 'processing'">
                            <strong>Status:</strong> Processing reports...
                        </p>
                        <p v-else-if="jobProgress.status === 'completed'">
                            <strong>Status:</strong> Complete! Downloading...
                        </p>
                    </div>
                    
                    <div class="progress-info">
                        <p>
                            <strong>Progress:</strong> 
                            {{ jobProgress.processed }} / {{ jobProgress.total }} employees
                        </p>
                        <p v-if="jobProgress.estimatedTime" style="color: #666; font-size: 14px; margin-top: 5px;">
                            <em>{{ jobProgress.estimatedTime }}</em>
                        </p>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="progress-bar-container">
                        <div class="progress-bar" :style="{ width: jobProgress.percentage + '%' }">
                            <span class="progress-text">{{ jobProgress.percentage }}%</span>
                        </div>
                    </div>
                    
                    <!-- Loading Animation -->
                    <div v-if="jobProgress.status !== 'completed'" class="loading-animation">
                        <div class="spinner"></div>
                        <p>Please wait while we generate your report...</p>
                    </div>
                    
                    <!-- Success Animation -->
                    <div v-else class="success-animation">
                        <div class="checkmark">✓</div>
                        <p>Report generated successfully! Download starting...</p>
                    </div>
                </div>
            </div>
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
            exclude_employee_contributions:'false',
            showProgressModal: false,
            currentJobId: null,
            startTime: null,
            jobProgress: {
                status: 'pending',
                total: 0,
                processed: 0,
                percentage: 0,
                estimatedTime: null,
                pdf_url: null
            },
            progressInterval: null,
            downloadTriggered: false,
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
        exportAllEmployee(){
            let app = this;
            app.viewLoader = true;
            
            axios.post(app.url + '/webapp/employee/exportemployees').then((response) => {
                if (response.data.success) {
                    //let csv1 = "First Name,Last Name,Address Line 1,Address Line 2,City,State,ZIP,Email,Supervisor,Descriptive Qualifier,Hourly,Digital Delivery,Digital Delivery ID,Salary,Hourly Wages,Overtime,Holiday Bonus,Annual Bonus,Performance Bonus,Social Security,Employee Social Security,Medicare,Employee Medicare,401K,Employee 401K,Federal Unemployment,State Unemployment,Holiday Time Off,Sick Time Off,Vacation Time Off,Health Insurance,Employee Health Insurance,Dental Insurance,Employee Dental Insurance,Vision Insurance,Short Term Disability,Long Term Disability,Draw,Commissions\n";
                    let csv1 = "";
                    for (let userhead of response.data.data.head_data) {
                        csv1 += `"${userhead}",`;
                    }
                    csv1 += `\n`;
                	for (let user of response.data.data.employees) {
                        Object.entries(user).forEach(([key, value]) => {
                            csv1 += `"${value !== null ? value : ""}",`;
                        });
                        csv1 += `\n`;
                    }
	                var currentdate = new Date();
		            var datetime = currentdate.getFullYear() + "-" + (currentdate.getMonth() + 1) + "-" + currentdate.getDate();
		            this.viewLoader = false;
		            const anchor = document.createElement('a');
		            anchor.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv1);
		            anchor.target = '_blank';
		            anchor.download = 'Export Employee ' + datetime + '.csv';
		            anchor.click();

                    showSuccessMessage("Success!!");
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
       downloadAllEmployeeCSVData() {
            let csv1 = "First Name, Last Name,Company,Employee,Email,Extension,Phone, Views, IP, State, Signup reference, Additional info, Date\n";
            for (let user of this.demoinquiries) {
                let replacedCSV = user.company ? user.company.replace(/,/g, '') : '';
                csv1 += `"${user.firstname}",`;
                csv1 += `"${user.lastname}",`;
                csv1 += `"${replacedCSV}",`;
                csv1 += `"${user.num_employees}",`;
                csv1 += `"${user.email}",`;
                csv1 += `"${(user.phoneext > 1) ? user.phoneext : '-'}",`;
                csv1 += `"${user.phone}",`;
                csv1 += `"${user.count}",`;
                csv1 += `"${user.ip}",`;
                csv1 += `"${user.state}",`;
                csv1 += `"${user.signup_reference_from}",`;

                // Add the conditionals directly in JavaScript
                let additionalInfo = "";
                if (user.OtherPleasedefine) {
                    additionalInfo = user.OtherPleasedefine;
                } else if (user.UniversityWhichone) {
                    additionalInfo = user.UniversityWhichone;
                } else if (user.Organizationwhichone) {
                    additionalInfo = user.Organizationwhichone;
                } else if (user.WebSearchtermsearched) {
                    additionalInfo = user.WebSearchtermsearched;
                }
                csv1 += `"${(additionalInfo) ? additionalInfo : '-'}",`;
                csv1 += `"${user.updated_at}"\n`;
            }



            var currentdate = new Date();
            var datetime = currentdate.getFullYear() + "-" + (currentdate.getMonth() + 1) + "-" + currentdate.getDate();
            this.viewLoader = false;
            const anchor = document.createElement('a');
            anchor.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv1);
            anchor.target = '_blank';
            anchor.download = 'Demo Report ' + datetime + '.csv';
            anchor.click();
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
            if( this.permissions.user_permissions.reports < 10000 ){
                let msg0 = `One or more of your selections have not been committed. Until you click "Final Commit" reports will appear with a watermark DRAFT FOR REVIEW ONLY. `;
                if( uncommited_employees_count  ) {
                    if( ! confirm( msg0 ) ) {
                        return false;
                    }
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
                 console.log("combined_pdf");
                this.viewLoader = true;
                this.pdf_current_counter = i + 1;

                let name = '';
                for (let j in app.employees) {
                    if (app.employees[j].id == app.selected[i]) {
                        name = app.employees[j].lastname + " " + app.employees[j].firstname + '-' + app.selected[i];
                    }
                }

                //const params = {
                //    employee_id: this.selected[i]
                //};

                const params = {
                    employee_id: this.selected[i],
                    exclude_emp: this.exclude_employee_contributions
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
                console.log("convert_pdf");
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
                    url: app.url + '/create-report?employee_id=' + this.selected[i]+'&exclude_emp='+this.exclude_employee_contributions,
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
        },
        generateCombinedReport() {
            let app = this;
            
            if (!this.selected || this.selected.length === 0) {
                alert('Please select employees first');
                return;
            }
            
            // Confirmation for large batches
            if (this.selected.length > 50) {
                if (!confirm(`You are about to generate a combined report for ${this.selected.length} employees. This may take several minutes. Continue?`)) {
                    return;
                }
            }
            
            axios.post(app.url + '/webapp/queue-combined-report', {
                employee_ids: this.selected,
                exclude_emp: this.exclude_employee_contributions === true || this.exclude_employee_contributions === 'true'
            })
            .then((response) => {
                if (response.data.success) {
                    app.currentJobId = response.data.job_id;
                    app.startTime = Date.now();
                    
                    // IMPORTANT: Show the progress modal
                    app.showProgressModal = true;  // ← ADD THIS LINE
                    
                    app.jobProgress = {
                        status: 'pending',
                        total: response.data.employee_count,
                        processed: 0,
                        percentage: 0,
                        estimatedTime: null,
                        pdf_url: null
                    };
                    
                    app.startProgressTracking();
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                
                let errorMsg = 'Failed to start report generation. Please try again.';
                if (error.response && error.response.data && error.response.data.message) {
                    errorMsg = error.response.data.message;
                }
                
                alert(errorMsg);
            });
        },
        
        startProgressTracking() {
            let app = this;
            
            if (this.progressInterval) {
                clearInterval(this.progressInterval);
            }
            
            // Store start time for estimation
            app.downloadTriggered = false;
            app.startTime = Date.now();
            
            this.progressInterval = setInterval(() => {
                app.checkJobProgress();
            }, 2000); // Check every 2 seconds
            
            this.checkJobProgress();
        },
        
        checkJobProgress() {
            let app = this;
            
            if (!this.currentJobId) {
                return;
            }
            
            axios.get(app.url + '/webapp/check-job-status/' + this.currentJobId)
                .then((response) => {
                    app.jobProgress = response.data;
                    
                    // Calculate estimated time remaining
                    if (response.data.status === 'processing' && response.data.processed > 0) {
                        let elapsedTime = Date.now() - app.startTime;
                        let avgTimePerRecord = elapsedTime / response.data.processed;
                        let remaining = response.data.total - response.data.processed;
                        let estimatedSeconds = Math.round((avgTimePerRecord * remaining) / 1000);
                        let estimatedMinutes = Math.round(estimatedSeconds / 60);
                        
                        app.jobProgress.estimatedTime = estimatedMinutes > 0 
                            ? `${estimatedMinutes} minute(s) remaining` 
                            : 'Less than 1 minute remaining';
                    }
                    
                    // If completed, download the file
                    if (response.data.status === 'completed' && !app.downloadTriggered) {
                        app.downloadTriggered = true;
                        clearInterval(app.progressInterval);
                        setTimeout(() => {
                            app.downloadReport();
                        }, 500);
                    }

                    
                    // If failed, show error
                    if (response.data.status === 'failed') {
                        clearInterval(app.progressInterval);
                        alert('Report generation failed: ' + response.data.error);
                        app.showProgressModal = false;
                    }
                })
                .catch((error) => {
                    console.error('Error checking progress:', error);
                });
        },
        
        downloadReport() {
            let app = this;
            
            console.log('downloadReport called');
            console.log('jobProgress:', app.jobProgress);
            console.log('pdf_url:', app.jobProgress.pdf_url);
            
            // Open PDF in new tab using the pdf_url from checkJobStatus response
            if (app.jobProgress.pdf_url) {
                console.log('Opening PDF in new tab:', app.jobProgress.pdf_url);
                window.open(app.jobProgress.pdf_url, '_blank');
            } else {
                console.error('No PDF URL available', app.jobProgress);
                alert('PDF URL not available. Please check console.');
            }
            
            // Close modal and reset
            setTimeout(() => {
                app.showProgressModal = false;
                app.currentJobId = null;
                app.selected = [];
                app.jobProgress = {
                    status: 'pending',
                    total: 0,
                    processed: 0,
                    percentage: 0,
                    estimatedTime: null,
                    pdf_url: null
                };
            }, 1000);
        },
        
        cancelProgress() {
            let app = this;
            
            if (!this.currentJobId) {
                return;
            }
            // Cancel the job
            axios.delete(app.url + '/webapp/cancel-job/' + this.currentJobId)
                .then(response => {
                    console.log('Job cancelled:', response.data);
                })
                .catch(error => {
                    console.error('Error cancelling job:', error);
                });
            if (this.progressInterval) {
                clearInterval(this.progressInterval);
            }
            app.showProgressModal = false;
            app.currentJobId = null;
            app.selected = [];
            app.jobProgress = {
                status: 'pending',
                total: 0,
                processed: 0,
                percentage: 0,
                estimatedTime: null,
                pdf_url: null
            };
            this.allSelected = false;
        }
    }
}
</script>
<style scoped>
input:checked ~ .dot {
    transform: translateX(100%);
    background-color: #48bb78;
}

/* Modal Overlay */
.modal-overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    background-color: rgba(0, 0, 0, 0.75) !important;
    backdrop-filter: blur(4px) !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    z-index: 99999 !important;
    animation: fadeIn 0.2s ease !important;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Modal Container */
.progress-modal {
    background: white !important;
    border-radius: 12px !important;
    padding: 0 !important;
    min-width: 550px !important;
    max-width: 600px !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3) !important;
    animation: slideUp 0.3s ease !important;
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Modal Header */
.modal-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    padding: 24px 30px !important;
    border-bottom: 1px solid #e5e7eb !important;
    background: linear-gradient(135deg, #16612e 0%, #1e7a3a 100%) !important;
    border-radius: 12px 12px 0 0 !important;
}

.modal-header h3 {
    margin: 0 !important;
    font-size: 22px !important;
    font-weight: 700 !important;
    color: white !important;
    letter-spacing: 0.3px !important;
}

.close-btn {
    background: rgba(255, 255, 255, 0.2) !important;
    border: none !important;
    font-size: 24px !important;
    cursor: pointer !important;
    color: white !important;
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.2s ease !important;
    line-height: 1 !important;
}

.close-btn:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    transform: rotate(90deg) !important;
}

/* Modal Body */
.modal-body {
    padding: 35px 30px !important;
}

.status-info, .progress-info {
    margin-bottom: 20px !important;
}

.status-info p, .progress-info p {
    margin: 8px 0 !important;
    font-size: 16px !important;
    color: #374151 !important;
    line-height: 1.6 !important;
}

.status-info p strong, .progress-info p strong {
    color: #16612e !important;
    font-weight: 600 !important;
}

/* Progress Bar Container */
.progress-bar-container {
    width: 100% !important;
    height: 40px !important;
    background-color: #e5e7eb !important;
    border-radius: 20px !important;
    overflow: hidden !important;
    margin: 25px 0 !important;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1) !important;
    position: relative !important;
}

.progress-bar {
    height: 100% !important;
    background: linear-gradient(90deg, #16612e 0%, #22c55e 50%, #10b981 100%) !important;
    background-size: 200% 100% !important;
    animation: gradientShift 2s ease infinite !important;
    border-radius: 20px !important;
    transition: width 0.5s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative !important;
    overflow: hidden !important;
}

@keyframes gradientShift {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 0%; }
    100% { background-position: 0% 0%; }
}

.progress-bar::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: -100% !important;
    width: 100% !important;
    height: 100% !important;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent) !important;
    animation: shimmer 2s infinite !important;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

.progress-text {
    color: white !important;
    font-weight: 700 !important;
    font-size: 16px !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
    position: relative !important;
    z-index: 1 !important;
}

/* Loading Animation */
.loading-animation, .success-animation {
    text-align: center !important;
    margin-top: 25px !important;
}

.spinner {
    border: 5px solid #e5e7eb !important;
    border-top: 5px solid #16612e !important;
    border-radius: 50% !important;
    width: 50px !important;
    height: 50px !important;
    animation: spin 1s linear infinite !important;
    margin: 20px auto !important;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-animation p, .success-animation p {
    color: #6b7280 !important;
    font-size: 15px !important;
    margin-top: 15px !important;
    font-weight: 500 !important;
}

/* Success Checkmark */
.checkmark {
    width: 70px !important;
    height: 70px !important;
    border-radius: 50% !important;
    background: linear-gradient(135deg, #22c55e 0%, #10b981 100%) !important;
    color: white !important;
    font-size: 45px !important;
    line-height: 70px !important;
    margin: 20px auto !important;
    box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3) !important;
    animation: scaleIn 0.5s ease !important;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Estimated Time */
.progress-info p em {
    color: #16612e !important;
    font-style: normal !important;
    font-weight: 600 !important;
    display: block !important;
    margin-top: 8px !important;
    font-size: 14px !important;
}

/* Responsive Design */
@media (max-width: 640px) {
    .progress-modal {
        min-width: 90% !important;
        margin: 20px !important;
    }
    
    .modal-header {
        padding: 20px !important;
    }
    
    .modal-body {
        padding: 25px 20px !important;
    }
}
</style>
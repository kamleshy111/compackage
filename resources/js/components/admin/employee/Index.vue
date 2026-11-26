<template>
    <div>
        <div class="flex flex-wrap -mx-3.5 mb-4">
            <div class="w-full md:w-1/3 px-3.5">
                <select v-on:change="fillEmployees" v-model="filterValue" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                    <option value="all"> All Employees </option>
                    <option value="active"> All Active Employees </option>
                    <option value="inactive"> All Inactive Employees </option>
                </select>    
            </div>
            <!-- <div class="w-full md:w-1/3 px-3.5">
                <label for="">Order By</label>
                <select v-on:change="fillCompanies" v-model="selectedUser" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                    <option value="Adate"> Date (Ascending) </option>
                    <option value="Ddate"> Date (Descending) </option>
                    <option value="name"> Name </option>
                    <option value="company"> Company </option>
                    <option value="username"> Username </option>
                    <option value="email_address"> Email Address </option>
                </select>
            </div> -->
            
            <div class="w-full md:w-1/3 px-3.5">
                    <select v-on:change="fillCompanies" v-model="selectedUser" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                    <option value=""> Select a user </option>
                    <option v-for="user in sortedUsers" :value="user.id">{{user.name}}</option>
                </select>
            </div>
            <div class="w-full md:w-1/3 px-3.5">
                <select v-on:change="fillEmployees" v-model="selectedCompany" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                    <option value="">Select a company</option>
                    <option v-for="company in companies" :value="company.id">{{company.name}}</option>
                </select>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3.5 mb-4 items-end">
            <div class="w-full md:w-1/3 px-3.5">
                <label for="">Search By:</label>
                <select v-model="selectedSearchBy" v-on:change="SearchByChange" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                    <option value="Email">Email</option>
                    <option value="FirstLastName">First/Last Name</option>
                    <option value="Company">Company Name</option>
                </select>
            </div>
            <div class="w-full md:w-1/3 px-3.5">
                <label for="">Search</label>
                <input type="search" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" name="" id="" v-model="SearchValue">
            </div>
            <div class="mt-5 w-full md:w-1/3 px-3.5">
                <button v-on:click="SearchUsers" class="w-20 ml-3 hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">Search</button>
            </div>
        </div>
        
        <div class="relative overflow-x-auto shadow-md" v-if="results.length > 0" >
            <table class="w-full text-left" v-if="Viewemployee != true">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <!-- <th scope="col" class="px-2 py-3"><input type="checkbox" v-model="selectAll" /></th> -->
                        <th scope="col" class="px-2 py-3">First Name</th>
                        <th scope="col" class="px-2 py-3">Last Name</th>
                        <th scope="col" class="px-2 py-3">Email</th>
                        <th scope="col" class="px-2 py-3">Employees Status</th>
                        <th scope="col" class="px-2 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in results" :key="index" class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <!-- <td data-label="Select" class="px-2 py-2">
                            <input type="checkbox"  />
                        </td> -->
                        <td class="px-2 py-2">{{ item.firstname }}</td>
                        <td class="px-2 py-2">{{ item.lastname }}</td>
                        <td class="px-2 py-2">{{ item.email }}</td>
                        <td>
                            <select v-model="selectedEmployee" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-[80%] form-control">
                                <option value="all">All Employees</option>
                                <option value="active">Active Employees</option>
                                <option value="inactive">Inactive Employees</option>
                            </select>
                        </td>
                        <td class="px-2 py-2">
                            <span class="cursor-pointer hover:underline" title="view" @click="ViewEmployee(item.id)">View</span>
                        </td>
                    </tr>
                </tbody>
            </table>    
        </div>
        
        <div class="mt-5 w-full md:w-1/3 mb-4 flex justify-end" v-if="Viewemployee == true">
            <!-- v-on:change="fillCompanies"  -->
            <select v-model="bulkActions" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                <option value=""> Bulk Action </option>
                <option value="active"> Active selection </option>
                <option value="inactive"> Inactive selection </option>
                <option value="delete"> Delete selected </option>
                <option value="uncommitted"> Uncommit selected </option>
            </select>
            <button v-on:click="updateBulkAction" class="w-20 ml-3 hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">Apply</button>
            <button v-on:click="PreviousButton" class="w-20 ml-3 hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm">Previous</button>
        </div>

        <div class="relative overflow-x-auto shadow-md" v-if="Viewemployee == true">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3"><input type="checkbox" v-model="selectAll" /></th>
                        <th scope="col" class="px-2 py-3">Employee Name</th>
                        <th scope="col" class="px-2 py-3">Employee ID</th>
                        <th scope="col" class="px-2 py-3">Group/Dept</th>
                        <th scope="col" class="px-2 py-3">Date</th>
                        <!-- COMMITTED -->
                        <th scope="col" class="px-2 py-3">Committed</th> 
                        <th scope="col" class="px-2 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="employees.length > 0" v-for="employee in employees" class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <td data-label="Select" class="px-2 py-2">
                            <input type="checkbox"  v-model="selected" :value="employee.id" />
                        </td>
                        <td data-label="Employee Name" class="px-2 py-2">
                            <a href="javascript:void()">{{employee.firstname}} {{employee.lastname}}</a>
                            <!-- <a :href="url + '/admin/employees/edit/' + employee.id" class="underline">{{employee.firstname}} {{employee.lastname}}</a> -->
                        </td>
                        <td data-label="Employee ID" class="px-2 py-2">
                            {{employee.employee_id}}
                        </td>
                        <td data-label="Group/Dept" class="px-2 py-2">
                            {{employee.group}}
                        </td>
                        <td data-label="created_at" class="px-2 py-2">
                            {{ my_date_format1(employee.created_at)}}
                        </td>
                        <td data-label="final_commited" class="px-2 py-2">
                            {{(employee.final_commited) ? 'Yes' : 'No'}}
                        </td>
                        <td data-label="Group/Dept" class="px-2 py-2 flex">
                            <span v-if="employee.inactive == 0" title="Inactive">
                                <svg v-on:click="changeStatus(employee.id, 'inactive')" title="Inactive" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span v-if="employee.inactive == 1" title="Active">
                                <svg v-on:click="changeStatus(employee.id, 'active')" title="Active" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span title="Delete">
                                <svg v-on:click="deleteEmployee(employee.id)" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </span>
                        </td>
                    </tr>
                    <tr v-else >
                        <td data-label="Select" class="px-2 py-2 text-center" colspan="4">
                            <strong>No employees found, Please select another filter.</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>


<script>
export default {
    props:['users'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            companies: {},
            employees: {},
            selectedUser: '',
            selectedCompany: '',
            filterValue: 'all',
            bulkActions: '',
            selected: [],
            SearchValue: '',
            selectedSearchBy: 'Email',
            results: [],
            currentUserid: '',
            selectedEmployee: 'all',
            Viewemployee: false
        }
    },
    created() {

    },
    computed: {
        selectAll: {
            get: function () {
                return this.employees ? this.selected.length == this.employees.length : false;
            },
            set: function (value) {
                var selected = [];

                if (value) {
                    this.employees.forEach(function (employee) {
                        selected.push(employee.id);
                    });
                }

                this.selected = selected;
            }
        },
        years() {
            let years = [];
            for (var i = 2005; i <= new Date().getFullYear(); i++) {
                years.push(i);
            }
            return years;
        },
        months() {
            return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        },
        sortedUsers() {
        // Sort the users array by name
        return this.users.slice().sort((a, b) => a.name.localeCompare(b.name));
        }
    },
    methods: {
        my_date_format1(input){
            //console.log(input);
            var d = new Date(input);
            var month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            var date =  (month[d.getMonth()]) + "-" + ((d.getDate() < 10) ? '0'+d.getDate() : d.getDate()) + "-" + d.getFullYear();
            var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
            return (date);  
        },
        fillCompanies() {
            this.Viewemployee = true;
            this.viewLoader = true;
            if( ! this.selectedUser ) {
                this.viewLoader = false;
                this.companies = '';
                this.employees = '';
                this.selectedUser = '';
                this.selectedCompany = '';
                return;
            }
            this.selectedCompany = '';
            this.employees = '';

            let user = this.users.filter(user => {
                return this.selectedUser == user.id;
            });

            this.companies = user[0].companies;
            this.viewLoader = false;
        },
        SearchByChange()
        {
            this.SearchValue = '';
        },
        PreviousButton()
        {
            this.SearchUsers();
        },
        ViewEmployee(user_ID) {
            if(user_ID != '')
            {
                let app = this;
                app.viewLoader = true;
                axios.post(app.url + '/admin/employees/UserIDCompanyID', { UserID: user_ID }).then((response) => {
                    if (response.data.success) {
                        app.currentUserid = response.data.data;
                        //app.viewLoader = false;

                        if (app.currentUserid[0] !== '' && app.currentUserid[0] !== undefined) {
                            console.log(app.currentUserid[0]);

                            axios.post(app.url + '/admin/company/' + app.currentUserid[0] + '/employeesnewsearch', { 'filterValue': app.selectedEmployee })
                                .then((response) => {
                                    if (response.data.success) {
                                        app.employees = response.data.data.employees;
                                        app.Viewemployee = true;
                                    }
                                    app.viewLoader = false;
                                })
                                .catch((error) => {
                                    app.viewLoader = false;
                                    alert(error);
                                });
                        }
                        else
                        {
                            alert('No record found.');
                            app.viewLoader = false;
                        }

                    }
                    else
                    {
                        alert('No record found.');
                        app.viewLoader = false;
                    }
                }).catch((error) => {
                    Swal.fire(
                        'Not Updated!',
                        'Status not updated.',
                        'error'
                    );
                });
            }
            else
            {
                alert('No record found.');
                return true;
            }
        },
        fillEmployees() {
            let app = this;
            app.viewLoader = true;
         
            if( ! app.selectedCompany ) {
                app.viewLoader = false;
                app.employees = '';
                return;
            }

            axios.post( app.url + '/admin/company/'+app.selectedCompany+'/employees', {'filterValue': this.filterValue} ).then((response) => {
                if(response.data.success) {
                    app.employees = response.data.data.employees;
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                alert(error);
            });
        },
        SearchUsers() {
            let app = this;
            if( app.SearchValue == '' ) 
            {
                alert('Please enter data.');
                return true;
            }
            if (app.SearchValue.length < 3) 
            {
                alert('Please enter at least 3 characters.');
                return true;
            }
            if(app.SearchValue != '' && app.SearchValue.length >= 3 )
            {
                app.viewLoader = true;
                app.Viewemployee = false;
                axios.post( app.url + '/admin/employees/SearchUser', {searchvalue:app.SearchValue, selectedSearchBy: app.selectedSearchBy} ).then((response) => {
                    console.log(response);
                    if( response.data.success ) {
                        this.results = response.data.data;
                        app.viewLoader = false;
                    }
                }).catch((error) => {
                    Swal.fire(
                        'Not Updated!',
                        'Status not updated.',
                        'error'
                    )
                });
            }
        },
        updateBulkAction() {
            let app = this;
            if (app.selected < 1) {
                alert('Please select an employee.');
                return true;    
            }

            if( app.bulkActions && app.bulkActions == 'uncommitted' ) {
                app.uncommittedEmployee(app.selected);
                return true;
            }
            app.Viewemployee = true;
            if( app.bulkActions && app.bulkActions == 'delete' ) {
                app.deleteEmployee(app.selected);
                return true;
            } else {
                let statusValue = (this.bulkActions == 'active') ? 0 : 1;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, mark as '+app.bulkActions.charAt(0).toUpperCase() + app.bulkActions.slice(1)+'!'
                }).then((result) => {
                    axios.post( app.url + '/admin/employees/status', {status:statusValue, employees: app.selected} ).then((response) => {
                        console.log(response.data.success);
                        if( response.data.success ) {
                            app.fillEmployees();
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Updated!',
                                    'Status updated successfully.',
                                    'success'
                                )
                            }
                        }
                    }).catch((error) => {
                        Swal.fire(
                            'Not Updated!',
                            'Status not updated.',
                            'error'
                        )
                    });
                })
            }
        },
        uncommittedEmployee(employee_id)
        {
            
            let app = this;
            if( ! Array.isArray(employee_id) ) {
                employee_id = [employee_id];
            }
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert the data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, uncommit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post( app.url + '/admin/employees/uncommitted', {employee_ids: employee_id} ).then((response) => {
                        if( response.data.success ) {
                            app.fillEmployees();
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Uncommitted!',
                                    'Employees uncommitted successfully.',
                                    'success'
                                )
                            }
                        }
                    }).catch((error) => {
                        Swal.fire(
                            'Not Deleted!',
                            'Unable to uncommit.',
                            'error'
                        )
                    });
                }
            })
        },
        deleteEmployee(employee_id) {
            let app = this;

            if( ! Array.isArray(employee_id) ) {
                employee_id = [employee_id];
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert the data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post( app.url + '/admin/employees/destroy', {employee_ids: employee_id} ).then((response) => {
                        if( response.data.success ) {
                            app.fillEmployees();
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Deleted!',
                                    'The data is permanently deleted.',
                                    'success'
                                )
                            }
                        }
                    }).catch((error) => {
                        Swal.fire(
                            'Not Deleted!',
                            'Unable to delete the data.',
                            'error'
                        )
                    });
                }
            })
        },
        changeStatus(employee_id, status) {
            let app = this;

            let statusValue = (status == 'active') ? 0 : 1;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, mark as '+status.charAt(0).toUpperCase() + status.slice(1)+'!'
            }).then((result) => {
                axios.post( app.url + '/admin/employees/status', {status:statusValue, employees: {employee_id}} ).then((response) => {
                    if( response.data.success ) {
                        app.fillEmployees();
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Updated!',
                                'Status updated successfully.',
                                'success'
                            )
                        }
                    }
                }).catch((error) => {
                    Swal.fire(
                        'Not Updated!',
                        'Status not updated.',
                        'error'
                    )
                });

                
            })
        }
    }
}
</script>
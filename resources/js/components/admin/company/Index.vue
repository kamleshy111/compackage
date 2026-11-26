<template>
    <div>
        <div class="flex flex-wrap -mx-3.5 mb-4">
            <div class="w-full md:w-1/3 px-3.5">
                    <select v-on:change="fillCompanies" v-model="selectedUser" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                    <option value=""> Select a user </option>
                    <option v-for="user in users" :value="user.id">{{user.name}}</option>
                </select>
            </div>
        </div>
            
        <div class="relative overflow-x-auto shadow-md">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">SR.</th>
                        <th scope="col" class="px-2 py-3">Company Name</th>
                        <th scope="col" class="px-2 py-3">No. of Employees</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="companies.length > 0" v-for="(company, index) in companies" class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <td data-label="Select" class="px-2 py-2">
                            {{(index + 1)}}
                        </td>
                        <td data-label="Employee Name" class="px-2 py-2">
                            <a :href="url + '/admin/companies/edit/' + company.id" class="underline">{{company.name}}</a>
                        </td>
                        <td data-label="No. of Employees" class="px-2 py-2">
                            {{company.employees_count}}
                        </td>
                    </tr>
                    <tr v-else >
                        <td data-label="Select" class="px-2 py-2 text-center" colspan="4">
                            <strong>No companies found for this user.</strong>
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
            selected: []
        }
    },
    created() {

    },
    computed: {
        selectAll: {
            get: function () {
                return this.companies ? this.selected.length == this.companies.length : false;
            },
            set: function (value) {
                var selected = [];

                if (value) {
                    this.companies.forEach(function (company) {
                        selected.push(company.id);
                    });
                }

                this.selected = selected;
            }
        }
    },
    methods: {
        fillCompanies() {
            let app = this;
            this.viewLoader = true;
            if( ! this.selectedUser ) {
                this.viewLoader = false;
                this.companies = '';
                this.employees = '';
                this.selectedUser = '';
                this.selectedCompany = '';
                return;
            }

            axios.post(app.url + '/admin/user/companies', {"user_id": this.selectedUser}).then((response) => {
                if(response.data.success) {
                    this.companies = response.data.data.companies;
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                alert(error);
            });

            /* let user = this.users.filter(user => {
                return this.selectedUser == user.id;
            }); */

            // this.companies = this.users[0].companies;
            // this.viewLoader = false;
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
        updateBulkAction() {
            let statusValue = (this.bulkActions == 'active') ? 0 : 1;
            let app = this;
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
        },
        deleteEmployee(employee_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
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
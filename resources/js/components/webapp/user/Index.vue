<template>
<div>

    <div class="w-full flex items-center justify-start mt-4 mb-8" v-if="selected_user_role == 2">
        <a v-if="report_count >= 1000" :href="url + '/webapp/users'" class="mr-3 rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">Add New User</a>
        <a href="javascript:void(0)" v-on:click="directonPopup" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">Directions</a>
    </div>
    <div v-show="shodPopup" class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20"></div>
        <div v-show="shodPopup" class="max-h-[300px] md:max-h-full overflow-auto cpgmodal-container w-full max-w-[600px] p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7]">
            <span v-on:click="shodPopup= false" class="cpgclose-popup absolute w-7 h-7 text-center text-red-400 hover:text-red-700 text-[30px] leading-[25px] top-0 right-0 rounded-full cursor-pointer">&times;</span>
            <div class="flex flex-wrap">
                <div class="w-full mb-5">
                    <h3 class="text-xl text-black">Adding a New User</h3>
                    <div class="text-xs italic text-red-700 font-bold pb-3">Note: Before adding a user to a specific company, you mustfirst add the company in the Company tab.</div>
                    <hr class="border-gray-600" />
                    <div class="pt-4">
                        <ul class="text-sm">
                            <li class="mb-3 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-green-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Click the Add New User link</span></li>
                            <li class="mb-3 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-green-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Fill in all information for the user, and  select the Active checkbox.</span>
                            </li>
                            <li class="mb-3 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1 text-green-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Under Company Access, select the company or companies that you would like the user to be able to access.</span>
                            </li>
                            <li class="mb-3 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-green-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>After filling in all information for the user, click Create User.</span>
                            </li>
                            <li class="mb-3 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-green-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>To send them their password, select the Send User Information button after adding them as a user.</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>

    <div class="row flex flex-wrap -mx-3.5">
        <div class="w-full md:w-1/3 px-3.5">
            <select name="users-list" v-on:change="selectUser" v-model="selected_user" size="5" class="focus:border-lbrwnclr outline-0 border border-neutral-400 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
                <option v-for="user in users" :value="user.id">{{user.lastname+', '+user.firstname}}</option>
            </select>

            <div class="flex justify-end" v-if="selected_user_role == 2">
                <button type="submit" v-if="selected_user != 0" v-on:click="deleteSelectedUser" class="mr-3 outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:bg-red-900 bg-red-700 text-white font-sans font-bold text-sm">Delete Selected User</button>
            </div>
        </div>
        <div class="w-full md:w-2/3 pr-3.5 pl-3.5 lg:pl-10">
            <form class="register " action="" method="post" enctype="multipart/form-data" v-on:submit="createUser">
                <div class="flex flex-wrap -mx-3.5 mb-3">
                    <div class="lg:w-1/2 w-full px-3.5 mb-3 lg:mb-0">
                        <label for="firstname" class="mb-1">First Name<span class="text-red-600 ml-1">*</span></label> 
                        <input type="text" required id="firstname" name="firstname" placeholder="First Name" v-model="user.firstname" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-3.5">
                        <label for="lastname" class="mb-1">Last Name<span class="text-red-600 ml-1">*</span></label>
                        <input type="text" required id="lastname" name="lastname" placeholder="Last Name" v-model="user.lastname" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3.5 mb-3">
                    <div class="lg:w-1/2 w-full px-3.5 mb-3 lg:mb-0">
                        <label for="email" class="mb-1">E-mail Address<span class="text-red-600 ml-1">*</span></label>
                        <input type="email" required id="email" name="email" placeholder="E-mail Address" v-model="user.email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-3.5">
                        <label for="username" class="mb-1">Username<span class="text-red-600 ml-1">*</span></label>
                        <input type="text" required id="username" name="username" placeholder="Username" v-model="user.username" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3.5 mb-3">
                    <div class="lg:w-1/2 w-full px-3.5 mb-3 lg:mb-0">
                        <div class="flex justify-between">
                            <div>
                                <label for="status" class="mb-1 mr-1">Active</label>
                                <input type="checkbox" id="status" name="status" v-model="user.status" />
                            </div>
                            <div>
                                <!-- <label for="meta_amount_invested_in_business_till_date">Last Login: </label><span>{{(user.last_login) || ''}}</span> -->
                                <label for="meta_amount_invested_in_business_till_date">Last Login: </label><span>{{ (formattedLastLogin) || '' }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="lg:w-1/2 w-full px-3.5 flex">
                        <label class="mr-3">Permissions<span class="text-red-600 ml-1">*</span></label>
                        <div class="mr-3">
                            <input type="radio" required value="admin" class="mr-1" id="permission_admin" name="permission_type" v-model="user.permission_type" />
                            <label for="permission_admin" class="mb-1">Administrator</label>
                        </div>    
                        <div>
                            <input type="radio" required value="user" class="mr-1" id="permission_user" name="permission_type" v-model="user.permission_type" />
                            <label for="permission_user" class="mb-1">User</label>
                        </div>
                    </div> -->
                </div>
                <div class="w-full mb-3 lg:mb-0">
                    <label for="companies" class="mb-1">Companies Access<span class="text-red-600 ml-1">* {{(companies.length < 1) ? '(Please create a company first.)':''}}</span></label>
                    
                    <select name="companies[]" required multiple v-on:change="selectCompaniesOfUser" v-model="user.companies" class="focus:border-lbrwnclr outline-0 border border-neutral-400 p-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
                        <option v-for="company in companies" :value="company.id">{{company.name}}</option>
                    </select>
                </div>

                <div class="flex justify-end" v-if="selected_user_role == 2">
                    <button type="button" v-on:click="resetPassword" v-if="selected_user != 0" class="mr-3 outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">Reset Password</button>
                    <button type="button" v-on:click="showPreview" v-if="selected_user != 0" class="mr-3 outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">Preview Email</button>
                    <button type="button" v-on:click="sendUserInformation" v-if="selected_user != 0" class="mr-3 outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">Send User Information</button>
                    <button type="submit" v-if="selected_user_role == 2" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">{{ (selected_user == 0) ? 'Create User' : 'Update User' }}</button>
                </div>  
                <div class="text-right" v-if="selected_user_role == 2">
                    <span>{{ (selected_user == 0) ? 'After creating the new user, select that user and then click Send User Information.' : '' }}</span>
                </div>   
            </form>
        </div>
        <!-- Loader -->
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt=""
                class="loader-img top-[50%] right-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>

        <div v-if="showPreviewPopup" class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20"></div>
        <div v-if="showPreviewPopup" class="max-h-[300px] md:max-h-full overflow-auto cpgmodal-container w-full max-w-[800px] p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7]">
            <span v-on:click="showPreviewPopup = false" class="cpgclose-popup absolute w-7 h-7 text-center text-red-400 hover:text-red-700 text-[30px] leading-[25px] top-0 right-0 rounded-full cursor-pointer">&times;</span>
            <div class="flex flex-wrap">
                <div class="w-full mb-5">
                    <h3 class="text-xl text-black">Email Preview</h3>
                    <hr class="border-gray-600" />
                </div>
                <form>
                    <div class="mb-3 md:mb-3 flex flex-wrap ml-5">
                        <div class="fancybox-inner" style="overflow: auto; width: 400px; height: auto;">
                            <div id="email" style="text-align: left; width: 400px; display: block;">
                                <p>Dear COMPackage User:</p>
                                <p>WELCOME, These are the easy-to-use directions for your COMPackage software application:</p>
                                <br>
                                <p>
                                    <b>Step 1: Company Information </b>
                                    <br>
                                    Input and prepare all of your company information here.
                                </p>
                                <br>
                                <p>
                                    <b>Step 2: Benefits </b>
                                    <br>
                                    Select every benefit that exists for any employee throughout your company, including
                                    selecting whether it's only paid for by the company, and/or co-paid by the employee
                                    (or even paid for only by the employee).
                                </p>
                                <br>
                                <p>
                                    <b>Step 3A: Manual Employee Data Management </b>
                                    <br>
                                    Manually View/Add/Edit your employee data here, and/or...
                                </p>
                                <br>
                                <p>
                                    <b>Step 3B: Auto-Load Employee Data Utility </b>
                                    <br>
                                    Access the Employee LOADER auto load feature, which imports your employee data from
                                    your Excel file and helps you match your benefit headers to what's in your COMPackage
                                    application per Step 2 Benefits above.
                                </p>
                                <br>
                                <p>Your login information:</p>
                                <p>
                                    Username: [[USERNAME]]<br>
                                    Password: [[Link]]
                                </p>
                                <br>
                                <p>You can login by going to: <a href="#" target="_blank">https://compackage.com</a></p>
                            </div>
                            <br>
                            Thanks,<br>
                            COMPackage
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios';

export default {
    props:['companies', 'users', 'report_count', 'logged_in_user'],
    data() {
        return {
            selected_user: 0,
            selected_user_role: 0,
            shodPopup: false,
            user: {
                firstname: "",
                lastname: "",
                email: "",
                username: "",
                status: true,
                lastlogin: "",
                companies: [],
                selected_companies: [],
                permission_type: "",
                last_login: ""
            },
            showPreviewPopup: false,
            viewLoader: false,
            url: process.env.MIX_API_URL,
        };
    },
    computed: {
        formattedLastLogin() {
            //alert(this.user.last_login);
            if (this.user.last_login) {
                const parts = this.user.last_login.split(" ");
                const datePart = parts[0];
                const timePart = parts[1] + " " + parts[2];

                const [dd, mm, yyyy] = datePart.split("/");
                const [hh, min, sec] = timePart.split(":");
                //const ampm = parts[3];
                return `${mm}/${dd}/${yyyy} ${hh}:${min}:${sec}`;
            } 
        },
    },
    created() {
        this.selected_user_role = this.logged_in_user.user_role;
    },
    methods: {
        createUser(e) {
            e.preventDefault();
            this.viewLoader = true;
            let app = this;

            if( app.selected_user > 0 ) {
                app.user.id = app.selected_user;
            } else if( app.report_count < 1000 ) {
                alert("Your company cannot add users.");
                this.viewLoader = false;
                return false;
            }

            axios.post(app.url + '/api/users/create', app.user).then(function (response) {
                if (response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    setTimeout(() => {location.reload()}, 3000);
                } else {
                    app.showFormError(response.data.data.key, response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                if (error.response && error.response.status == 403) {
                    showErrorMessage("You are not allowed to perform this operation");
                } else if (error.response && error.response.status == 403) {
                    showErrorMessage(error.response.data.message);
                } else if (error.request) {
                    showErrorMessage(error.request);
                } else {
                    showErrorMessage(error.message);
                }
                app.viewLoader = false;
            });
        },
        directonPopup () {
            this.shodPopup = !this.shodPopup;
        },
        selectUser() {
            let app = this;

            

            this.viewLoader = true;

            axios.post(app.url + '/api/users/' + app.selected_user).then((response) => {
                if(response.data.success) {
                    app.user = response.data.data;
                    app.user.status = response.data.data.status ? true : false;
                }
                app.viewLoader = false;
            }).catch((error) => {
                if (error.response && error.response.status == 403) {
                    showErrorMessage("You are not allowed to perform this operation");
                } else if (error.response && error.response.status == 403) {
                    showErrorMessage(error.response.data.message);
                } else if (error.request) {
                    showErrorMessage(error.request);
                } else {
                    showErrorMessage(error.message);
                }
                app.viewLoader = false;
            });
        },
        deleteSelectedUser() {
            if( confirm('Are you sure?') ) {
                let app = this;
                app.viewLoader = true;
                axios.delete( app.url + '/webapp/users/destroy/' + app.selected_user).then((response) => {
                    if( response.data.success ) {
                        showSuccessMessage(response.data.data.msg);
                        setTimeout(() => location.reload() ,2000);
                    } else {
                        showErrorMessage(response.data.data.msg);
                    }
                    app.viewLoader = false;
                }).catch((error) => {
                    if (error.response && error.response.status == 403) {
                        showErrorMessage("You are not allowed to perform this operation");
                    } else if (error.response && error.response.status == 403) {
                        showErrorMessage(error.response.data.message);
                    } else if (error.request) {
                        showErrorMessage(error.request);
                    } else {
                        showErrorMessage(error.message);
                    }
                    app.viewLoader = false;
                });
            }
        },
        selectCompaniesOfUser() {
        },
        /* Show error message on the form */
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
            // moveUp();
        },
        resetPassword() {
            let app = this;
            app.viewLoader = true;
            if( this.user && this.user.email ) {
                axios.post( app.url + '/webapp/user/reset-password', {id:this.selected_user, action: 'resetpassword'}).then((response) => {
                    if( response.data.success ) {
                        showSuccessMessage(response.data.data.msg);
                    } else {
                        showErrorMessage(response.data.data.msg);
                    }
                    app.viewLoader = false;
                }).catch((error) => {
                    if (error.response && error.response.status == 403) {
                        showErrorMessage("You are not allowed to perform this operation");
                    } else if (error.response && error.response.status == 403) {
                        showErrorMessage(error.response.data.message);
                    } else if (error.request) {
                        showErrorMessage(error.request);
                    } else {
                        showErrorMessage(error.message);
                    }
                    app.viewLoader = false;
                });
            } else {
                console.log(this.selected_user);
            }
        },
        sendUserInformation() {
            let app = this;
            app.viewLoader = true;
            if( this.user && this.user.email ) {
                axios.post( app.url + '/webapp/user/reset-password', {id:this.selected_user, action: 'senduserinformation'}).then((response) => {
                    if( response.data.success ) {
                        showSuccessMessage(response.data.data.msg);
                    } else {
                        showErrorMessage(response.data.data.msg);
                    }
                    app.viewLoader = false;
                }).catch((error) => {
                    if (error.response && error.response.status == 403) {
                        showErrorMessage("You are not allowed to perform this operation");
                    } else if (error.response && error.response.status == 403) {
                        showErrorMessage(error.response.data.message);
                    } else if (error.request) {
                        showErrorMessage(error.request);
                    } else {
                        showErrorMessage(error.message);
                    }
                    app.viewLoader = false;
                });
            } else {
                console.log(this.selected_user);
            }
        },
        showPreview() {
            this.showPreviewPopup = true;
        }
    },
};
</script>
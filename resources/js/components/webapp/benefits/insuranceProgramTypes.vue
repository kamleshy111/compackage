<template>
    <div>
        <h3 class="text-xl text-black">Health Insurance Census Information</h3>
        <div class="mt-5">
            <a v-on:click="add_new_health_insurance()" target="_blank" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">New Health Census</a>
            <form v-on:submit="save_health_insurance">
                <div class="flex flex-wrap -mx-3.5 mt-5">
                    <div class="mb-3 md:mb-0 md:w-2/5 w-full px-3.5">
                        <select name="healthinsurance" size="5" v-on:change="changeItemHealth()" v-model="health_dropdown_selected" class="focus:border-lbrwnclr outline-0 border border-neutral-400 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option v-for="sstatus in health_insurance_form_dropdown" :value="sstatus.id">{{sstatus.description}}</option>
                        </select>
                    </div>
                    <div v-if="health_insurance_form" class="md:w-3/5 w-full px-3.5">
                        <div class="flex flex-wrap mb-3 -mx-2.5">
                            <div class="w-full md:w-1/2 px-2.5 mb-3 md:mb-0">
                                <label class="mb-1" for="description">Description</label>
                                <input name="description" type="text" required :value="health_insurance_form_selected.description" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                            </div>
                            <div class="w-full md:w-1/2 px-2.5">
                                <label class="mb-1" for="payrollsyear"># of Payrolls in a Year</label>
                                <input name="payrollsyear" type="number"  :value="health_insurance_form_selected.payrolls" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                            </div>
                        </div>
                        <div class="w-full mb-3">
                            <label class="mb-1" for="employerpaycosts">Employer Per-Pay Costs</label>
                            <input name="employerpaycosts" type="number"  :value="health_insurance_form_selected.employee_pay_per_cost" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="w-full mb-3">
                            <label class="mb-1" for="employeepaycosts">Employee Per-Pay Costs</label>
                            <input name="employeepaycosts" type="number"  :value="health_insurance_form_selected.employer_pay_per_cost" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="flex justify-end back-btnend">
                            <input v-if="permissions.update" type="submit" name="save" value="Save" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm mr-2" />
                            <input v-if="permissions.delete" type="submit" name="delete" value="Delete" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:bg-red-900 bg-red-700 text-white font-sans font-bold text-sm" />
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <h3 class="text-xl text-black">Dental Insurance Census Information</h3>
        <div class="mt-5">
            <a v-on:click="add_new_dental_insurance()" target="_blank" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">New Dental Census</a>
            <form v-on:submit="save_dental_insurance">
                <div class="flex flex-wrap -mx-3.5 mt-5">
                    <div class="mb-3 md:mb-0 md:w-2/5 w-full px-3.5">
                        <select name="healthinsurance" size="5" v-on:change="changeItemDental($event, 'dental_insurance_form')" v-model="dental_dropdown_selected" class="focus:border-lbrwnclr outline-0 border border-neutral-400 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option v-for="sstatus in dental_insurance_form_dropdown" :value="sstatus.id">{{sstatus.description}}</option>
                        </select>
                    </div>
                    <div v-if="dental_insurance_form" class="md:w-3/5 w-full px-3.5">
                        <div class="flex flex-wrap mb-3 -mx-2.5">
                            <div class="w-full md:w-1/2 px-2.5 mb-3 md:mb-0">
                                <label class="mb-1" for="description">Description</label>
                                <input name="description" type="text" required :value="dental_insurance_form_selected.description" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                            </div>
                            <div class="w-full md:w-1/2 px-2.5">
                                <label class="mb-1" for="payrollsyear"># of Payrolls in a Year</label>
                                <input name="payrollsyear" type="number"  :value="dental_insurance_form_selected.payrolls" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                            </div>
                        </div>
                        <div class="w-full mb-3">
                            <label class="mb-1" for="employerpaycosts">Employer Per-Pay Costs</label>
                            <input name="employerpaycosts" type="number"  :value="dental_insurance_form_selected.employee_pay_per_cost" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="w-full mb-3">
                            <label class="mb-1" for="employeepaycosts">Employee Per-Pay Costs</label>
                            <input name="employeepaycosts" type="number"  :value="dental_insurance_form_selected.employer_pay_per_cost" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="flex justify-end back-btnend">
                            <input v-if="permissions.update" type="submit" name="save" value="Save" id="" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm mr-2" />
                            <input v-if="permissions.delete" type="submit" name="delete" value="Delete" id="" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:bg-red-900 bg-red-700 text-white font-sans font-bold text-sm" />
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <h3 class="text-xl text-black">Vision Insurance Census Information</h3>
        <div class="mt-5">
            <a v-on:click="add_new_vision_insurance()" target="_blank" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">New Vision Census</a>
            <form v-on:submit="save_vision_insurance">
                <div class="flex flex-wrap -mx-3.5 mt-5">
                    <div class="mb-3 md:mb-0 md:w-2/5 w-full px-3.5">
                        <select name="healthinsurance" size="5" v-on:change="changeItemVision($event, 'vision_insurance_form')" v-model="vision_dropdown_selected" class="focus:border-lbrwnclr outline-0 border border-neutral-400 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option v-for="sstatus in vision_insurance_form_dropdown" :value="sstatus.id">{{sstatus.description}}</option>
                        </select>
                    </div>
                    <div v-if="vision_insurance_form" class="md:w-3/5 w-full px-3.5">
                        <div class="flex flex-wrap mb-3 -mx-2.5">
                            <div class="w-full md:w-1/2 px-2.5 mb-3 md:mb-0">
                                <label class="mb-1" for="description">Description</label>
                                <input name="description" type="text" required :value="vision_insurance_form_selected.description" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                            </div>
                            <div class="w-full md:w-1/2 px-2.5">
                                <label class="mb-1" for="payrollsyear"># of Payrolls in a Year</label>
                                <input name="payrollsyear" type="number"  :value="vision_insurance_form_selected.payrolls" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                            </div>
                        </div>
                        <div class="w-full mb-3">
                            <label class="mb-1" for="employerpaycosts">Employer Per-Pay Costs</label>
                            <input name="employerpaycosts" type="number"  :value="vision_insurance_form_selected.employer_pay_per_cost" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="w-full mb-3">
                            <label class="mb-1" for="employeepaycosts">Employee Per-Pay Costs</label>
                            <input name="employeepaycosts" type="number"  :value="vision_insurance_form_selected.employee_pay_per_cost" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="flex justify-end back-btnend">
                            <input v-if="permissions.update" type="submit" name="save" value="Save" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm mr-2" />
                            <input v-if="permissions.delete" type="submit" name="delete" value="Delete" id="" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:bg-red-900 bg-red-700 text-white font-sans font-bold text-sm" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Popup -->
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>

<script>
export default {
    props:['permissions'],
    data() {
        return {
            health_insurance_form: false,
            health_insurance_form_selected: {},
            health_dropdown_selected: 0,
            health_new_button_disabled: false,
            health_insurance_form_dropdown:[],

            dental_insurance_form: false,
            dental_insurance_form_selected: {},
            dental_dropdown_selected: 0,
            dental_new_button_disabled: false,
            dental_insurance_form_dropdown:[],

            vision_insurance_form: false,
            vision_insurance_form_selected: {},
            vision_dropdown_selected: 0,
            vision_new_button_disabled: false,
            vision_insurance_form_dropdown:[],   

            url: process.env.MIX_API_URL,
            viewLoader: false,
        }
    },
    created() {
        this.getInsuranceProgramTypes();
    },
    methods: {
        changeItemHealth() {
            this.health_insurance_form = true;

            for (let item in this.health_insurance_form_dropdown) {
                if( this.health_insurance_form_dropdown[item].id == this.health_dropdown_selected ) {
                    this.health_insurance_form_selected = this.health_insurance_form_dropdown[item];
                }
            }
        },
        changeItemDental() {
            this.dental_insurance_form = true;
            
            for (let item in this.dental_insurance_form_dropdown) {
                if( this.dental_insurance_form_dropdown[item].id == this.dental_dropdown_selected ) {
                    this.dental_insurance_form_selected = this.dental_insurance_form_dropdown[item];
                }
            }
        },
        changeItemVision() {
            this.vision_insurance_form = true;
            
            for (let item in this.vision_insurance_form_dropdown) {
                if( this.vision_insurance_form_dropdown[item].id == this.vision_dropdown_selected ) {
                    this.vision_insurance_form_selected = this.vision_insurance_form_dropdown[item];
                }
            }
        },
        add_new_health_insurance() {
            if( ! this.health_new_button_disabled ) {
                this.health_new_button_disabled = true;
            } else {
                this.health_dropdown_selected = this.health_insurance_form_dropdown.length;
                this.health_insurance_form_selected = {
                    'id': (this.health_insurance_form_dropdown.length),
                    'description': '',
                    'payrolls': '',
                    'employee_pay_per_cost': '',
                    'employer_pay_per_cost': '',
                };
                return false;
            }

            this.health_insurance_form = true;
            
            let index = this.health_insurance_form_dropdown.push({
                'id': (this.health_insurance_form_dropdown.length + 1),
                'description': '',
                'payrolls': '',
                'employee_pay_per_cost': '',
                'employer_pay_per_cost': '',
            });

            this.health_insurance_form_selected = {
                'id': (this.health_insurance_form_dropdown.length + 1),
                'description': '',
                'payrolls': '',
                'employee_pay_per_cost': '',
                'employer_pay_per_cost': '',
            };

            this.health_dropdown_selected = index;
        },
        add_new_dental_insurance() {
            if( ! this.dental_new_button_disabled ) {
                this.dental_new_button_disabled = true;
            } else {
                this.dental_dropdown_selected = this.dental_insurance_form_dropdown.length;
                this.dental_insurance_form_selected = {
                    'id': (this.dental_insurance_form_dropdown.length),
                    'description': '',
                    'payrolls': '',
                    'employee_pay_per_cost': '',
                    'employer_pay_per_cost': '',
                };
                return false;
            }

            this.dental_insurance_form = true;
            this.dental_new_button_disabled = true;
            
            let index = this.dental_insurance_form_dropdown.push({
                'id': (this.dental_insurance_form_dropdown.length + 1),
                'description': '',
                'payrolls': '',
                'employee_pay_per_cost': '',
                'employer_pay_per_cost': '',
            });

            this.dental_insurance_form_selected = {
                'id': (this.dental_insurance_form_dropdown.length + 1),
                'description': '',
                'payrolls': '',
                'employee_pay_per_cost': '',
                'employer_pay_per_cost': '',
            };
            
            this.dental_dropdown_selected = index;
        },
        add_new_vision_insurance() {
            if( ! this.vision_new_button_disabled ) {
                this.vision_new_button_disabled = true;
            } else {
                this.vision_dropdown_selected = this.vision_insurance_form_dropdown.length;
                this.vision_insurance_form_selected = {
                    'id': (this.vision_insurance_form_dropdown.length),
                    'description': '',
                    'payrolls': '',
                    'employee_pay_per_cost': '',
                    'employer_pay_per_cost': '',
                };
                return false;
            }

            this.vision_insurance_form = true;
            
            let index = this.vision_insurance_form_dropdown.push({
                'id': (this.vision_insurance_form_dropdown.length + 1),
                'description': '',
                'payrolls': '',
                'employee_pay_per_cost': '',
                'employer_pay_per_cost': '',
            });

            this.vision_insurance_form_selected = {
                'id': (this.vision_insurance_form_dropdown.length + 1),
                'description': '',
                'payrolls': '',
                'employee_pay_per_cost': '',
                'employer_pay_per_cost': '',
            };
            
            this.vision_dropdown_selected = index;
        },
        save_health_insurance(e) {
            e.preventDefault();

            let app = this;
            app.viewLoader = true;
            app.health_insurance_form = true;

            let description = jQuery("input[name=description").val();
            let payrollsyear = jQuery("input[name=payrollsyear").val();
            let employerpaycosts = jQuery("input[name=employerpaycosts").val();
            let employeepaycosts = jQuery("input[name=employeepaycosts").val();
            
            let action = '';
            // let delete_key = '';
            if( e.submitter.name == 'save' ) {

                if( ! app.checkPermission('update') ) {
                    return false;
                }

                action = e.submitter.name;

                for( let i in this.health_insurance_form_dropdown ) {
                    if( this.health_dropdown_selected == this.health_insurance_form_dropdown[i].id ) {
                        console.log(description);
                        this.health_insurance_form_dropdown[i] = this.health_insurance_form_selected = {
                            'id': this.health_dropdown_selected,
                            'description': description,
                            'payrolls': payrollsyear,
                            'employee_pay_per_cost': employerpaycosts,
                            'employer_pay_per_cost': employeepaycosts,
                        };
                    }
                }
            } else if( e.submitter.name == 'delete' ) {

                if( ! app.checkPermission(e.submitter.name) ) {
                    return false;
                }

                action = e.submitter.name;

                console.log(this.health_insurance_form_dropdown);
                
                for( let i in this.health_insurance_form_dropdown ) {
                    if( this.health_insurance_form_dropdown && this.health_insurance_form_dropdown[i] && this.health_insurance_form_dropdown[i].id && this.health_dropdown_selected == this.health_insurance_form_dropdown[i].id ) {
                        delete this.health_insurance_form_dropdown[i];
                        this.health_insurance_form_dropdown.length = this.health_insurance_form_dropdown.length-1;
                        // this.health_dropdown_selected = 1;
                    }
                }
                this.health_dropdown_selected = 0;
                this.health_insurance_form_selected = {};
            }

            axios.post( app.url + '/webapp/insurance-program-type/store', {"health": this.health_insurance_form_dropdown, "action": action} ).then((response) => {
                app.viewLoader = false;
                if( response.data.success ) {
                    showSuccessMessage(response.data.data.msg);
                    setTimeout(() => location.reload(), 3000);
                }
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage("Something went wrong!!");
            });
        },
        save_dental_insurance(e) {
            e.preventDefault();
            
            let app = this;
            app.viewLoader = true;
            app.dental_insurance_form = true;

            let description = jQuery("input[name=description").val();
            let payrollsyear = jQuery("input[name=payrollsyear").val();
            let employerpaycosts = jQuery("input[name=employerpaycosts").val();
            let employeepaycosts = jQuery("input[name=employeepaycosts").val();

            let action = '';
            if( e.submitter.name == 'save' ) {

                if( ! app.checkPermission('update') ) {
                    return false;
                }

                action = e.submitter.name;

                for( let i in app.dental_insurance_form_dropdown ) {
                    if( app.dental_dropdown_selected == app.dental_insurance_form_dropdown[i].id ) {
                        app.dental_insurance_form_dropdown[i] = app.dental_insurance_form_selected = {
                            'id': app.dental_dropdown_selected,
                            'description': description,
                            'payrolls': payrollsyear,
                            'employee_pay_per_cost': employerpaycosts,
                            'employer_pay_per_cost': employeepaycosts,
                        };
                    }
                }
            } else if( e.submitter.name == 'delete' ) {

                if( ! app.checkPermission(e.submitter.name) ) {
                    return false;
                }

                action = e.submitter.name;

                for( let i in this.dental_insurance_form_dropdown ) {
                    if( this.dental_dropdown_selected == this.dental_insurance_form_dropdown[i].id ) {
                        delete this.dental_insurance_form_dropdown[i];
                        this.dental_insurance_form_dropdown.length = this.dental_insurance_form_dropdown.length-1;
                        // this.dental_dropdown_selected = 1;
                    }
                }
                this.dental_dropdown_selected = 0;
                this.dental_insurance_form_selected = {};
            }

            axios.post( app.url + '/webapp/insurance-program-type/store', {"dental": app.dental_insurance_form_dropdown, "action": e.submitter.name} ).then((response) => {
                app.viewLoader = false;
                if( response.data.success ) {
                    showSuccessMessage(response.data.data.msg);
                    setTimeout(() => location.reload(), 3000);
                }
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage("Something went wrong!!");
            });
        },
        save_vision_insurance(e) {
            e.preventDefault();
            
            let app = this;
            app.viewLoader = true;
            app.vision_insurance_form = true;

            let description = jQuery("input[name=description").val();
            let payrollsyear = jQuery("input[name=payrollsyear").val();
            let employerpaycosts = jQuery("input[name=employerpaycosts").val();
            let employeepaycosts = jQuery("input[name=employeepaycosts").val();

            let action = '';
            if( e.submitter.name == 'save' ) {

                if( ! app.checkPermission('update') ) {
                    return false;
                }

                action = e.submitter.name;

                for( let i in app.vision_insurance_form_dropdown ) {
                    if( app.vision_dropdown_selected == app.vision_insurance_form_dropdown[i].id ) {
                        app.vision_insurance_form_dropdown[i] = app.vision_insurance_form_selected = {
                            'id': app.vision_dropdown_selected,
                            'description': description,
                            'payrolls': payrollsyear,
                            'employee_pay_per_cost': employerpaycosts,
                            'employer_pay_per_cost': employeepaycosts,
                        };
                    }
                }
            } else if( e.submitter.name == 'delete' ) {

                if( ! app.checkPermission(e.submitter.name) ) {
                    return false;
                }
                
                action = e.submitter.name;

                for( let i in app.vision_insurance_form_dropdown ) {
                    if( this.vision_dropdown_selected == this.vision_insurance_form_dropdown[i].id ) {
                        delete this.vision_insurance_form_dropdown[i];
                        this.vision_insurance_form_dropdown.length = this.vision_insurance_form_dropdown.length-1;
                    }
                }
                this.vision_dropdown_selected = 0;
                this.vision_insurance_form_selected = {};
            }

            axios.post( app.url + '/webapp/insurance-program-type/store', {"vision": this.vision_insurance_form_dropdown, "action": e.submitter.name} ).then((response) => {
                app.viewLoader = false;
                if( response.data.success ) {
                    showSuccessMessage(response.data.data.msg);
                    setTimeout(() => location.reload(), 3000);
                }
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage("Something went wrong!!");
            });
        },
        getInsuranceProgramTypes() {
            let app = this;

            app.viewLoader = true;

            axios.get( app.url + '/webapp/insurance-program-types' ).then((response) => {
                if( response.data.success ) {
                    app.health_insurance_form_dropdown = response.data.data.health_census != '' ? response.data.data.health_census : [];
                    app.dental_insurance_form_dropdown = response.data.data.dental_census != '' ? response.data.data.dental_census : [];
                    app.vision_insurance_form_dropdown = response.data.data.vision_census != '' ? response.data.data.vision_census : [];
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
            });
        },
        checkPermission(action) {
            if( this.permissions[action] ) {
                return true;
            }
            return false;
        }
    }
}
</script>
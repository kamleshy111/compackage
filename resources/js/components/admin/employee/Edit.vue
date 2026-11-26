<template>

    <form action="#" method="POST" enctype="multipart/form-data" v-on:submit="updateCompany">
        <div class="flex flex-wrap row -mx-4">
            <div class="w-full px-4">
                <p class="cpation text-black text-base mb-10">(You must have pop-ups enabled on your browser to view report. To print your report use your browser's print function.)</p>
                <div class="md:w-1/2 w-full">
                
                <h3 class="text-xl text-black mb-5">Employee Information</h3>


                <div class="flex -m-2.5">
                    <div class="w-1/2 mb-3 mb-3 px-2.5">
                        <label class="mb-1">First Name</label>
                        <input name="firstname" type="text" maxlength="30" v-model="employee.firstname"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                    </div>
                    <div class="w-1/2 mb-3 mb-3 px-2.5">
                        <label class="mb-1">Last Name</label>
                        <input name="lastname" type="text" maxlength="30" v-model="employee.lastname"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                    </div>
                </div>
                <div class="w-full mb-3 mb-3">
                    <label class="mb-1">Employee ID (SSN cannot be used for Employee ID)</label>
                    <input name="employee_id" type="text" maxlength="30" v-model="employee.employee_id"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                </div>

                <div class="w-full mb-3 mb-3">
                    <label class="mb-1 mr-1">Inactive</label>
                    <input type="checkbox" v-model="employee.inactive" value="1">
                </div>

                <div class="flex flex-wrap -mx-2.5 mb-3">
                    <div class="lg:w-1/2 w-full px-2.5 mb-3 lg:mb-0">
                        <label class="mb-1">Address Line 1</label>
                        <input name="address_line_1" type="text" v-model="employee.address_line_1"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-2.5">
                        <label class="mb-1">Address Line 2</label>
                        <input name="address_line_2" type="text" v-model="employee.address_line_2"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>

                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="md:w-1/3 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">City</label>
                        <input name="city" type="text" v-model="employee.city"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="md:w-1/3 w-full px-4">
                        <label class="mb-1">State</label>
                        <select name="state" v-model="employee.state"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
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
                    <div class="md:w-1/3 w-full px-4 mb-3 md:mb-0">
                        <label class="mb-1">Zip Code</label>
                        <input name="zip" type="text" v-model="employee.zip"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
                <div class="flex flex-wrap gap-4 justify-end">
                    <a href="#" v-on:click="filladdress" class="rounded px-3 py-1.5 leading-4 text-center hover:bg-zinc-600 bg-zinc-500 text-white font-sans font-bold text-md">Use Company Address</a>
                </div>
                <div class="w-full mb-3">
                    <label class="mb-1">Group/Department</label>
                    <input name="department" type="text" v-model="employee.group"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="w-full mb-3">
                    <label class="mb-1">Does a Mid-Year Event apply to this employee? If so, enter a description to the right.</label>
                    <input name="closing" type="text" v-model="employee.mid_year_event"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    <p class="cpation text-black text-sm mb-10">e.g. 'Mid-year hire date', 'Mid-year promotion', 'Disability leave'</p>
                </div>
                </div>
                
                <div class="mt-8">
                    <div class="w-full mb-3">
                        <label class="mb-1">Is using company benefits?</label>
                        <input type="checkbox" v-model="employee.is_company_benefit" value="1" />
                    </div>
                </div>

                <div class="mt-8">
                <div class="relative overflow-x-auto">
                    <div v-for="(benefit_type, benefit_type_index) in benefit_types" class="mt-8">
                <h3 class="text-xl text-black mb-2">{{benefit_type.name}}</h3>

                <div class="relative overflow-x-auto">
                    <table :id="'items' + benefit_type_index" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Show</th>
                                <th scope="col" class="px-2 py-3">Benefit Name</th>
                                <th scope="col" class="px-2 py-3">Preferred Benefit Name</th>
                                <th scope="col" class="px-2 py-3">Employer Contribution Default</th>
                                <th scope="col" class="px-2 py-3">Employee Contribution Default</th>
                            </tr>
                        </thead>
                        <tbody :data-pos="benefit_index" :data-benefittype="benefit_type.id"  v-for="(benefit, benefit_index) in benefit_type.benefits">
                            <tr>
                                <td class="sortablecolumn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-move h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </td>
                                <td data-label="Show" class="px-2 py-2">
                                    <input type="checkbox" v-model="benefit.show" :value="1" />
                                </td>
                                <td data-label="Benefit Name" class="px-2 py-2">
                                    {{benefit.name}}
                                    <span v-if="benefit.can_categorize" class="block mt-3">Categorize the above benefit:</span>
                                </td>
                                 <td data-label="Preferred Benefit Name" class="px-2 py-2">
                                    <input v-model="benefit.additional_benefit_name" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    <select v-if="benefit.can_categorize" v-model="benefit.category_id" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control mt-3">
                                        <option v-for="category in benefit.categories" :value="category.id">{{category.name}}</option>
                                    </select>
                                </td>
                                <td data-label="Employee Contribution Default" class="px-2 py-2">
                                    <span class="flex items-center">
                                        <span class="mr-3">{{ company.currency_symbol || '$'}}</span>
                                        <input v-model="benefit.employer_default_value" name="" type="text" id="" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    </span>
                                </td>
                                <td data-label="Employee Contribution Default" class="px-2 py-2">
                                    <span class="flex items-center">
                                        <span class="mr-3">{{ company.currency_symbol || '$'}}</span>
                                        <input v-model="benefit.employee_default_value" name="" type="text" id="" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
                </div>
            </div>
            <div class="w-full px-2.5 flex flex-wrap gap-4 justify-end">
                    <input class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" type="submit" name="" value="Save" id="" />
                    <a href="#" target="_blank" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Create PDF Report</a>
                </div>
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
// Default SortableJS
import Sortable from 'sortablejs';
export default {
    props: ['edit_employee', 'permissions', 'company'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            benefit_types: [
                {
                    id: '',
                    name: '',
                    benefit: [
                        {
                            id: '',
                            name: '',
                            show: '',
                            additional_benefit_name: '',
                            employer_default_value: '',
                            employee_default_value: '',
                            category_id: '',
                        }
                    ]
                }
            ],
            employee: {
                firstname: '',
                lastname: '',
                employee_id: '',
                inactive: '',
                address_line_1: '',
                address_line_2: '',
                city: '',
                state: '',
                zip: '',
                department: '',
                mid_year_event: '',
                is_company_benefit: ''
            }
        }
    },
    created() {
        if (this.edit_employee) {
            this.employee = this.edit_employee;
        }
        this.getBenefitsTypes();

        let app = this;

        jQuery(window).on('load', () => {

            this.benefit_types.forEach((value, index) => {
                var el = document.getElementById('items' + index);
                
                var sortable = Sortable.create(el, {
                    handle: '.sortablecolumn',
                    onChoose: function (evt) {
                        evt.item.style = 'background-color: rgb(229 231 235); border: 1px solid rgb(163 163 163);';  // element index within parent
                    },
                    onUnchoose: function (evt) {
                        evt.item.style = 'background-color: " "';  // element index within parent
                    },
                    onEnd: function (evt) {
                        app.viewLoader = true;
                        var oldIndex = evt.item.getAttribute("data-pos");
                        var benefitType = evt.item.getAttribute("data-benefittype");
                        var newIndex = evt.newIndex;

                        axios.post( process.env.MIX_API_URL + '/benefits/re-ordering', {
                            "oldIndex": oldIndex,
                            "newIndex": newIndex,
                            "benefitType": benefitType,
                            "employee_id": app.employee
                        }).then((res) => {
                            if(res.data.success) {
                                showSuccessMessage(res.data.data.msg);
                            } else {
                                showErrorMessage(res.data.data.msg);
                            }
                            app.viewLoader = false;
                        }).catch((error) => {
                            //alert("test");
                            app.viewLoader = false;
                        });
                    }
                });
            });
        });
    },
    methods: {
        filladdress() {
            this.employee.address_line_1 = 'Test Address1';
            this.employee.address_line_2 = 'Test Address2';
            this.employee.city = 'Test City';
            this.employee.state = 'NY';
            this.employee.zip = '12345';
        },
        getBenefitsTypes() {
            let app = this;
            app.viewLoader = true;

            axios.get(app.url + '/webapp/employees/get-benefit-types?employee_id='+ app.employee.id).then((response) => {
                if( response.data.success ) {
                    app.benefit_types = response.data.data.benefitTypes;
                } else {
                    showErrorMessage(response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                showErrorMessage(error);
                app.viewLoader = false;
            }); 
        },
        updateCompany(e) {
            e.preventDefault();
            let app = this;
            app.viewLoader = true;

            jQuery('select, input').removeClass('border-2 border-rose-600');

            let benefit_types_arr = Array();
            
            this.benefit_types.forEach((benefit_type, index) => {
                let benefits_arr = Array();
                benefit_type.benefits.forEach((benefit) => {
                    // if(benefit.show) {
                        benefits_arr.push({
                            'additional_benefit_name': benefit.additional_benefit_name,
                            'employee_default_value': benefit.employee_default_value,
                            'employer_default_value': benefit.employer_default_value,
                            'id': benefit.id,
                            'name': benefit.name,
                            'show': benefit.show,
                            'category_id': benefit.category_id,
                            'can_categorize': benefit.can_categorize
                        });
                    // }
                })

                if( benefits_arr && benefits_arr.length > 0 ) {
                    benefit_types_arr.push({'id': benefit_type.id, 'name': benefit_type.name, 'benefits': benefits_arr});
                }
            });

            axios.post(app.url + '/webapp/employees/update/' + app.employee.id, {'employee': app.employee, 'benefit_types': benefit_types_arr}).then((response) => {
                if (response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    location.reload();
                } else {
                    app.showFormError(response.data.data.key, response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        /* Show error message on the form */
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
            // moveUp();
        },
        sortByKey(benefitTypesIndex, sortKey) {
            this.benefit_types[benefitTypesIndex].benefits = Object.values(this.benefit_types[benefitTypesIndex].benefits).sort((a, b) => a.order_sequence - b.order_sequence);
        }
    }
}
</script>
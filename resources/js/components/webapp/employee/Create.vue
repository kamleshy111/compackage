<template>
    <form action="#" method="POST" enctype="multipart/form-data" v-on:submit="createCompany">
        <div class="flex flex-wrap row -mx-4">
            <div class="md:w-1/2 w-full px-4">
                <h3 class="text-2xl text-black mb-2">Employee Information</h3>

                <div class="flex -m-2.5 mt-4">
                    <div class="lg:w-1/2 w-full mb-3 mb-3 px-2.5">
                        <label class="mb-1">First Name</label>
                        <input name="firstname" type="text" maxlength="30" v-model="employee.firstname" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full mb-3 mb-3 px-2.5">
                        <label class="mb-1">Last Name</label>
                        <input name="lastname" type="text" maxlength="30" v-model="employee.lastname" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                    </div>
                </div>
                <div class="flex -m-2.5 mt-4">
                    <div class="lg:w-1/2 w-full mb-3 mb-3 px-2.5">
                        <label class="mb-1">Email</label>
                        <input name="email" type="text" maxlength="60" v-model="employee.email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full mb-3 mb-3 px-2.5">
                        <label class="mb-1">Cell Phone</label>
                        <input name="phone" type="tel" maxlength="15" v-model="employee.phone" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                    </div>
                </div>
                <div class="w-full mb-3 mb-3">
                    <label class="mb-1">Employee ID (SSN cannot be used for Employee ID)</label>
                    <input name="employee_id" type="text" maxlength="30" v-model="employee.employee_id"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                </div>

                <div class="w-full mb-3 mb-3">
                    <label class="mb-1 mr-2">Inactive</label>
                    <input type="checkbox" v-model="employee.inactive" value="1">
                </div>

                <div class="w-full mb-3 mb-3">
                    <label for="toggleB" class="flex items-center cursor-pointer">
                        <div>Hourly Pay Functionality</div>
                        <div class="relative ml-3">
                            <input type="checkbox" id="toggleB" v-model="employee.hourly_pay_functionality" class="sr-only">
                            <div class="block bg-gray-600 w-8 h-5 rounded-full"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-3 h-3 rounded-full transition"></div>
                        </div>
                    </label>
                </div>

                <div class="w-full mb-3 mb-3">
                    <label class="mb-1 mr-2">Allow Digital Delivery</label>
                    <input type="checkbox" v-model="employee.is_digital_delivery" value="1">
                </div>

                <div class="w-full mb-3 mb-3">
                    <label class="mb-1">Supervisor</label>
                    <input name="supervisor" type="text" v-model="employee.supervisor"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>

                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Address Line 1</label>
                        <input name="address_line_1" type="text" v-model="employee.address_line_1"
                            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4">
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
                    <input name="group" type="text" v-model="employee.group"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="w-full mb-3">
                    <label class="mb-1">Does a Mid-Year Event apply to this employee? If so, enter a description to the
                        right.</label>
                    <input name="closing" type="text" v-model="employee.mid_year_event"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <input type="submit" value="Save" class="cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" />
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
export default {
    props: ['editcompany', 'permissions', 'company'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            employee: {
                firstname: '',
                lastname: '',
                employee_id: '',
                inactive: '',
                hourly_pay_functionality: '',
                is_digital_delivery: '',
                supervisor: '',
                address_line_1: '',
                address_line_2: '',
                city: '',
                state: '',
                zip: '',
                group: '',
                mid_year_event: '',
                email: '',
                phone: '',
            }
        }
    },
    methods: {
        filladdress() {
            this.employee.address_line_1 = this.company.addr1;
            this.employee.address_line_2 = this.company.addr2;
            this.employee.city = this.company.city;
            this.employee.state = this.company.state;
            this.employee.zip = this.company.zip;
        },
        createCompany(e) {
            e.preventDefault();
            let app = this;
            app.viewLoader = true;

            jQuery('select, input').removeClass('border-2 border-rose-600');

            axios.post(this.url + '/webapp/employees/store', app.employee).then((response) => {
                console.log(response.data.success);
                if (response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    setTimeout(() => location.href = app.url + '/webapp/employees', 1000);
                } else {
                    app.showFormError(response.data.data.key, response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                console.log(error);
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        /* Show error message on the form */
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
        }
    }
}
</script>
<style scoped>
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
</style>
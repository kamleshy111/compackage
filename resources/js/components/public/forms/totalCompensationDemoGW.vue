<template>
<!-- Date: 26-Sep-2025 According to Bill's new comments, we need to remove the required fields from the form. But the VUE JS code was giving error. So we commented it and redirect to success page. -->
    <div>
        <form v-on:submit="demoFormSubmit">
            <div class="flex flex-wrap -mx-2 mb-3">
                <div class="lg:w-1/2 w-full px-2 mb-3 lg:mb-0">
                    <label for="firstname" class="mb-1">First Name</label>
                    <input type="text" required name="firstname" v-model="demoForm.firstname"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
                <div class="lg:w-1/2 w-full px-2">
                    <label for="lastname" class="mb-1">Last Name</label>
                    <input type="text" required name="lastname" v-model="demoForm.lastname"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-3">
                <div class="lg:w-1/2 w-full px-2 mb-3 lg:mb-0">
                    <label for="Email" class="mb-1">Email</label>
                    <input type="text" required name="email" v-model="demoForm.email"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
                <div class="lg:w-1/2 w-full px-2">
                    <div class="flex flex-wrap">
                        <div class="w-4/6">
                            <label for="Phone" class="mb-1">Phone</label>
                            <input type="text" required name="phone" v-model="demoForm.phone" @input="acceptNumber"
                                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        </div>
                        <div class="w-2/6 pl-3">
                            <label for="phoneext" class="mb-1">Ext.</label>
                            <input type="text" name="phoneext" v-model="demoForm.phoneext"
                                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-3">
                <div class="lg:w-1/3 w-full px-2">
                    <label for="State/Province" class="mb-1">State/Province</label>
                    <input type="text" required name="state" v-model="demoForm.state"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
                <div class="lg:w-1/3 w-full px-2 mb-3 lg:mb-0">
                    <label for="Company" class="mb-1">Company</label>
                    <input type="text" required name="company" v-model="demoForm.company"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
                <div class="lg:w-1/3 w-full px-2">
                    <label for="Number of num_employees" class="mb-1"># of Employees</label>
                    <input type="number" required name="num_employees" v-model="demoForm.num_employees"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
            </div>
            <!-- <div class="flex flex-wrap -mx-2 mb-3">
                <div class="lg:w-1/2 w-full px-2">
                    <label for="Number of num_employees" class="mb-1">How did you learn about us?</label>
                    <select  v-model="demoForm.signupreferencefrom" name="signupreferencefrom" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="gushwork">Gushwork</option>
                    </select>
                </div>
            </div> -->
            <div class="flex flex-wrap -mx-2 mb-3" v-if="demoForm.signupreferencefrom == 'Web Search'">
                <div class="lg:w-1/2 w-full px-2">
                    <label for="State/Province" class="mb-1">Term searched:</label>
                    <input type="text" required name="WebSearchtermsearched" v-model="demoForm.WebSearchtermsearched"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-3" v-if="demoForm.signupreferencefrom == 'Organization/Association'">
                <div class="lg:w-1/2 w-full px-2">
                    <label for="State/Province" class="mb-1">Which one?</label>
                    <input type="text" required name="Organizationwhichone" v-model="demoForm.Organizationwhichone"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-3" v-if="demoForm.signupreferencefrom == 'University'">
                <div class="lg:w-1/2 w-full px-2">
                    <label for="State/Province" class="mb-1">Which one?</label>
                    <input type="text" required name="UniversityWhichone" v-model="demoForm.UniversityWhichone"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
            </div>
            <div class="flex flex-wrap -mx-2 mb-3" v-if="demoForm.signupreferencefrom == 'Other'">
                <div class="lg:w-1/2 w-full px-2">
                    <label for="State/Province" class="mb-1">Please define:</label>
                    <input type="text" required name="OtherPleasedefine" v-model="demoForm.OtherPleasedefine"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
            </div>
            <div class="w-full mb-3 space-x-3">
                <input type="checkbox" required name="are_you_human" id="are_you_human" value="yes" v-model="demoForm.are_you_human" />
                <label for="are_you_human">I am a human</label>
            </div>
            <!--<div class="w-full mb-3 space-x-3">
                <input type="checkbox" name="subscribe" id="subscribe" value="yes"
                    v-model="demoForm.subscribe" />
                <label for="subscribe">Subscribe to COMPackage News</label>
            </div> -->
            <div class="w-full flex flex-wrap items-center justify-start">
                <input type="submit" name="Submit" value="View Demo"
                    class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-9 px-9 md:py-1.5 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg">
            </div>
        </form>
    </div>
</template>
<script>
export default {
    props: ['redirect_url'],
    data() {
        return {
            demoForm: {
                firstname: '',
                lastname: '',
                email: '',
                phone: '',
                state: '',
                company: '',
                industry: '',
                num_employees: '',
                subscribe: true,
                PhoneExt: '',
                are_you_human: false,
                signupreferencefrom:'Gushwork',
                OtherPleasedefine: '',
                UniversityWhichone: '',
                Organizationwhichone: '',
                WebSearchtermsearched: '',
            },
            url: process.env.MIX_API_URL,
        }

    },
    methods: {
        acceptNumber() {
            var x = this.demoForm.phone.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            this.demoForm.phone = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        },
        demoFormSubmit(e) {
            e.preventDefault();
            let app = this;

            jQuery('input').removeClass('border-2 border-rose-600');

            axios.post(app.url + '/admin/demoinquiries/store', app.demoForm).then((response) => {
                if (response.data.success) {
                    // showSuccessMessage(response.data.data.msg);
                    location.href = app.redirect_url;
                    // setTimeout(() => location.reload(), 4000);
                } else {
                    //Date: 26-Sep-2025 According to Bill's new comments, we need to remove the required fields from the form. But the VUE JS code was giving error. So we commented it and redirect to success page.
                    jQuery('input[name=' + response.data.data.key + ']').addClass('border-2 border-rose-600');
                    showErrorMessage(response.data.data.msg);
                    //location.href = app.redirect_url;
                }
            }).catch((error) => {
                //Date: 26-Sep-2025 According to Bill's new comments, we need to remove the required fields from the form. But the VUE JS code was giving error. So we commented it and redirect to success page.
                showErrorMessage(error.response.data.message)
                //location.href = app.redirect_url;
            });
        }
    }
}
</script>
<template>
    <div>
            <div class="mb-5">
                <ul class="list-none pl-0 mb-5">
                    <li class="flex items-center text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Use a password that is easy to remember, so you do not have to write it down.</span>
                    </li>
                    <li class="flex items-center" :class="(has_uppercase && has_lowercase) ?  'text-green-700 ' : '' ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1" :class="(has_uppercase) ?  'inline ' : 'hidden' ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-red-600" :class="(has_uppercase) ?  'hidden ' : 'inline' ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Use a password with mixed-case alphabetic characters.</span>
                    </li>
                    <li class="flex items-center" :class="{'text-green-700' : cpform.new_password.length > 7}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1" :class="(cpform.new_password.length > 7) ?  'inline ' : 'hidden' ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-red-600" :class="(cpform.new_password.length > 7) ?  'hidden ' : 'inline' ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Use a password that has at least eight characters.</span>
                    </li>
                    <li class="flex items-center" :class="{'text-green-700' : has_special }">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1" :class="(has_special) ?  'inline ' : 'hidden' ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 text-red-600" :class="(has_special) ?  'hidden ' : 'inline' ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Use at least one punctuation symbol.</span>
                    </li>
                    <li class="flex items-center text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Use a password that you can type quickly, without having to look at the keyboard. This makes it harder for someone to steal your password by watching over your shoulder.</span>
                        </li>
                </ul>
            </div>    
        <form v-on:submit="changePassword">
            <div class="w-full lg:w-[40%]">
            <div class="w-full mb-2">
                <label class="mb-1" for="email">Current Password</label>
                <input type="password" required="" v-model="cpform.current_password" name="email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
            </div>
            
            <div class="flex -mx-2.5 mb-2">
                <div class="w-1/2 px-2.5">
                <label class="mb-1" for="email">New Password</label>
                <input type="password" required="" v-on:input="password_check" v-model="cpform.new_password" name="email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>  
                <div class="w-1/2 px-2.5">
                <label class="mb-1" for="email">Confirm New Password</label>
                <input type="password" required="" v-on:input="confirm_password_check" v-model="cpform.new_confirm_password" name="email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                <p v-if="cpform.password_matched" class="text-[14px] text-green-700" >Passwords matched</p>
                <p v-else-if="cpform.new_confirm_password" class="text-[14px] text-red-600">Passwords don't match</p>
                <p v-else ></p>
                </div>
            </div>
            
            <div class="flex">
                <input type="submit" class="mr-3 cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" value="Submit">
            </div>      
            </div>
        </form>
      </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            cpform:{
                current_password:'',
                new_password:'',
                new_confirm_password:'',
                password_matched: false
            },
            
            has_number:    false,
            has_lowercase: false,
            has_uppercase: false,
            has_special:   false,
        }
    },
    methods: {
        changePassword(e) {
            e.preventDefault();
            
            let app = this;
            
            if ( ! app.has_number || ! app.has_lowercase || ! app.has_uppercase || ! app.has_special) {
                alert('Your password does not fullfill the requirements.');
                return;
            }

            axios.post( app.url + '/webapp/change-password', this.cpform ).then((response) => {
                if(response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    app.resetForm();
                } else {
                    app.showFormError(response.data.data.key, response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
        },
        password_check() {
            this.has_number    = /\d/.test(this.cpform.new_password);
            this.has_lowercase = /[a-z]/.test(this.cpform.new_password);
            this.has_uppercase = /[A-Z]/.test(this.cpform.new_password);
            this.has_special   = /[!@#\$%\^\&*\)\(+=._-]/.test(this.cpform.new_password);
        },
        confirm_password_check() {
            if( this.cpform.new_password == this.cpform.new_confirm_password ) {
                this.cpform.password_matched = true;
            } else {
                this.cpform.password_matched = false;
            }
        },
        resetForm() {
            this.cpform.current_password = '',
            this.cpform.new_password = '',
            this.cpform.new_confirm_password = '',
            this.cpform.password_matched =  false
        }
    }
}
</script>
<style scoped>
    .frmValidation{font-size: 13px; }
    .frmValidation--passed{color:#006928;}
    .frmIcon{color:#EB0029;}
    .frmValidation--passed .frmIcon{color:#0fa140;}   
</style>
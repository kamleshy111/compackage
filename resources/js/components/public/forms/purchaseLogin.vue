<template>
    <div>
        <form v-on:submit="reformSubmit">
            <div class="w-full max-w-[400px]">
                <div class="flex flex-wrap -mx-2 mb-3">
                    <div class="w-full px-2 mb-3">
                        <label for="email" class="mb-1">User Name</label>
                        <input type="text" required name="email" v-model="loginForm.username" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                    </div>
                    <div class="w-full px-2">
                        <label for="email2" class="mb-1">Password</label>
                        <input type="password" required name="email2"  v-model="loginForm.password" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                    </div>
                </div>
                <div class="w-full flex flex-wrap items-center justify-start">
                    <input type="submit" name="Submit" value="Log In" class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-5 px-9 md:py-1 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg">
                    <input type="reset" name="reset" value="Clear" class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-5 px-9 md:py-1 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg">
                </div>
                <div class="text-sm mt-2">Forgot your password? <a :href="url + '/forgotpassword'" class="underline text-greendarkclr">Click Here</a></div>
            </div>
        </form>
    </div>
    </template>
    <script>
    export default{
        data(){
            return{
                loginForm:{
                    username: '',
                    password: ''
                },
                url: process.env.MIX_API_URL,
            }
    
        },
        created(){
    
        },
        methods: {
            
            reformSubmit(e) {
                let app = this;
                e.preventDefault();
                jQuery('input').removeClass('border-2 border-rose-600');
    
                axios.post( app.url + '/referafriend/store', app.reform ).then((response) => {
                    console.log(response.data);
                    if( response.data.success ) {
                        showSuccessMessage(response.data.data.msg);
                    } else {
                        jQuery('input[name=' + response.data.data.key + ']').addClass('border-2 border-rose-600');
                        showErrorMessage(response.data.data.msg);
                    }
                }).catch((error) => {
                    showErrorMessage(error.response.data.message)
                });
            }
            
    
        }
    }
    </script>
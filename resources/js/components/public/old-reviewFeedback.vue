<template>
    <div>
        <form v-on:submit="reviewSubmit" v-if="show_form">
            <div class="flex flex-wrap -mx-2 mb-3">
                <div class="lg:w-1/2 w-full px-2 mb-3 lg:mb-0">
                    <label for="FullName" class="mb-1">Your Full Name</label>
                    <input type="text" required name="fullname" v-model="rform.fullname" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
                <div class="lg:w-1/2 w-full px-2 mb-3 lg:mb-0">
                    <label for="Email" class="mb-1">Email</label>
                    <input type="text" required name="email" v-model="rform.email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                </div>
            </div>
            <div class="w-full mb-3 mb-3">
                <label for="Comments" class="mb-1">Comments</label>
                <textarea name="Comments" v-model="rform.comments" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-36 px-2.5 rounded bg-neutral-100 w-full form-control"></textarea>
            </div>
            <div class="w-full flex flex-wrap items-center justify-start">
                <input type="submit" name="Submit" value="Continue" class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-9 px-9 md:py-1.5 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg">
            </div>
        </form>
        <div v-else>
            <p class="pb-5 text-xl text-greendarkclr font-bold leading-5">Thank You!</p>
            <p class="pb-5 text-xl text-greendarkclr font-bold leading-5">Your message has been sent.</p>
        </div>
    </div>
    </template>
    <script>
    export default{
        data(){
            return{
                rform:{
                    fullname: '',
                    email: '',
                    comments: ''
                },
                show_form: true,
                url: process.env.MIX_API_URL,
            }
        },
        methods: {
            reviewSubmit(e) {
                let app = this;
                e.preventDefault();
                jQuery('input').removeClass('border-2 border-rose-600');
                axios.post( app.url + '/reviews/store', app.rform ).then((response) => {
                    console.log(response.data);
                    if( response.data.success ) {
                        showSuccessMessage(response.data.data.msg);
                        app.show_form = false;
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
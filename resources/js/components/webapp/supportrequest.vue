<template>
    <div>
        <form v-on:submit="submitSupportRequest">
            <div class="w-full lg:w-[60%]">
                <div class="flex mb-2 -mx-2.5">
                    <div class="w-1/2 px-1.5">
                        <label class="mb-1" for="firstname">First Name</label>
                        <input type="text" required v-model="user.firstname" name="firstname" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
                    </div>
                    <div class="w-1/2 px-1.5">
                        <label class="mb-1" for="lastname">Last Name</label>
                        <input type="text" required v-model="user.lastname" name="lastname" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
                    </div>
                </div>
                <div class="flex mb-2 -mx-2.5 mb-2">
                    <div class="w-1/2 px-1.5">
                        <label class="mb-1" for="email">Email</label>
                        <input type="email" required v-model="user.email" name="email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
                    </div>
                    <div class="w-1/2 px-1.5">
                        <label class="mb-1" for="phone">Phone</label>
                        <input type="tel" required v-model="user.phone" name="phone" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
                    </div>
                </div>
                <div class="">
                    <label class="block mb-1" for="email">Detailed Message</label>
                    <textarea name="message" v-model="message" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-40 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control"></textarea>
                </div>
                
                
                
                <div class="flex">
                    <input type="submit" class="mr-3 cursor-pointer hover:greenback flex items-center justify-center rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-sm" value="Submit Support Request">
                </div>      
            </div>
        </form>
      </div>
</template>
<script>
export default {
    props: [
        'user', 'company_id'
    ],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            message: ""
        }
    },
    methods: {
        submitSupportRequest( e ) {
            e.preventDefault();

            let app = this;
            
            app.user.message = app.message;
            app.user.company_id = app.company_id;

            axios.post( app.url + '/webapp/supportrequest', app.user ).then((response) => {
                console.log(response.data)
                if( response.data.success ) {
                    showSuccessMessage(response.data.data.msg)
                    setTimeout(() => location.reload(), 4000);
                } else {
                    showErrorMessage(response.data.data.msg);
                }
            }).catch((error) => {
                showErrorMessage(error);
            });
        },
        /* Show error message on the form */
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
            moveUp();
        },
    }
}
</script>

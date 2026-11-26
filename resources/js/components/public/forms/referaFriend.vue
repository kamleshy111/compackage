<template>
<div>
    <form v-on:submit="reformSubmit" v-if="refered">
        <div class="flex flex-wrap -mx-2 mb-3">
            <div class="lg:w-1/2 w-full px-2 mb-3 lg:mb-0">
                <label for="email" class="mb-1">Email</label>
                <input type="email" required name="email" v-model="reform.email" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
            </div>
            <div class="lg:w-1/2 w-full px-2">
                <label for="email2" class="mb-1">Email</label>
                <input type="email" required name="email2"  v-model="reform.email2" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
            </div>
        </div>
        <div class="flex flex-wrap -mx-2 mb-3">
            <div class="lg:w-1/2 w-full px-2 mb-3 lg:mb-0">
                <label for="email3" class="mb-1">Email</label>
                <input type="email" required name="email3"  v-model="reform.email3" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
            </div>
            <div class="lg:w-1/2 w-full px-2">
                <label for="email4" class="mb-1">Email</label>
                <input type="email" required name="email4"  v-model="reform.email4" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
            </div>
        </div>    
        <div class="flex flex-wrap -mx-2 mb-3">
            <div class="lg:w-1/2 w-full px-2">
                <label for="email5" class="mb-1">Email</label>
                <input type="email" required name="email5"  v-model="reform.email5" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
            </div>
        </div>
        <div class="w-full mb-3 mb-3">
            <label for="Comments" class="mb-1">Type your comments here</label>
            <textarea name="Comments" v-model="reform.comments" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-36 px-2.5 rounded bg-neutral-100 w-full form-control"></textarea>
        </div>
        <div class="w-full mb-3 mb-3">
            <label for="message" class="mb-1">This message is being sent by:</label>
            <input type="text" name="message" v-model="reform.sent_by" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
        </div>
        <div class="w-full flex flex-wrap items-center justify-start">
            <input type="submit" name="Submit" value="Send to Friends" class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-9 px-9 md:py-1.5 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg">
        </div>
    </form>
    <div v-else>Thank you, we really appreciate the referral!</div>
</div>
</template>
<script>
export default{
    data(){
        return{
            reform:{
                email: '',
                email2: '',
                email3: '',
                email4: '',
                email5: '',
                comments: '',
                sent_by: ''
            },
            refered: true,
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
                    app.refered = false;
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
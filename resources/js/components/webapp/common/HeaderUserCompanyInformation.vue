<template>
    <div class="text-black mr-3">
        <label class="mr-2">Company:</label>
        <select v-model="selected_company_local" v-on:change="switchComapny" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 rounded">
            <option value="">Select a company</option>
            <option v-for="company in companies" :value="company.id">{{ company.name }}</option>
        </select>
    </div>
</template>
<script>
export default {
    props: [
        'companies', // User's all companies
        'selected_company' // User's default selected company
    ],
    data() {
        return {
            url: process.env.MIX_API_URL,
            selected_company_local: ''
        }
    },
    created() {
        this.selected_company_local = this.selected_company;
    },
    methods: {
        switchComapny() {
            let app = this;
            // Return if company id does not exists
            if( ! app.selected_company_local ) {
                return;
            }

            axios.get( app.url + '/webapp/company/'+ app.selected_company_local + '/switch' ).then((resp) => {
                if( resp.data.success ) {
                    location.reload();
                }
            }).catch((error) => {

            });
        }
    }
}
</script>
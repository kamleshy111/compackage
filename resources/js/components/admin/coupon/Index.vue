<template>
    <div class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20" v-if="PopupShow">
        <div class="cpgmodal-container w-full max-w-[500px] p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7]" v-show="PopupShow">
        <span v-on:click="PopupShow= false" class="cpgclose-popup absolute w-7 h-7 text-center bg-black text-white text-[26px] leading-[25px] border-2 border-white shadow-md top-0 right-0 lg:-top-2.5 lg:-right-2.5 rounded-full cursor-pointer">&times;</span>
        <div class="h-full max-h-[300px] lg:max-h-[800px] overflow-auto pr-5">
            <h3 class="leading-normal md:text-sm lg:text-lg text-lg text-greendarkclr mb-2 font-bold uppercase">Create a Coupon Code</h3>
            <create-coupon :editcoupon="coupon" :refresh="getCoupons" ></create-coupon>
        </div>
        </div>
    </div>
    <div class="table-section mt-6">
        <div class="w-full flex items-center justify-end mb-4">
            <a href="javascript:void(0)" v-on:click="editCoupon(0)" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">Add Coupon</a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Type</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3">Limit</th>
                        <th scope="col" class="px-6 py-3">Expire</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(coupon, index) in coupons" v-if="coupons.length > 0" class="data-employee border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" data-label="Serial">
                            {{ (index + 1) }}
                        </th>
                        <td data-label="Name" class="px-6 py-4">
                            {{ coupon.name }}
                        </td>
                        <td data-label="Type" class="px-6 py-4">
                            {{ (coupon.type == 'fixedamount') ? 'Fixed Amount' : 'Percentage(%)' }}
                        </td>
                        <td data-label="Amount" class="px-6 py-4">
                            {{ (coupon.type == 'fixedamount') ? '$' : '' }}{{coupon.amount}}{{ (coupon.type == 'fixedamount') ? '' : '%' }}
                        </td>
                        <td data-label="Limit" class="px-6 py-4">
                            {{coupon.used}}/{{ coupon.limit }}
                        </td>
                        <td data-label="Expire" class="px-6 py-4">
                            {{coupon.expire}}
                        </td>
                        <td data-label="Update" class="px-6 py-4 flex">
                            <a v-on:click="editCoupon(coupon.id)" title="Edit" class="mr-2 cursor-pointer">
                                <svg title="Edit" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            <a v-on:click="deleteCoupon(coupon.id)" title="Delete" class="cursor-pointer">
                                <svg title="Delete" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                            </a>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="6" class="text-center">No coupons yet!</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mark as complete popup:End -->
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pagination:{},
            coupons: {},
            coupon: {},
            sortedData: [],
            pagination: {},
            PopupShow: false,
            sortedbyASC: true,
            viewLoader: false,
            url: process.env.MIX_API_URL,
        }
    },
    created() {
        this.getCoupons();
    },
    methods: {
        getCoupons() {
            let app = this;
            app.viewLoader = true;
            axios.get( app.url + '/admin/api/coupons').then((response) => {
                if(response.data.success) {
                    app.coupons = response.data.data.coupons;
                }
                app.viewLoader = false;
            }).catch((error) => {
                showErrorMessage(error);
                app.viewLoader = false;
            });
        },
        editCoupon(coupon_id) {
            this.PopupShow = true;
            if(coupon_id) {
                this.coupon = this.coupons.find((coupon) => coupon.id == coupon_id);
            } else {
                this.coupon = {};
            }
        },
        deleteCoupon(coupon_id) {
            let app = this;
            
            if( confirm('Are you sure?') ) {
                app.viewLoader = true;
                
                axios.get( app.url + '/admin/coupon/destroy/' + coupon_id).then((response) => {
                    if(response.data.success) {
                        showSuccessMessage(response.data.data.msg);
                        app.getCoupons();
                    }
                    app.viewLoader = false;
                }).catch((error) => {
                    showErrorMessage(error);
                    app.viewLoader = false;
                });
            }
        }
    }
}
</script>
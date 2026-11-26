<template>
    <form action="#" method="POST" enctype="multipart/form-data" v-on:submit="createCompany">
        <div class="flex flex-wrap row -mx-4">
            <div class="md:w-full w-full px-4">
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Coupon name</label>
                        <input name="name" type="text" required maxlength="30" onkeydown="return /[a-z0-9]/i.test(event.key)" v-model="coupon.name" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4">
                        <label class="mb-1">Type</label>
                        <select id="type" v-model="coupon.type" v-on:change="typeChange" required class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option value="percentage">Percentage(%)</option>
                            <option value="fixedamount">Fixed Amount</option>
                        </select>

                        <label class="mb-1">Amount/Percentage</label>
                        <input name="limit" type="number" required :max="coupon.perMax" v-model="coupon.amount" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
                <div class="flex flex-wrap -mx-4 mb-3">
                    <div class="lg:w-1/2 w-full px-4 mb-3 lg:mb-0">
                        <label class="mb-1">Limit</label>
                        <input name="limit" type="number" v-model="coupon.limit" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                    <div class="lg:w-1/2 w-full px-4">
                        <label class="mb-1">Expire</label>
                        <input name="expire" type="date" v-model="coupon.expire" required v-on:change="futureDates" pattern="\d{4}-\d{2}-\d{2}" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                    </div>
                </div>
            
                <div class="back-btnend">
                    <input type="submit" name="btn_Submit" value="Save Information" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm" id="company-submit">
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
export default {
    props: ['editcoupon', 'refresh'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            coupon: {
                name: '',
                type: 'percentage',
                perMax: 99,
                amount: '',
                limit: '',
                expire: ''
            }
        }
    },
    created() {
        if( this.editcoupon ) {
            this.coupon = this.editcoupon;
        }
    },
    methods: {
        createCompany(e) {
            e.preventDefault();
            let app = this;
            app.viewLoader = true;

            jQuery('select, input').removeClass('border-2 border-rose-600');

            let endpoint = '/admin/coupon/store';
            
            axios.post( app.url + endpoint, app.coupon ).then((response) => {
                if(response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    if( app.editcoupon && app.editcoupon.id ) {
                        this.$parent.PopupShow = false;
                        app.refresh();
                    } else {
                        this.$parent.PopupShow = false;
                        app.refresh();
                    }
                } else {
                    app.showFormError(response.data.data.key, response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
                showErrorMessage(error);
            });
        },
        futureDates() {
            console.table(this.coupon.expire, new Date(this.coupon.expire), new Date());
            if(new Date(this.coupon.expire) < new Date()) {
                this.expire = new Date(new Date().getTime() + 86400000).toISOString().slice(0, 10);
                alert('The date should be future date.');
                return false;
            }
            return true;
        },
        typeChange() {
            if( this.coupon.type == 'percentage' ) {
                this.coupon.perMax = 99;
            } else {
                this.coupon.perMax = 100000;
            }
        },
        /* Show error message on the form */
        showFormError(key, message) {
            jQuery('[name=' + key + ']').addClass('border-2 border-rose-600');
            showErrorMessage(message);
        }
    }
}
</script>

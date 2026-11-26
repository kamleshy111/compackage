<template>
    <div class="row space-y-6">
        <h1 class="text-4xl font-semibold">Profile</h1>

        <form class="register" action="" method="post" enctype="multipart/form-data" v-on:submit="createUser">
            <div class="row flex flex-wrap -mx-3">
                <div class="form-group px-3 w-full mb-4 sm:w-1/2 sm:mb-6 ">
                    <label for="firstname" class="mb-2 inline-block font-semibold">First Name:<sup
                            class="text-red-900 text-xl leading-none top-0 relative">*</sup></label>
                    <input type="text" class="border border-gray-300 w-full px-3 py-3 rounded-lg bg-slate-50"
                        id="firstname" name="firstname" placeholder="First Name" v-model="user.firstname" />
                </div>
                <div class="form-group px-3 w-full mb-4 sm:w-1/2 sm:mb-6">
                    <label for="lastname" class="mb-2 inline-block font-semibold">Last Name:<sup
                            class="text-red-900 text-xl leading-none top-0 relative">*</sup></label>
                    <input type="text" class="border border-gray-300 w-full px-3 py-3 rounded-lg bg-slate-50"
                        id="lastname" name="lastname" placeholder="Last Name" v-model="user.lastname" />
                </div>
            </div>
            <div class="row flex flex-wrap -mx-3">
                <div class="form-group px-3 w-full mb-4 sm:w-1/2 sm:mb-6">
                    <label for="email" class="mb-2 inline-block font-semibold">E-mail Address:<sup
                            class="text-red-900 text-xl leading-none top-0 relative">*</sup></label>
                    <input type="email" class="border border-gray-300 w-full px-3 py-3 rounded-lg bg-slate-50"
                        id="email" name="email" placeholder="E-mail Address" v-model="user.email" />
                </div>
                <div class="form-group px-3 w-full mb-4 sm:w-1/2 sm:mb-6">
                    <label for="username" class="mb-2 inline-block font-semibold">Username:<sup
                            class="text-red-900 text-xl leading-none top-0 relative">*</sup></label>
                    <input type="text" class="border border-gray-300 w-full px-3 py-3 rounded-lg bg-slate-50"
                        id="username" name="username" placeholder="Username" v-model="user.username" />
                </div>
            </div>
            <div class="row flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <div class="row flex flex-wrap -mx-3">
                        <div class="form-group px-3 w-full mb-4 sm:w-1/2 sm:mb-6">
                            <label for="active" class="mb-2 inline-block font-semibold">Active:</label>
                            <input type="checkbox" value="1" class="border border-gray-300 w-full px-3 py-3 rounded-lg bg-slate-50"
                                id="active" name="active" v-model="user.active" />
                        </div>
                        <div class="form-group px-3 w-full mb-4 sm:w-1/2 sm:mb-6">
                            <label for="user_role" class="mb-2 inline-block font-semibold">Administrator</label>
                            <input type="radio" value="2" class=""
                                name="user_role" v-model="user.user_role" />
                            <label for="user_role" class="mb-2 inline-block font-semibold">User</label>
                            <input type="radio" value="3" class=""
                            name="user_role" v-model="user.user_role" />
                        </div>
                        <div class="form-group px-3 w-full mb-4 sm:w-1/2 sm:mb-6">
                            <label for="meta_amount_invested_in_business_till_date"
                                class="mb-2 inline-block font-semibold">Last Login</label>
                            <span>12:00:00 AM(static)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex flex-wrap -mx-3">
                <div class="w-full px-3">
                    <div class="row flex flex-wrap -mx-3">
                        <div class="form-group px-3 w-full mb-4 sm:w-1/2 sm:mb-6">
                            <label for="active" class="mb-2 inline-block font-semibold">Companies:</label>
                            <select name="companies" multiple v-model="user.companies">
                                <option v-for="company in companies" :value="company.id">{{company.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row pt-5">
                <div class="w-full text-center">
                    <button type="submit"
                        class="sm:w-auto w-full text-center text-base text-white bg-sky-500 hover:bg-sky-500 px-6 py-3 rounded-xl transition ease-in-out delay-150 m-1">
                        Update Profile </button>
                </div>
            </div>
        </form>
        <!-- Loader -->
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt=""
                class="loader-img top-[50%] right-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
        
    </div>

</template>
<script>


export default {
    props:['companies'],
    data() {
        return {
            user: {
                firstname: "",
                lastname: "",
                email: "",
                username: "",
                active: "",
                lastlogin: "",
                companies: [],
                user_role: ""
            },
            viewLoader: false,
            url: process.env.MIX_API_URL,
        };
    },
    created() {
        console.log(this.companies);
    },
    methods: {
        createUser(e) {
            e.preventDefault();
            this.viewLoader = true;
            let app = this;

            axios.post(app.url + '/api/users/create', app.user).then(function (response) {
                console.log(response.data);
                if (response.data.success) {
                    
                    showSuccess(response.data.data.msg);
                } else {
                    showError(response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((err) => {
                app.viewLoader = false;
            });
        },
        moveUp() {
            jQuery('html,body').stop().animate({
                scrollTop: 0
            }, 'slow', 'swing');
        }
    },
};
</script>
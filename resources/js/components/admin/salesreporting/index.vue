<template>
    <div>
        <form v-on:submit="filterResults">
            <div class="flex flex-wrap -mx-2.5">
                <div class="w-full px-2.5 mb-7">
                    <div class="border-t-4 text-[20px] leading-[1] border-b border-slate-500 py-1.5 px-2">Filter</div>
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Search by Name (Last or Company)</label>
                    <input name="firstname" v-model="search_by_name" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Show</label>
                    <select name="Show" v-model="limit" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="1">Up to 100 matched transactions</option>
                        <option value="3">Up to 300 matched transactions</option>
                        <option value="5">Up to 500 matched transactions</option>
                        <option value="-1" selected="">All transactions (may take a while)</option>
                    </select>
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 items-end flex md:mb-3 px-2.5">
                    <div class="w-full md:w-1/2 mb-3 pr-2.5">
                        <label class="mb-1">From Date</label>
                        <select v-model="from_month" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option v-for="(month, i) in months" :value="(i+1)">{{month}}</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 mb-3 pl-2.5">
                        <select v-model="from_year" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option v-for="year in years" :value="year">{{year}}</option>
                        </select>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 items-end flex md:mb-3 px-2.5">
                    <div class="w-1/2 mb-3 pr-2.5">
                        <label class="mb-1">To Date</label>
                        <select v-model="to_month" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option v-for="(month, i) in months" :value="(i+1)">{{month}}</option>
                        </select>
                    </div>
                    <div class="w-1/2 mb-3 pl-2.5">
                        <select v-model="to_year" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option v-for="year in years" :value="year">{{year}}</option>
                        </select>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">By Industry</label>
                    <select v-model="industry" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value=""> All </option>
                        <option v-for="(industryObject, index) in industries" :value="index">{{industryObject}}</option>
                    </select>
                </div>
                
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Licensing Package</label>
                    <select v-model="licensing_package"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="" selected="">All</option>
                        <option value="1">1 Year</option>
                        <option value="2">2 Years</option>
                        <option value="3">3 Years</option>
                        <option value="4">4 Years</option>
                    </select>
                </div>

                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Order By</label>
                    <select v-model="orderByO" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option :value="orderBy.key" v-for="orderBy in orderBySelect">{{ orderBy.name }}</option>
                    </select>
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Plan</label>
                    <select name="Show" v-model="Searchversion" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="Select">All</option>
                        <option value="standard">Standard</option>
                        <option value="unlimited">Unlimited</option>
                        <option value="Pro" selected>Professional</option>
                    </select>
                </div>
                <div class="w-full px-2.5 text-right">
                    <input type="submit" value="Search" id="search_results" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" />
                </div>
            </div>
        </form>
        <div class="px-3 py-2 gradient-green text-white mt-4 mb-4"><span>Your search returned {{total}} record(s).</span></div>
        <div class="mt-5">
            <div class="flex flex-wrap -mx-2.5 items-center">
                <div class="w-1/2 pl-2.5">
                    <h3 class="text-xl text-black mb-2">Results</h3>
                </div>
                <div class="w-1/2 px-2.5">
                    <div class="flex items-center justify-end">
                        <input type="button" value="Export Report" v-on:click="exportSalesReport" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" />
                    </div>
                </div>
                
            </div>
            <p><strong style="color:#eb3333">Note:</strong> it is recommended to take a backup before deleting any sale record so that can reverted in case of accidental deletion.</p>
            <div class="w-full px-3 py-2 gradient-green text-white mt-4 mb-4"><span>Overall Sales Total: ${{totalSales}} record(s).</span></div>
            <div class="relative overflow-x-auto md:overflow-visible shadow-md">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th @click="sortTableWebapp('string')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Name</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp('string')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Company</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp('string')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>UserName / Email / Phone / Ext.</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp('string')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Industry</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp('string')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Description</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <!-- <th class="px-2 py-2 ">
                                <span class="flex items-center">
                                    <span>Coupon</span>
                                </span>
                            </th> -->
                            <th @click="sortTableWebapp('string')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Coupon</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp('num')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Licensing Package</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp('num')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Amount</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp2('num')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Years</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp('string')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Status</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th @click="sortTableWebapp('date')" class="px-2 py-2 cursor-pointer">
                                <!-- @click="sortTableDateWebapp()" -->
                                <span class="flex items-center">
                                    <span>Date</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                             <!-- <th class="px-2 py-2">
                                <span class="flex items-center">
                                    <span>Usage</span>
                                </span>
                            </th> -->
                            <th @click="sortTableWebapp('num')" class="px-2 py-2 cursor-pointer">
                                <span class="flex items-center">
                                    <span>Usage</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="px-2 py-2">
                                <span class="flex items-center">
                                    <span>Transaction ID</span>
                                </span>
                            </th>
                            <th class="px-2 py-2">
                                <span class="flex items-center">
                                    <span>Payment Status</span>
                                </span>
                            </th>
                            <th class="px-2 py-2">
                                <span class="flex items-center">
                                    <span>Action</span>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(transaction, index) in transactions" v-if="transactions.length > 0" :class="new Date(transaction.company_reports_expire) < new Date() ? 'bg-red-200 text-black' : 'odd:bg-white even:bg-gray-50'" class="data-employee" >
                            <td class="relative px-2 py-2" v-on:click="openPopup(transaction.id)" v-on:mouseleave="action = false" v-on:mouseover="action = transaction.id">
                                <span v-show="action === transaction.id"
                                    class="text-center left-1/2 -translate-x-2/4 -top-5 absolute bg-slate-700 text-white border-2 border-black w-40 rounded">
                                    <span>View Customer Information</span>
                                    <div
                                        class="absolute left-1/2 -translate-x-2/4 -bottom-2 w-3 h-3 -mt-2 rotate-45 bg-slate-700">
                                    </div>
                                </span>
                                <span class="text-blue-400 underline cursor-pointer">{{ transaction.lastname }}, {{ transaction.firstname }}</span>
                            </td>
                            <td class="px-2 py-2">{{ transaction.company_name }}</td>
                            <td class="px-2 py-2">
                                <span>
                                    <span class="block">
                                        <a class="underline" :href="'mailto:' + transaction.email">{{transaction.email}}</a>
                                    </span>
                                    <span class="block">
                                        {{transaction.username}}
                                    </span>
                                    <span class="block">
                                        <a class="underline" :href="'tel:' + transaction.company_telephone">{{transaction.company_telephone}}</a>
                                    </span>
                                    <span class="block">
                                        {{transaction.company_phone_ext}}
                                    </span>
                                </span>
                            </td>
                            <td class="px-2 py-2">{{ transaction.company_industry }}</td>
                            <td class="px-2 py-2" :class="(transaction.description == 'Pending' || transaction.description == 'Failed') ? 'text-red-700' : 'text-green-600 font-bold' ">
                                {{ dynamic_description(transaction) }}
                            </td>
                            <td class="px-2 py-2">{{ transaction.coupon_code }}</td>
                            <!-- <td class="px-2 py-2">
                                {{ (transaction.license_packages > 1) ? transaction.license_packages + ' Years' : transaction.license_packages + ' Year' }}
                            </td> -->
                            <td class="px-2 py-2">
                                <span v-if="transaction && transaction.plan_years && transaction.plan_years.year">
                                    {{ transaction.plan_years.year > 1 ? transaction.plan_years.year + ' Years' : transaction.plan_years.year + ' Year' }}
                                </span>
                                <span v-else>
                                    {{ (transaction.license_packages > 1) ? transaction.license_packages + ' Years' : transaction.license_packages + ' Year' }}
                                </span>
                            </td>


                            <!-- <td class="px-2 py-2">${{ transaction.amount }}</td> -->
                            <td class="px-2 py-2">
                                <span v-if="transaction.amount !== null">
                                ${{ formatAmount(transaction.amount) }}
                                </span>
                                <span v-else>
                                
                                </span>
                            </td>
                            <td class="px-2 py-2">{{ (transaction.year > 1) ? transaction.year + ' Years' : transaction.year + ' Year' }}</td>
                            <td v-if="new Date(transaction.company_reports_expire) > new Date()" class="px-2 py-2 text-green-400">Active</td>
                            <td v-else class="px-2 py-2 text-red-700">Expired</td>
                            <td class="px-2 py-2">{{ formatDateTime(transaction.created_at) }}</td>
                            <!-- <td class="px-2 py-2">{{ my_date_format1(transaction.reports_expires) }}</td> -->
                            <td class="px-2 py-2">{{ (transaction.plan_id !== 37 ) ? transaction.company_employees_count : transaction.companies_count }}</td>
                            <td class="px-2 py-2 text-blue-400 underline cursor-pointer" v-on:click="stOpenPopup(transaction.id)">{{ transaction.transaction_id }}</td>
                            <td class="px-2 py-2" v-bind:class="{ 'text-green-400': transaction.details === 'Successful', 'text-red-700': transaction.details !== 'Successful' }">{{ transaction.details }}</td>
                            <td class="px-2 py-2 text-blue-400 underline cursor-pointer" v-on:click="confirmDelete(transaction.sales_id)">Delete</td>
                        </tr>
                        <tr v-else >
                            <td colspan="11" class="text-center py-3 text-md px-2">No records found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Popup -->
        <div v-if="userD" class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20"></div>
        <div v-if="userD" class="max-h-[300px] md:max-h-full overflow-auto cpgmodal-container w-full max-w-[800px] p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7]">
            <span v-on:click="userD = false" class="cpgclose-popup absolute w-7 h-7 text-center text-red-400 hover:text-red-700 text-[30px] leading-[25px] top-0 right-0 rounded-full cursor-pointer">&times;</span>
            <admin-transactions-popup :user_id="popupUser.user_id"></admin-transactions-popup>
        </div>
        <!-- Popup -->
        <!-- Single Transaction Popup -->
        <div v-if="stp" class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20"></div>
        <div v-if="stp" class="max-h-[300px] md:max-h-full overflow-auto cpgmodal-container w-full max-w-[800px] p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7]">
            <span v-on:click="stp = false" id="close_transaction" class="cpgclose-popup absolute w-7 h-7 text-center text-red-400 hover:text-red-700 text-[30px] leading-[25px] top-0 right-0 rounded-full cursor-pointer">&times;</span>
            <admin-single-transactions-popup :popupuser="popupUser"></admin-single-transactions-popup>
        </div>
        <!-- Single Transaction Popup -->

        <!-- Loader -->
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>        

<script>
export default {
    props:['industries'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            action: false,
            transactions: [
            ],
            sort: 'id',
            sortDir: 'asc',
            orderByO: 'Ddate',
            orderBySelect: [
                {key: 'Adate', direction: 'asc', name:'Date (Ascending)',db_key: 'signup_date'},
                {key: 'Ddate', direction: 'desc', name:'Date (Descending)',db_key: 'signup_date'},
                {key: 'name', direction: 'desc', name:'Name',db_key: 'name'},
                {key: 'company', direction: 'desc', name:'Company',db_key: 'company'},
                {key: 'username', direction: 'desc', name:'Username',db_key: 'username'},
                {key: 'email address', direction: 'desc', name:'Email Address',db_key: 'email'},
                {key: 'industry', direction: 'desc', name:'Industry',db_key: 'industry'},
            ],
            // Filters
            search_by_name: '',
            limit: -1,
            from_month: new Date().getMonth()+1,
            from_year: new Date().getFullYear(),
            to_month: new Date().getMonth()+1,
            to_year: new Date().getFullYear(),
            industry: '',
            product: '',
            licensing_package: '',
            sales_type: '',
            total: 0,
            totalSales: 0,
            popupUser: null,
            userD: false,
            stp: false,
            Searchversion: 'Select',
            asc: true
        }
    },
    created() {
        let filters = {
            limit: this.limit,
            product: this.product,
            to_year: this.to_year,
            industry: this.industry,
            to_month: this.to_month,
            from_year: this.from_year,
            name: this.search_by_name,
            sales_type: this.sales_type,
            from_month: this.from_month,
            licensing_package: this.licensing_package,
            orderByO: this.orderBySelect.find((a) => this.orderByO === a.key),
            Searchversion: this.Searchversion
        }

        this.getTransactions( filters );
    },
    methods: {
        formatAmount(amount) {
            return parseFloat(amount).toFixed(2);
        },
        exportSalesReport(e) {
            e.preventDefault();
            let app = this;
            this.sortTableWebapp();
            app.viewLoader = true;
            alert('Note: It will download the report for filtered employees.');
            app.downloadCSVData();

        },
        confirmDelete(transaction_id) {
            if (confirm("ARE YOU SURE?? IT CAN'T BE UNDONE ONCE DELETED.")) {
                // User confirmed, proceed with deletion
                this.salesRecordDelete(transaction_id);
            } else {
                // User canceled, do nothing or provide feedback
            }
        },
        salesRecordDelete(transaction_id) {
            let app = this;
            app.viewLoader = true;
            // Perform the actual deletion here
            //alert("Deleting transaction with ID: " + transaction_id);
            axios.post( app.url + '/admin/salesreportingdelete', {tran_id: transaction_id} ).then((response) => { 
                //console.log(response);
                if( response.data.data.success ) {
                    alert(response.data.data.success);
                    let filters = {
                        limit: this.limit,
                        product: this.product,
                        to_year: this.to_year,
                        industry: this.industry,
                        to_month: this.to_month,
                        from_year: this.from_year,
                        name: this.search_by_name,
                        sales_type: this.sales_type,
                        from_month: this.from_month,
                        licensing_package: this.licensing_package,
                        orderByO: this.orderBySelect.find((a) => this.orderByO === a.key),
                        Searchversion: this.Searchversion
                    }
                    this.getTransactions(filters);
                    //location.href = location.href;
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
            });
        },
        getTransactions( filters = false ) {
            let app = this;
            app.viewLoader = true;

            if( ! filters ) {
                filters = {};
            }

            axios.post( app.url + '/admin/salesreporting', filters ).then((response) => { 
                if( response.data.success ) {
                    console.log( response.data.data );
                    app.transactions = response.data.data.transactions;
                    app.total = response.data.data.transactions.length;
                    app.totalSales = app.numberWithCommas(response.data.data.transactions.reduce((partialSum, a) => partialSum + a.amount, 0).toFixed(2));
                    app.sortTableWebapp('date');
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
            });
        },
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        sortBy(s) {
            if (s === this.sort) {
                this.sortDir = (this.sortDir === 'asc') ? 'desc' : 'asc';
            } else {
                this.sortDir = 'asc';
            }
            this.sort = s;
            this.transactions = this.sortedTransactionsm();
        },
        indsutry(id = false) {
            if(id) {
                let industry = this.industries.find((industry) => parseInt(industry.id) == parseInt(id));
                return ( industry ) ? industry.industry : '';
            } 
            return '';
        },
        filterResults(e) {
            e.preventDefault();

            let filters = {
                limit: this.limit,
                product: this.product,
                to_year: this.to_year,
                industry: this.industry,
                to_month: this.to_month,
                from_year: this.from_year,
                name: this.search_by_name,
                sales_type: this.sales_type,
                from_month: this.from_month,
                licensing_package: this.licensing_package,
                orderByO: this.orderBySelect.find((a) => this.orderByO === a.key),
                Searchversion: this.Searchversion
            }

            this.getTransactions( filters );
        },
        openPopup(user_id) {
            this.popupUser = this.transactions.find(x => x.id === user_id);
            if(this.popupUser) {
                this.userD = user_id;
            } else {
                showErrorMessage("Something went wrong!")
            }
        },
        stOpenPopup(transaction_id) {
            this.popupUser = this.transactions.find(x => x.id === transaction_id);
            if(this.popupUser) {
                this.stp = transaction_id;
            } else {
                showErrorMessage("Something went wrong!")
            }
        },
        formatDateTime(dateTimeString) {
            let [datePart, timePart] = dateTimeString.split(' '); // Split date and time
            let [month, day, year] = datePart.split('/').map(part => parseInt(part)); // Split date parts
            let [hour, minute, second] = timePart.split(':').map(part => parseInt(part)); // Split time parts
            if (timePart.includes('PM') && hour !== 12) {
                hour += 12; // Convert hour to 24-hour format if PM and not 12 PM
            } else if (!timePart.includes('PM') && hour === 12) {
                hour = 0; // Convert 12 AM to 0
            }
            let formattedDate = new Date(year, month - 1, day, hour, minute, second);
            return formattedDate.toLocaleString('en-US', { month: '2-digit', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
        },
        exportformatDateTime(dateTimeString) {
            // Extract date and time parts from dateTimeString
            let [datePart, timePart] = dateTimeString.split(' '); // Split date and time parts
            
            // Split date and time parts further
            let [month, day, year] = datePart.split('/').map(part => parseInt(part)); // Split date parts
            let [hour, minute, second] = timePart.split(':').map(part => parseInt(part)); // Split time parts

            // Adjust hour for 24-hour format
            if (timePart.includes('PM') && hour !== 12) {
                hour += 12; // Convert hour to 24-hour format if PM and not 12 PM
            } else if (!timePart.includes('PM') && hour === 12) {
                hour = 0; // Convert 12 AM to 0
            }

            // Create a Date object
            let formattedDate = new Date(year, month - 1, day, hour, minute, second);
            let isoFormattedDate = formattedDate.toISOString().replace('T', ' ').replace(/\.\d+Z/, '');
            return isoFormattedDate.toLocaleString('en-US', { month: '2-digit', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
        },
        /*
        downloadCSVData() {
            let csv1 = "Name,Company,UserName,Email,Phone,Industry,Description,Licensing Package,Amount / Credits,Years,Date,Transaction ID,Coupon,Status, Payment Status\n";

            for (let transaction of this.transactions) {

                let formattedDate = this.formatDateTime(transaction.created_at);
                //let formattedDate = this.formatDateTime(transaction.updated_at);

                let plan_years = '';
                if (transaction && transaction.plan_years && transaction.plan_years.year) {
                    //console.log(transaction.plan_years.year);
                    plan_years = transaction.plan_years.year;
                }
                let replacedCSV = transaction.company_name ? transaction.company_name.replace(/,/g, '') : '';
                let reportsstatus = new Date(transaction.company_reports_expire) > new Date() ? 'Active' : 'Expired';
                let couponCode = transaction.coupon_code !== null ? transaction.coupon_code : ''; // Handle null value

                csv1 += `"${transaction.firstname} ${transaction.lastname}",`;
                csv1 += `"${replacedCSV}",`;
                csv1 += `"${transaction.username}",`;
                csv1 += `"${transaction.email}",`;
                csv1 += `"${transaction.company_telephone}",`;
                csv1 += `"${transaction.company_industry}",`;
                csv1 += `"${transaction.description}",`;
                csv1 += `"${(plan_years > 1) ? plan_years + ' Years' : plan_years + ' Year'}",`;
                csv1 += `"${transaction.amount ? '$' + transaction.amount : ''}",`;
                csv1 += `"${(transaction.year > 1) ? transaction.year + ' Years' : transaction.year + ' Year'}",`;
                csv1 += `"${formattedDate}",`;

                csv1 += `"${transaction.transaction_id}",`;
                csv1 += `"${couponCode}",`;
                csv1 += `"${reportsstatus}",`;

                csv1 += `"${transaction.details}"\n`;
            }

            var currentdate = new Date();
            var datetime = currentdate.getFullYear() + "-" + (currentdate.getMonth()+1) + "-" + currentdate.getDate();
            this.viewLoader = false;
            const anchor = document.createElement('a');
            anchor.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv1);
            anchor.target = '_blank';
            anchor.download = 'Sales Report '+datetime+'.csv';
            anchor.click();
            
        },
        */


        sortedTransactionsm(key, ) {
            this.orderByO = key;

            let filters = {
                limit: this.limit,
                product: this.product,
                to_year: this.to_year,
                industry: this.industry,
                to_month: this.to_month,
                from_year: this.from_year,
                name: this.search_by_name,
                sales_type: this.sales_type,
                from_month: this.from_month,
                licensing_package: this.licensing_package,
                orderByO: this.orderBySelect.find((a) => this.orderByO === a.key)
            }

            this.getTransactions( filters );
        },
        formatDate(string) {
            let objectDate = new Date(string);
            let day = objectDate.getDate();
            let month = objectDate.getMonth();
            let year = objectDate.getFullYear();
            let hour = objectDate.getHours() > 9 ? objectDate.getHours(): '0'+objectDate.getHours();
            let minute = objectDate.getMinutes() > 9 ? objectDate.getMinutes(): '0'+objectDate.getMinutes();
            let seconds = objectDate.getSeconds() > 9 ? objectDate.getSeconds(): '0'+objectDate.getSeconds();

            return (month + 1) + '/' + (day) + '/' + (year) + ' ' + (hour) + ':' + (minute) + ':' + (seconds);
        },
       
        isDate(value) {
            return (new Date(value) !== "Invalid Date") && !isNaN(new Date(value));
        },
        
       
        sortTableWebapp(col){
            this.custom_sort(col);
            return false;
           console.log("1111111111111SSSSQQQQ");
            this.viewLoader = true;
            this.asc = false; // Initialize asc to false

            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

            const comparer = (idx, asc) => (a, b) => {
                const v1 = getCellValue(asc ? a : b, idx);
                const v2 = getCellValue(asc ? b : a, idx);
                return v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
            };

            document.querySelectorAll('th').forEach(th => {
                th.addEventListener('click', () => {
                    const table = th.closest('table');
                    const rows = Array.from(table.querySelectorAll('tr.data-employee'));
                    
                    // Get the index of the clicked header
                    const index = Array.from(th.parentNode.children).indexOf(th);
                    
                    // Sort the rows
                    const sortedRows = rows.sort(comparer(index, this.asc));
                    
                    // Append the sorted rows back to the table
                    sortedRows.forEach(tr => table.appendChild(tr));
                    
                    // Toggle the sorting direction
                    this.asc = !this.asc;
                });
            });

            setTimeout(() => {
                this.viewLoader = false;
            }, 1000);

    
        },

        sortTableWebapp2(col) {
            this.custom_sort(col);
            return false;
            let app = this;
            app.viewLoader = true;
            
            const getCellValue = (tr, idx) => {
                const cellValue = tr.children[idx].innerText || tr.children[idx].textContent;
                return isNumeric(cellValue) ? parseFloat(cellValue) : cellValue;
            };

            const isNumeric = (value) => !isNaN(parseFloat(value)) && isFinite(value);

            const comparer = (idx, asc) => (a, b) => {
                const valueA = getCellValue(asc ? a : b, idx);
                const valueB = getCellValue(asc ? b : a, idx);

                // Use localeCompare for string comparison, and parseFloat for numeric comparison
                return valueA.localeCompare(valueB, undefined, { numeric: true, sensitivity: 'base' });
            };

            document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
                const table = th.closest('table');
                Array.from(table.querySelectorAll('tr.data-employee'))
                    .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                    .forEach(tr => table.appendChild(tr));
            })));

            setTimeout(() => {
                app.viewLoader = false;    
            }, 1000);
        },

        getColTypeForIndex(index) {
          const colTypes = ['string', 'string', 'string',
            'string',
            'string',
            'string',
            'num',
            'num',
            'num',
            'string',
            'date',
            'num',
          ]; // Example colType values for columns
          return colTypes[index] || 'text'; // Return the colType for the column or default to 'text'
        },
        // 
        custom_sort(colType = 'string') {
            this.viewLoader = true;
            // this.asc = false; // Start with ascending order

            const getCellValue = (tr, idx) => tr.children[idx]?.innerText || tr.children[idx]?.textContent || '';

            // Extract numerical value from strings like "1 Year", "$2", etc.
            const extractNumber = (value) => {
                const num = value.match(/[\d\.]+/); // This will extract the number part
                return num ? parseFloat(num[0]) : NaN; // If a number is found, return it; otherwise, return NaN
            };

            // Parse the custom date format MM/DD/YYYY, h:m:s AM/PM
            const extractDate = (value) => {
                const dateParts = value.match(/(\d{2})\/(\d{2})\/(\d{4}), (\d{2}):(\d{2}):(\d{2}) (AM|PM)/);

                if (dateParts) {
                    let [_, month, day, year, hours, minutes, seconds, meridian] = dateParts;
                    month = parseInt(month, 10) - 1;  // JavaScript months are 0-based
                    day = parseInt(day, 10);
                    year = parseInt(year, 10);
                    hours = parseInt(hours, 10);
                    minutes = parseInt(minutes, 10);
                    seconds = parseInt(seconds, 10);

                    // Convert 12-hour clock to 24-hour clock
                    if (meridian === 'PM' && hours < 12) hours += 12;
                    if (meridian === 'AM' && hours === 12) hours = 0;

                    // Return a Date object
                    return new Date(year, month, day, hours, minutes, seconds).getTime();
                }
                return null;
            };

            const comparer = (idx, asc, colType1) => (a, b) => {
                const v1 = getCellValue(asc ? a : b, idx).trim();
                const v2 = getCellValue(asc ? b : a, idx).trim();
                // Handle different column types
                if (colType1 == 'date') {
                    // Check if both values are valid dates
                    const date1 = extractDate(v1);
                    const date2 = extractDate(v2);

                    if (date1 !== null && date2 !== null) {
                        return date1 - date2;
                    }
                } else if (colType1 == 'num') {
                    // Try to extract numerical values from the strings
                    const num1 = extractNumber(v1);
                    const num2 = extractNumber(v2);
                    if (!isNaN(num1) && !isNaN(num2)) {
                        return num1 - num2;
                    }
                }

                // Default to string comparison for 'string' type or fallback
                return v1.localeCompare(v2);
            };

          document.querySelectorAll('th').forEach((th, idx) => {
            // Check if the event listener is already attached
            if (!th.hasListener) {
              th.addEventListener('click', () => {
                const currentColType = this.getColTypeForIndex(idx); // Define how to get the colType for each column

                const table = th.closest('table');
                const rows = Array.from(table.querySelectorAll('tr.data-employee'));
                // Sort the rows
                const sortedRows = rows.sort(comparer(idx, th.asc, currentColType));

                // Create a DocumentFragment to optimize rendering
                const fragment = document.createDocumentFragment();
                sortedRows.forEach(tr => fragment.appendChild(tr));

                // Append the fragment back to the table
                table.querySelector('tbody').appendChild(fragment);

                // Toggle sorting direction for the next click
                th.asc = !th.asc;
              });

              // Mark that this th has an event listener
              th.hasListener = true;
            }
          });


          setTimeout(() => {
                this.viewLoader = false;
            }, 1000);

            // console.log("Sorting function triggered");
            // this.viewLoader = true;
            // this.asc = true; // Start with ascending order

            // const getCellValue = (tr, idx) => tr.children[idx]?.innerText || tr.children[idx]?.textContent || '';

            // // Extract numerical value from strings like "1 Year", "$2", etc.
            // const extractNumber = (value) => {
            //     const num = value.match(/[\d\.]+/); // This will extract the number part
            //     return num ? parseFloat(num[0]) : NaN; // If a number is found, return it; otherwise, return NaN
            // };

            // // Check if a string is a valid date and return its timestamp
            // const extractDate = (value) => {
            //     const date = Date.parse(value); // Returns NaN if not a valid date
            //     return isNaN(date) ? null : date; // Return null if not a date
            // };

            // const comparer = (idx, asc, colType) => (a, b) => {
            //     const v1 = getCellValue(asc ? a : b, idx).trim();
            //     const v2 = getCellValue(asc ? b : a, idx).trim();

            //     // Handle different column types
            //     if (colType === 'date') {
            //         // Check if both values are valid dates
            //         const date1 = extractDate(v1);
            //         const date2 = extractDate(v2);

            //         if (date1 !== null && date2 !== null) {
            //             return date1 - date2;
            //         }
            //     } else if (colType === 'num') {
            //         // Try to extract numerical values from the strings
            //         const num1 = extractNumber(v1);
            //         const num2 = extractNumber(v2);

            //         if (!isNaN(num1) && !isNaN(num2)) {
            //             return num1 - num2;
            //         }
            //     }

            //     // Default to string comparison for 'string' type or fallback
            //     return v1.localeCompare(v2);
            // };

            // document.querySelectorAll('th').forEach((th, idx) => {
            //     th.addEventListener('click', () => {
            //         const table = th.closest('table');
            //         const rows = Array.from(table.querySelectorAll('tr.data-employee'));

            //         // Get the column type from the passed parameter
            //         // const colType = columnTypes[idx];  // Use the column index to find the type

            //         // Sort the rows
            //         const sortedRows = rows.sort(comparer(idx, this.asc, colType));

            //         // Create a DocumentFragment to optimize rendering
            //         const fragment = document.createDocumentFragment();
            //         sortedRows.forEach(tr => fragment.appendChild(tr));

            //         // Append the fragment back to the table
            //         table.querySelector('tbody').appendChild(fragment);

            //         // Toggle sorting direction for the next click
            //         this.asc = !this.asc;
            //     });
            // });

            // setTimeout(() => {
            //     this.viewLoader = false;
            // }, 1000);
        },

        // 

        downloadCSVData() {
            const transactions = [...this.transactions];
            /*
            const sortedTransactions = transactions.sort((a, b) => {
                const val1 = this.asc ? a.amount - b.amount : b.amount - a.amount;
                return val1 !== 0 ? val1 : a.created_at.localeCompare(b.created_at);
            });
            */
            /*let sortedTransactions = this.transactions.slice().sort((a, b) => {
                if (this.sortDir === 'asc') {
                    return a[this.sort] < b[this.sort] ? -1 : (a[this.sort] > b[this.sort] ? 1 : 0);
                } else {
                    return a[this.sort] > b[this.sort] ? -1 : (a[this.sort] < b[this.sort] ? 1 : 0);
                }
            });*/
            let sortedTransactions = this.transactions;
            // Generate CSV string from sorted transactions data
            let csv1 = "Name,Company,UserName,Email,Phone,Industry,Description,Licensing Package,Amount / Credits,Years,Date,Transaction ID,Coupon,Status,Payment Status\n";
            for (let transaction of sortedTransactions) {
                //let formattedDate = this.formatDateTime(transaction.created_at);
                let formattedDate = this.exportformatDateTime(transaction.created_at);
                let plan_years = transaction.plan_years && transaction.plan_years.year ? transaction.plan_years.year : '';
                let replacedCSV = transaction.company_name ? transaction.company_name.replace(/,/g, '') : '';
                let reportsstatus = new Date(transaction.company_reports_expire) > new Date() ? 'Active' : 'Expired';
                let couponCode = transaction.coupon_code !== null ? transaction.coupon_code : '';

                csv1 += `"${transaction.firstname} ${transaction.lastname}",`;
                csv1 += `"${replacedCSV}",`;
                csv1 += `"${transaction.username}",`;
                csv1 += `"${transaction.email}",`;
                csv1 += `"${transaction.company_telephone}",`;
                csv1 += `"${transaction.company_industry}",`;
                csv1 += `"${transaction.description}",`;
                csv1 += `"${(plan_years > 1) ? plan_years + ' Years' : plan_years + ' Year'}",`;
                csv1 += `"${transaction.amount ? '$' + transaction.amount : ''}",`;
                csv1 += `"${(transaction.year > 1) ? transaction.year + ' Years' : transaction.year + ' Year'}",`;
                csv1 += `"${formattedDate}",`;
                csv1 += `"${transaction.transaction_id}",`;
                csv1 += `"${couponCode}",`;
                csv1 += `"${reportsstatus}",`;
                csv1 += `"${transaction.details}"\n`;
            }

            // Create download link
            const anchor = document.createElement('a');
            anchor.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv1);
            anchor.target = '_blank';

            // Construct filename with current date
            const currentDate = new Date();
            const datetime = `${currentDate.getFullYear()}-${currentDate.getMonth() + 1}-${currentDate.getDate()}`;
            anchor.download = `Sales Report ${datetime}.csv`;

            // Append the anchor to the body and click it to trigger download
            document.body.appendChild(anchor);
            anchor.click();

            // Remove the anchor from the body
            document.body.removeChild(anchor);

            // Set view loader to false
            this.viewLoader = false;
        },
        my_date_format(input){
            //console.log(input);
            var d = new Date(input);
            var month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            var date =  d.getFullYear() + "-" + (month[d.getMonth()]) + "-" + d.getDate();
            var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
            //console.log(time);
            return (date + " " + time);  
        },
        my_date_format1(input){
            //console.log(input);
            var d = new Date(input);
            var month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            var date =  (month[d.getMonth()]) + "-" + ((d.getDate() < 10) ? '0'+d.getDate() : d.getDate()) + "-" + d.getFullYear();
            var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
            return (date);  
        },
        dynamic_description(transaction) {
            // {{ transaction.description }} <span v-if="(transaction.coupon_code != '' && transaction.coupon_code != null)">, {{ transaction.coupon_code }}</span>
            let html = '';
            let year = '';
            let coupon = '';
            if( transaction.coupon_code != '' && transaction.coupon_code != null ) {
                coupon = ', '+transaction.coupon_code;
            }
            //if( transaction.resubscribing ) {
            if( transaction.resubscribed ) {
                if( transaction.plan_id && transaction.plans ) {
                    /*
                    if( transaction.years.year && transaction.years && transaction.years.year ) {
                        year = `${transaction.years.year} year(s) for `;
                    }
                    */
                    if (transaction && transaction.plan_years && transaction.plan_years.year) {
                        //console.log(transaction.plan_years.year);
                        year = `${transaction.plan_years.year} year(s) for `;
                    }
                    html += `Resub ${transaction.plans.name} reports for ${year}$${this.formatAmount(transaction.amount)} plus ${transaction.company_reportsadditional} report(s) @ $20 each${coupon}`;
                } else {
                    html += `${ transaction.description } ${(transaction.coupon_code != '' && transaction.coupon_code != null)}, ${ transaction.coupon_code }${coupon}`;
                }
            } else {
                if( transaction.plan_id && transaction.plans ) {
                    /*
                    if( transaction && transaction.years && transaction.years.year ) {
                        year = `${transaction.years.year} year(s) for `;
                    }
                    */
                    if (transaction && transaction.plan_years && transaction.plan_years.year) {
                        //console.log(transaction.plan_years.year);
                        year = `${transaction.plan_years.year} year(s) for `;
                    }
                    html += `Purchase ${transaction.plans.name} reports for ${year}$${this.formatAmount(transaction.amount)} plus ${transaction.company_reportsadditional} report(s) @ $20 each${coupon}`;
                } else {
                    
                    html += `${ transaction.description }${coupon}`;
                }
            }
            return html;
        }
    },
    computed: {
        sortedTransactions: function () {
            return this.transactions.sort((a, b) => {
                let dir = (this.sortDir === 'asc') ? 1 : -1;
                if (a[this.sort] < b[this.sort]) {
                    return -1 * dir;
                } else if (a[this.sort] > b[this.sort]) {
                    return 1 * dir;
                } else {
                    return 0;
                }
            })
        },
        years() {
            let years = [];
            for (var i = 2005; i <= new Date().getFullYear(); i++) {
                years.push(i);
            }
            return years;
        },
        months() {
            return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        }
    },
}
</script>
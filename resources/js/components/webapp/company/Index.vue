<template>
<div class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20" v-show="PopupShow"></div>
<div class="cpgmodal-container w-full max-w-[500px] p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7]" v-show="PopupShow">
      <span v-on:click="PopupShow= false" class="cpgclose-popup absolute w-7 h-7 text-center bg-black text-white text-[26px] leading-[25px] border-2 border-white shadow-md top-0 right-0 lg:-top-2.5 lg:-right-2.5 rounded-full cursor-pointer">&times;</span>
      <div class="h-full max-h-[300px] lg:max-h-[800px] overflow-auto pr-5">
        <h3 class="leading-normal md:text-sm lg:text-lg text-lg text-greendarkclr mb-2 font-bold uppercase">ADDING A NEW COMPANY</h3>
        <ol class="list-decimal text-[13px] text-black pl-6">
            <li class="mb-2">Confirm that the first company in the list is selected in the global Company dropdown</li>
            <li class="mb-2">Click the Add New Company button</li>
            <li class="mb-2">Fill in the information for the company that you are adding. It is only required that you fill out the Company Name and Telephone number.</li>
            <li class="mb-2">Select the Save Information button</li>
            <!-- <li class="mb-2">Term; Survival of Provisions. This License Agreement is effective upon your installation of the Licensed Program shall continue until the sooner of: 1) one year following such installation date; or 2) the date upon which you have generated cumulatively the total number of Purchased Reports using the Licensed Program. You may terminate this License Agreement at any time by returning the Licensed Program and all copies thereof and extracts therefrom to Licensor. Licensor may terminate this License Agreement upon the breach by you of any term hereof. Upon such termination by Licensor, you agree to return to Licensor the Licensed Program and all copies and portions thereof. The provisions of Sections 2, 3, 6, 7, 9, 10 and 11 shall survive the termination or expiration of this License Agreement.</li> -->
            <li class=""><em>Your Company</em> will appear in the Company List. By clicking the 'Select' link next to <em>Your Company</em>, you can edit any of the details. Before adding users to <em>Your Company</em>, you MUST add the company first.</li>
        </ol>
      </div>
    </div>
    <div class="table-section mt-6">
        <div class="w-full flex items-center justify-end mb-4">
            <a v-if="permissions.create" :href="url + '/webapp/companies/create'" class="mr-3 rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">Add New Company</a>
            <a href="javascript:void(0)" v-on:click="PopupShow=true" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm">Directions</a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">Select</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                            
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">Company Name</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                            
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">City</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                            
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">State</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                            
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">Total Reports</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                            
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="flex items-center">
                                <span class="mr-2">Reports Left</span>
                                <span v-on:click="sortTable()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </span>
                            
                        </th>
                        <th scope="col" class="px-6 py-3">
                            OPEN
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(company, index) in companies" class="data-employee border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" data-label="Serial">
                            {{ (pagination.from + index) }}
                        </th>
                        <td data-label="Name" class="px-6 py-4">
                            {{ company.name }}
                        </td>
                        <td data-label="City" class="px-6 py-4">
                            {{ company.city }}
                        </td>
                        <td data-label="State" class="px-6 py-4">
                            {{ company.state }}
                        </td>
                        <td data-label="Total Reports" class="px-6 py-4">
                            {{ (company.total_reports >= 10000 ) ? 'Unlimited' : company.total_reports }}
                        </td>
                        <td data-label="Reports Left" class="px-6 py-4">
                            {{ (company.reports_left >= 10000 ) ? 'Unlimited' : company.reports_left }}
                        </td>
                        <td data-label="Update" class="px-6 py-4">
                            <a v-if="permissions.update" :href="url + '/webapp/companies/edit/' + company.id">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                        </td>
                    </tr>
                    <!-- <tr v-else class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <th scope="col" class="px-4 py-2 text-center" colspan="7">
                            No records found
                        </th>
                    </tr> -->
                </tbody>
            </table>
        </div>

        <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" :paginate="getCompanies"></pagination>

        <!-- Mark as complete popup:End -->
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'permissions'
    ],
    data() {
        return {
            pagination:{},
            companies: {},
            sortedData: [],
            pagination: {},
            PopupShow: false,
            sortedbyASC: true,
            viewLoader: false,
            url: process.env.MIX_API_URL,
        }
    },
    created() {
        this.getCompanies();
    },
    methods: {
        getCompanies(filters = false, page = 1) {
            let app = this;
            app.viewLoader = true;
            axios.get( app.url + '/api/companies?page=' + page).then((response) => {
                if(response.data.success) {
                    app.companies = response.data.data.companies;
                    app.pagination = response.data.data.pagination;
                }
                app.viewLoader = false;
            }).catch((error) => {
                showErrorMessage(error);
                app.viewLoader = false;
            });
        },
        sortTable(){
            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => ((v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2) ) (getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

            document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
                const table = th.closest('table');
                Array.from(table.querySelectorAll('tr.data-employee'))
                    .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                    .forEach(tr => table.appendChild(tr) );
            })));
        }
    }
}
</script>
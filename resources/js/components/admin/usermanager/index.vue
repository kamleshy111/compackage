<template>
    <div>
        <form v-on:submit="filterResults">
            <div class="flex flex-wrap -mx-2.5">
                <div class="w-full px-2.5 mb-7">
                    <div class="border-t-4 text-[20px] leading-[1] border-b border-slate-500 py-1.5 px-2">Filter</div>
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Search By:</label>
                    <select name="Show" v-model="search_by" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="user">User</option>
                        <option value="company">Company</option>
                    </select>
                    <label class="mb-1">Search by Name</label>
                    <input name="firstname" v-model="search_by_name" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Show</label>
                    <select name="Show" v-model="limit" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="100">Up to 100 matched users</option>
                        <option value="300">Up to 300 matched users</option>
                        <option value="500">Up to 500 matched users</option>
                        <option value="-1" selected="">All users (may take a while)</option>
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
                    <label class="mb-1">Filter</label>
                    <select name="Filter" v-model="filter"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="" selected="">[No Filter]</option>
                        <option value="active">Active Users Only</option>
                        <option value="expired">Expired Users Only</option>
                        <option value="retailusers">Retail Users Only</option>
                        <option value="active_retailusers">Active Retail Users</option>
                        <option value="expired_retailusers">Expired Retail Users</option>
                        <!-- <option value="testing">Testing Accounts Only</option>
                        <option value="aflac">AFLAC Users Only</option>
                        <option value="non_aflac">Non-AFLAC Users Only</option> -->
                    </select>
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">By Industry</label>
                    <select v-model="industry" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value=""> All </option>
                        <option v-for="industryObject in industries" :value="industryObject.id">{{industryObject.industry}}</option>
                    </select>
                </div>
                <!-- <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Transactions (Did not find any relationship in DB)</label>
                    <select name="Purchase"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="All" selected="">All Transactions</option>
                        <option value="Purchases">Purchases Only</option>
                    </select>
                </div> -->
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Order By</label><!--v-on:change="orderBySele()" -->
                    <select v-model="orderByO" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option :value="orderBy.key" v-for="orderBy in orderBySelect">{{ orderBy.name }}</option>
                    </select>
                </div>
                <div class="w-full px-2.5 text-right">
                    <input type="submit" value="Search" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" />
                </div>
            </div>
        </form>
        <div class="mt-8 mb-1 relative">
            <div class="flex items-center justify-end">
                <div class="cursor-pointer border border-gray-600 flex items-center pl-2.5 pr-1.5 py-1" v-on:click="hoveractionclck">
                    <span class="mr-3">Display</span>
                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </div>
            </div>

            <div v-show="hoveraction" class="w-full max-w-[480px] bg-white absolute right-0 shadow-sm ml-auto p-2 z-10">
                <ul class="flex flex-wrap -mx-2.5" style="">
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="UName" class=""><input type="checkbox" v-on:click="removeUName()" class="mr-1.5" id="UName" checked="checked">User Name</label>
                    </li>
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="emailphone" class=""><input type="checkbox" v-on:click="removeEmailPhone()" class="mr-1.5" id="emailphone" checked="checked">Email/Phone</label>
                    </li>
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="industry" class=""><input type="checkbox" v-on:click="removeIndustry()" class="mr-1.5" id="industry" checked="checked">Industry</label>
                    </li>
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="reportsleft" class=""><input type="checkbox" v-on:click="removeReportLft()" class="mr-1.5" id="reportsleft" checked="checked">Reports Left</label>
                    </li>
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="processed"  class=""><input type="checkbox" v-on:click="removeProcessed()" class="mr-1.5" id="processed" checked="checked">Processed</label>
                    </li>
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="credited" class=""><input type="checkbox" v-on:click="removeCredited()" class="mr-1.5" id="credited" checked="checked">Credited</label>
                    </li>
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="product" class=""><input type="checkbox" v-on:click="removeProduct()" class="mr-1.5" id="product" checked="checked">Product</label>
                    </li>
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="signupdate" class=""><input type="checkbox" v-on:click="removeSDate()" class="mr-1.5" id="signupdate" checked="checked">Sign-Up Date</label>
                    </li>
                    <li class="w-full md:w-1/3 px-2.5">
                        <label for="expirationdate" class=""><input type="checkbox" v-on:click="removeEDate()" class="mr-1.5" id="expirationdate" checked="checked">Expiration Date</label>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <div class="w-full px-2.5 mb-7 border-t-4 text-[20px] leading-[1] border-b border-slate-500 py-1.5 px-2">Results ({{total}})</div>
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">#</span>
                                </span>
                            </th>

                            <th class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Name</span>
                                    <span v-on:click="sortTableWebapp()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </span>    
                            </th>
                            <th class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Pro Cust</span>
                                </span>    
                            </th>
                            
                            <th class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Company</span>
                                    <span v-on:click="sortTableWebapp()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </span>
                            </th>
                            <th v-show="hideUName" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">User Name</span>
                                    <span v-on:click="sortTableWebapp()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </span>
                            </th>
                            <th v-show="hideEmailPhone" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Email Phone</span>
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
                            <th v-show="hideIndustry" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Industry</span>
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
                            <th v-show="hideReportLft" class="px-2 py-2">
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
                            <th v-show="hideProcessed" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Processed</span>
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
                            <!-- <th v-show="hideCredited" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Credited</span>
                                    <span v-on:click="sortTable()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </span>
                            </th> -->
                            <!-- <th v-show="hideProduct" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Product</span>
                                    <span v-on:click="sortTable()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </span>
                            </th> -->
                            <th v-show="hideSDate" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Signup Date</span>
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
                            <th v-show="hideEDate" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Expiration Date</span>
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
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr class="data-employee odd:bg-white even:bg-gray-50" v-for="(user, index) in users" v-if="users.length > 0">

                            
                            <td class="px-2 py-2">{{ (index + 1) }}</td>

                            <td class="flex items-center relative px-2 py-2 cursor-pointer" v-on:click="openPopup(user.id)"
                                >
                                <span v-show="action === user.id"
                                    class="text-center left-0 -top-5 absolute bg-slate-700 text-white border-2 border-black w-40 rounded">
                                    <span>View Customer Information</span>
                                    <div
                                        class="absolute left-1/2 -translate-x-2/4 -bottom-2 w-3 h-3 -mt-2 rotate-45 bg-slate-700">
                                    </div>
                                </span>
                                <span class="underline text-blue-700" v-on:mouseleave="action = false" v-on:mouseover="action = user.id">{{ user.lastname }}, {{ user.firstname }}</span>
                                
                            </td>
                            <td class="px-2 py-2">
                                <span title="Customer of a customer" v-if="user.parent_user">
                                    <strong>{{ user.parent_user }}</strong>
                                </span>
                            </td>
                            <td class="px-2 py-2" v-html="companylog(user, 'name')"></td>
                            <td v-show="hideUName" class="px-2 py-2">{{ user.username }}</td>
                            <td v-show="hideEmailPhone" class="px-2 py-2"><a :href="'mailto:'+user.email" class="block underline">{{user.email}}</a><span class="block"
                                    v-html="companylog(user, 'telephone')"></span></td>
                            <td v-show="hideIndustry" class="px-2 py-2" v-html="industrylog(user, 'industry')"></td>
                            <td v-show="hideReportLft" class="px-2 py-2" v-html="(log(user, 'reports') == -1) ? 'Unlimited' : (companylog(user, 'reports_left')) ? companylog(user, 'reports_left') : 0"></td> <!-- user.reportsleft -->
                            <td v-show="hideProcessed" class="px-2 py-2">{{ companylog(user, 'reports_processed') }}</td>
                            <!-- <td v-show="hideCredited" class="px-2 py-2">{{ user.reports_credit }}</td> -->
                            <!-- <td v-show="hideProduct" class="px-2 py-2">{{ user.product }}</td> -->
                            <td v-show="hideSDate" class="px-2 py-2" v-html="companylog(user, 'signup_date')"></td>
                            <td v-show="hideEDate" class="px-2 py-2" v-html="companylog(user, 'reports_expire')"></td>
                        </tr>
                        <tr v-else>
                            <td colspan="100" align="center" style="padding: 10px;font-size:18px;">No Results Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Popup -->
        <div v-if="userD"
            class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20">
        </div>
        <div v-if="userD"
            class="max-h-[300px] md:max-h-full overflow-auto cpgmodal-container w-full max-w-[800px] p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7]">
            <span v-on:click="userD = false"
                class="cpgclose-popup absolute w-7 h-7 text-center text-red-400 hover:text-red-700 text-[30px] leading-[25px] top-0 right-0 rounded-full cursor-pointer">&times;</span>
            <admin-transactions-popup :user_id="popupUser.id"></admin-transactions-popup>
        </div>
        <!-- Popup -->
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>        



<script>
export default {
    props: ['industries'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            action: false,
            hoveraction: false,
            userD: false,
            hideUName: true,
            hideEmailPhone: true,
            hideIndustry: true,
            hideReportLft: true,
            hideProcessed: true,
            hideCredited: true,
            hideProduct: true,
            hideSDate: true,
            hideEDate: true,
            orderByO: 'Ddate',
            orderBySelect: [
                {key: 'Adate', direction: 'asc', name:'Sign-up Date (Ascending)',db_key: 'signup_date'},
                {key: 'Ddate', direction: 'desc', name:'Sign-up Date (Descending)',db_key: 'signup_date'},
                {key: 'name', direction: 'desc', name:'Name',db_key: 'name'},
                {key: 'company', direction: 'desc', name:'Company',db_key: 'company'},
                {key: 'username', direction: 'desc', name:'Username',db_key: 'username'},
                {key: 'email address', direction: 'desc', name:'Email Address',db_key: 'email'},
                {key: 'industry', direction: 'desc', name:'Industry',db_key: 'email'},
            ],
            users: [],
            popupUser: null,
            // Filters
            search_by_name: '',
            limit: -1,
            from_month: new Date().getMonth()+1,
            from_year: new Date().getFullYear(),
            to_month: new Date().getMonth()+1,
            to_year: new Date().getFullYear(),
            industry: '',
            total: 0,
            search_by: 'user',
            filter: ''
        }
    },
    created() {
        let filters = {
            limit: this.limit,
            to_year: this.to_year,
            industry: this.industry,
            to_month: this.to_month,
            from_year: this.from_year,
            name: this.search_by_name,
            from_month: this.from_month,
            orderByO: this.orderBySelect.find((a) => this.orderByO === a.key),
            search_by: this.search_by,
            filter: this.filter
        };
        this.getUsers(filters);
    },
    methods: {
        filterResults(e) {
            e.preventDefault();

            let filters = {
                limit: this.limit,
                to_year: this.to_year,
                industry: this.industry,
                to_month: this.to_month,
                from_year: this.from_year,
                name: this.search_by_name,
                from_month: this.from_month,
                orderByO: this.orderBySelect.find((a) => this.orderByO === a.key),
                search_by: this.search_by,
                filter: this.filter
            }

            this.getUsers( filters );
        },
        log( user, key ) {
            if( key == 'reports_expires' ) {
                if( user.companies && user.companies[0] ) {
                    // return user.companies[0].reports_expire + ' 00:00:00';
                    return this.formatDate(user.companies[0].reports_expire + ' 00:00:00');
                    
                }
            }

            if( user.sales && user.sales[0] ) {
                return user.sales[0][key];
            }
            return '';
        },
        companylog(user, key) {
            if( user.companies && user.companies.length > 0 ) {
                let keyArr = [];
                user.companies.forEach((v, i) => {
                    if( i == 0 ) {
                        if( key == 'reports_left' ) {
                            if( v[key] >= 10000 ) {
                                keyArr.push('Unlimited');
                            } else {
                                keyArr.push(v[key]);
                            }
                        } else if( key == 'signup_date' ) {
                            keyArr.push(this.formatDate(v[key]));
                        } else if( key == 'reports_expire' ) {
                            keyArr.push(this.formatDate(v[key]));
                        } else if( key == 'reports_processed' ) {
                            keyArr.push(parseInt(v['reportspackage'] - v['reports_left']));
                        } else {
                            keyArr.push(v[key]);
                        }
                    }
                    
                });
                return keyArr.join("<br>");
            }
            return '';
        },
        industrylog(user, key ) {
            if( user.companies && user.companies.length > 0 ) {
                let keyArr = [];
                user.companies.forEach((v, i) => {
                    if( i == 0 ) {
                        if( v.industry ) {
                            keyArr.push(v.industry);
                        }
                    }
                });
                return keyArr.join("<br/>");
            }
            return '';
        },
        getUsers( filters = false ) {
            let app = this;
            app.viewLoader = true;
            let request = null;

            if( filters ) {
                request = axios.post( app.url + '/admin/get-users', filters );
            } else {
                request = axios.get( app.url + '/admin/get-users' );
            }
            
            request.then((response) => { 
                if( response.data.success ) {
                    app.users = response.data.data.users;
                    app.total = response.data.data.users.length;

                    for( let u in app.users ) {
                        for( let c in app.users[u].companies ) {
                            if( app.users[u].companies[c].reportspackage > 0 ) {
                                app.users[u].companies[c].reportspackage = (app.users[u].companies[c].reportspackage) ? app.users[u].companies[c].reportspackage : 0 ;
                                app.users[u].companies[c].reportsadditional = (app.users[u].companies[c].reportsadditional) ? app.users[u].companies[c].reportsadditional : 0 ;
                                app.users[u].companies[c].reports_left = (app.users[u].companies[c].reports_left) ? app.users[u].companies[c].reports_left : 0 ;

                                app.users[u].reports_processed = app.users[u].companies[c].reportspackage - app.users[u].companies[c].reports_left;
                                app.users[u].reports_left = app.users[u].companies[c].reports_left;
                            } else {
                                app.users[u].companies[c].reports_processed = 'unlimited';
                            }
                        }
                        app.users[u].reports_credit = 0;
                    }
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
            });
        },
        openPopup(user_id) {
            this.popupUser = this.users.find(x => x.id === user_id);
            if(this.popupUser) {
                this.userD = user_id;
            } else {
                showErrorMessage("Something went wrong!")
            }
        },
        removeUName(){
            this.hideUName = !this.hideUName;
        },
        removeEmailPhone(){
            this.hideEmailPhone = !this.hideEmailPhone;
        },
        removeIndustry(){
            this.hideIndustry = !this.hideIndustry;
        },
        removeReportLft(){
            this.hideReportLft = !this.hideReportLft;
        },
        removeProcessed(){
            this.hideProcessed = !this.hideProcessed;
        },
        removeCredited(){
            this.hideCredited = !this.hideCredited;
        },
        removeProduct(){
            this.hideProduct = !this.hideProduct;
        },
        removeSDate(){
            this.hideSDate = !this.hideSDate;
        },
        removeEDate(){
            this.hideEDate = !this.hideEDate;
        },
        hoveractionclck() {
            this.hoveraction = !this.hoveraction;
        },
        orderBySele(){
            let selected = this.orderBySelect.find((a) => this.orderByO === a.key)
            this.sortTable(selected.key, selected.direction); 
        },
        sortTableWebapp() {
            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
            )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

            document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
                const table = th.closest('table');
                Array.from(table.querySelectorAll('tr.data-employee'))
                    .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                    .forEach(tr => table.appendChild(tr));
            })));
        },
        sortTable(key, direction){
            this.sort = `${key} > ${direction}`
            if (direction === 'asc') {
               if (key == 'date'){
                    this.users.sort((a, b) => this.toTimestamp(a[key]) > this.toTimestamp(b[key]) ? 1: -1)
               }
               else if ( key == 'ip' ) {
                    this.users.sort((a, b) => this.rmvString(a[key]) > this.rmvString(b[key]) ? 1: -1)
               }
               else{
                   this.users.sort((a, b) => a[key] > b[key] ? 1: -1)
               }
            } else { 

                if (key == 'date'){
                    this.users.sort((a, b) => this.toTimestamp(a[key]) < this.toTimestamp(b[key]) ? 1: -1)
                }
                else if ( key == 'ip' ) {
                    this.users.sort((a, b) => this.rmvString(a[key]) < this.rmvString(b[key]) ? 1: -1)
                }
                else{
                   this.users.sort((a, b) => a[key] < b[key] ? 1: -1)
               }
            }
        },
        formatDate(string) {
            let objectDate = new Date(string);
            let day = objectDate.getDate();
            let month = objectDate.getMonth();
            let year = objectDate.getFullYear();
            let hour = objectDate.getHours() > 9 ? objectDate.getHours(): '0'+objectDate.getHours();
            let minute = objectDate.getMinutes() > 9 ? objectDate.getMinutes(): '0'+objectDate.getMinutes();
            let ampm = hour >= 12 ? "am" : "pm";
                hour = hour % 12;
                hour = hour ? hour : 12; 
            //let seconds = objectDate.getSeconds() > 9 ? objectDate.getSeconds(): '0'+objectDate.getSeconds();
            //return (month + 1) + '/' + (day) + '/' + (year) + ' ' + (hour) + ':' + (minute) + ':' + (seconds);
            return (month + 1) + '/' + (day) + '/' + (year) + ' ' + (hour) + ':' + (minute)+" " + ampm;
        }
    },
    computed: {
        
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
<template>
    <div>
        <form v-on:submit="filterResults">
            <div class="flex flex-wrap -mx-2.5">
                <div class="w-full px-2.5 mb-7">
                    <div class="border-t-4 text-[20px] leading-[1] border-b border-slate-500 py-1.5 px-2">Filter</div>
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
                    <select name="Filter" v-model="became_order"
                        class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value="" selected="">[No Filter]</option>
                        <option value="1">Demo Became order</option>
                        <option value="2">Demo didn't became order</option>
                    </select>
                </div>
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">By Industry</label>
                    <select v-model="industry" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option value=""> All </option>
                        <option v-for="industryObject in industries" :value="industryObject.industry">{{industryObject.industry}}</option>
                    </select>
                </div>
                
                <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
                    <label class="mb-1">Order By</label>
                    <select v-model="orderByO" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
                        <option :value="orderBy.key" v-for="orderBy in orderBySelect">{{ orderBy.name }}</option>
                    </select>
                </div>
                <div class="w-full px-2.5 text-right">
                    <input type="submit" value="Search" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" />
                </div>
            </div>
        </form>

        <div class="px-3 py-2 gradient-green text-white mt-4 mb-4"><span>Your search returned {{total}} record(s).</span></div>

        <div class="mt-8 mb-1 relative">
            <div class="w-full px-2.5 mb-7 border-t-4 text-[20px] leading-[1] border-b border-slate-500 py-3 px-2">
                <div class="flex flex-wrap -mx-2.5 items-center">
                    <div class="w-1/2 pl-2.5">
                        <h3>Results</h3>
                        
                    </div>
                    <div class="w-1/2 pl-2.5">
                        <div class="flex items-center justify-end">
                            <div class="cursor-pointer border border-[#b9b9b9] flex items-center pl-2.5 pr-1.5 py-1"  v-on:click="hoveractionclck">
                                <span class="mr-3">Display</span>
                                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div v-show="hoveraction" class="border border-[#b9b9b9] w-full max-w-[480px] bg-white absolute right-0 top-10 shadow-sm ml-auto p-2 z-10">
                        <ul class="flex flex-wrap -mx-2.5" style="">
                            <li class="mb-2 text-[15px] w-full md:w-1/3 px-2.5"><label for="employee" class=""><input type="checkbox" v-on:click="removeEmply()" class="mr-1.5" id="employee" checked="checked">Employee</label></li>
                            <li class="mb-2 text-[15px] w-full md:w-1/3 px-2.5"><label for="email" class=""><input type="checkbox" v-on:click="removeEmail()" class="mr-1.5" id="email" checked="checked">Email</label></li>
                            <li class="mb-2 text-[15px] w-full md:w-1/3 px-2.5"><label for="phone" class=""><input type="checkbox" v-on:click="removePhone()" class="mr-1.5" id="phone" checked="checked">Phone</label></li>
                            <li class="mb-2 text-[15px] w-full md:w-1/3 px-2.5"><label for="views" class=""><input type="checkbox" v-on:click="removeViews()" class="mr-1.5" id="views" checked="checked">Views</label></li>
                            <li class="mb-2 text-[15px] w-full md:w-1/3 px-2.5"><label for="ip" class=""><input type="checkbox" v-on:click="removeIP()" class="mr-1.5" id="ip" checked="checked">IP</label></li>
                            <li class="mb-2 text-[15px] w-full md:w-1/3 px-2.5"><label for="industry" class=""><input type="checkbox" v-on:click="removeInd()" class="mr-1.5" id="industry" checked="checked">State</label></li>
                            <li class="text-[15px] w-full md:w-1/3 px-2.5"><label for="date"  class=""><input type="checkbox" v-on:click="removeDate()" class="mr-1.5" id="date" checked="checked">Date</label></li>
                            <li class="text-[15px] w-full md:w-1/3 px-2.5"><label for="date"  class=""><input type="checkbox" v-on:click="removeDate()" class="mr-1.5" id="date" checked="checked">How did you learn about us</label></li>
                            <li class="text-[15px] w-full md:w-1/3 px-2.5"><label for="date"  class=""><input type="checkbox" v-on:click="removeDate()" class="mr-1.5" id="date" checked="checked">Related value</label></li>
                        </ul>
                    </div>
                </div>
                
            </div>
            
            <div class="order-2 md:order-1 w-full md:w-3/4 mb-4 flex flex-wrap gap-4 justify-start">
                <a href="javascript:void(0)" v-on:click="mark_became_order" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Mark Selected Became Order</a>
                <a href="javascript:void(0)" v-on:click="unmark_became_order" class="rounded px-3 py-1.5 leading-4 text-center hover:bg-orange-600 bg-orange-500 text-white font-sans font-bold text-md">Unmark Selected Became Order</a>
                <a href="javascript:void(0)" v-on:click="delete_became_order" class="rounded px-3 py-1.5 leading-4 text-center hover:bg-red-700 bg-red-600 text-white font-sans font-bold text-md">Delete Selected</a>
                <a href="javascript:void(0)" v-on:click="exportdemoReport" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Export Report</a>
            </div>
            <h3 class="text-xl text-black mb-2"></h3>
            <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-2 py-2"></th>
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
                            <th v-show="hideEmply" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Employee</span>
                                    <span v-on:click="sortTable('employee', 'asc')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </span>
                            </th>
                            <th v-show="hideEmail" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Email</span>
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
                            <th v-show="hidePhone" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span>Phone</span>
                                </span>
                            </th>
                            <th v-show="hideViews" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span>Views</span>
                                </span>
                            </th>
                            <th v-show="hideIP" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">IP</span>
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
                            <th v-show="hideInd" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span>State</span>
                                </span>
                            </th>
                            <th v-show="hideDate" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Signup reference</span>
                                </span>
                            </th>
                            <th v-show="hideDate" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Additional Info</span>
                                </span>
                            </th>
                            <th v-show="hideDate" class="px-2 py-2">
                                <span class="flex items-center">
                                    <span class="mr-2">Date</span>
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
                        <tr v-if="demoinquiries.length > 0" class="data-employee" :class="(user.became_order == 1) ? 'data-employee text-white odd:gradient-green even:gradient-green' : ((user.became_order == 2) ? 'odd:bg-white even:bg-gray-50 data-employee' : 'odd:bg-white even:bg-gray-50 data-employee')" v-for="(user, index) in demoinquiries">
                            <td><input class="democheckbox" type="checkbox" v-on:click="checkboxChange(user.id)" /></td>
                            <td class="relative px-2 py-2 cursor-pointer flex" v-on:click="openPopup(user.id)">
                                {{ user.fullName }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-3 flex">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>

                            </td>
                            <td class="px-2 py-2">{{ user.company }}</td>
                            <td v-show="hideEmply" class="px-2 py-2">{{ user.num_employees }}</td>
                            <td v-show="hideEmail" class="px-2 py-2">
                                <a :href="'mailto:' + user.email + '?Subject=Follow up on COMPackage Demo Inquiry'">{{user.email}}</a>
                            </td>
                            <td v-show="hidePhone" class="px-2 py-2">{{ user.phone }} {{(user.phoneext) ? 'Ext. '+user.phoneext: ''}}</td>
                            <td v-show="hideViews" class="px-2 py-2">{{ user.count }}</td>
                            <td v-show="hideIP" class="px-2 py-2">{{ user.ip }}</td>
                            <td v-show="hideInd" class="px-2 py-2">{{ user.state }}</td>
                            <td v-show="hideInd" class="px-2 py-2">{{ user.signup_reference_from }}</td>
                            
                            <td v-show="hideInd" class="px-2 py-2">
                                <template v-if="user.OtherPleasedefine">
                                    {{ user.OtherPleasedefine }}
                                </template>
                                <template v-else-if="user.UniversityWhichone">
                                    {{ user.UniversityWhichone }}
                                </template>
                                <template v-else-if="user.Organizationwhichone">
                                    {{ user.Organizationwhichone }}
                                </template>
                                <template v-else-if="user.WebSearchtermsearched">
                                    {{ user.WebSearchtermsearched }}
                                </template>
                            </td>

                            <!-- <td v-show="hideInd" class="px-2 py-2">{{ user.industry }}</td> -->
                            <td v-show="hideDate" class="px-2 py-2">{{ user.updated_at }}</td>
                        </tr>
                        <tr v-else>
                            <td>No records are found!!</td>
                        </tr>
                    </tbody>
                </table>
            </div>    
        </div>

        <div v-if="userD" class="cpgmodal-fade mxi-loader-wrap backdrop-blur-md fixed w-full h-full top-0 left-0 z-20"></div>
        <div v-if="userD" class="max-h-[300px] md:max-h-full overflow-auto cpgmodal-container w-full max-w-[800px] p-5 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white z-20 rounded border border-[#d7d7d7]">
            <span v-on:click="userD= false" class="cpgclose-popup absolute w-7 h-7 text-center text-red-400 hover:text-red-700 text-[30px] leading-[25px] top-0 right-0 rounded-full cursor-pointer">&times;</span>
            <div class="flex flex-wrap">
                <div class="w-full mb-5">
                    <h3 class="text-xl text-black">Update Demo Inquiry</h3>
                    <div class="flex pb-3"><strong>Edit Demo Request</strong></div>
                    <hr class="border-gray-600" />
                </div>
                <form v-on:submit="updateDemoInquiry">
                    <div class="mb-3 md:mb-3 flex flex-wrap -mx-2.5">
                    
                    <div class="w-full px-2.5 mb-3 text-black text-lg">
                        <div class="border border-slate-400 px-3 py-1.5 bg-slate-300"><label class="text-black mr-1 leading-normal">ID:</label><span>{{popupinquiry.id}}</span></div>
                    </div>

                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal">Firstname</label>
                        <input  class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" v-model ="popupinquiry.firstname" />
                    </div>
                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal">Last Name</label>
                        <input  class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" v-model ="popupinquiry.lastname" />
                    </div>

                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal">Email</label>
                        <input required class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" v-model ="popupinquiry.email" />
                    </div>
                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal">Phone</label>
                        <input  class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" v-model ="popupinquiry.phone" />
                    </div>
                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal">Phone Ext</label>
                        <input  class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" v-model ="popupinquiry.phoneext" />
                    </div>
                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal">State</label>
                        <input  class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" v-model ="popupinquiry.state" />
                    </div>
                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal">Company</label>
                        <input  class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" v-model ="popupinquiry.company" />
                    </div>
                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal">Industry</label>
                        <input  class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" v-model ="popupinquiry.industry" />
                    </div>
                    <div class="w-1/2 px-2.5 mb-3">
                        <label class="block text-black mb-1 leading-normal"># Employees</label>
                        <input  class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" v-model ="popupinquiry.num_employees" />
                    </div>
                    
                    <div class="w-full flex space-x-4 px-2.5">
                        <input type="submit" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm outline-0" value="Submit" />
                        <input type="reset" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm outline-0" value="Clear" />
                    </div>
                    
                    </div>
                </form>
            </div>
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
            demoinquiries: {},
            viewLoader: false,
            selected: [],
            user: [],
            action: false,
            hideEmply: true,
            hideEmail: true,
            hidePhone: true,
            hideViews: true,
            hideIP: true,
            hideInd: true,
            hideDate: true,
            hoveraction:false,
            orderByO: 'Ddate',
            userD: false,
            popupinquiry: null,
            sort: '',
            orderBySelect: [
                {key: 'Adate', direction: 'asc', name:'Date (Ascending)',db_key: 'updated_at'},
                {key: 'Ddate', direction: 'desc', name:'Date (Descending)',db_key: 'updated_at'},
                {key: 'name', direction: 'desc', name:'Name',db_key: 'name'},
                {key: 'company', direction: 'desc', name:'Company',db_key: 'company'},
                {key: 'email address', direction: 'desc', name:'Email Address',db_key: 'email'},
                {key: 'industry', direction: 'desc', name:'Industry',db_key: 'industry'},
            ],
            // Filters
            search_by_name: '',
            limit: -1,
            from_month: new Date().getMonth(),
            from_year: new Date().getFullYear(),
            to_month: new Date().getMonth()+1,
            to_year: new Date().getFullYear(),
            industry: '',
            became_order: '',
            total: 0
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
    created() {
        let filters = {
            limit: this.limit,
            to_year: this.to_year,
            industry: this.industry,
            to_month: this.to_month,
            from_year: this.from_year,
            name: this.search_by_name,
            from_month: this.from_month,
            became_order: this.became_order,
            orderByO: this.orderBySelect.find((a) => this.orderByO === a.key)
        }
            
        this.getDemoInquiries( filters );
    },
    methods: {
        exportdemoReport(e) {
            e.preventDefault();
            let app = this;

            app.viewLoader = true;
            alert('Note: it will download the filtered demo enquiries.');
            app.downloadCSVData();

        },
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
                became_order: this.became_order,
                orderByO: this.orderBySelect.find((a) => this.orderByO === a.key)
            }
            
            this.getDemoInquiries( filters );
        },
        downloadCSVData() {
            let csv1 = "First Name, Last Name,Company,Employee,Email,Extension,Phone, Views, IP, State, Signup reference, Additional info, Date\n";
            for (let user of this.demoinquiries) {
                let replacedCSV = user.company ? user.company.replace(/,/g, '') : '';
                csv1 += `"${user.firstname}",`;
                csv1 += `"${user.lastname}",`;
                csv1 += `"${replacedCSV}",`;
                csv1 += `"${user.num_employees}",`;
                csv1 += `"${user.email}",`;
                csv1 += `"${(user.phoneext > 1) ? user.phoneext : '-'}",`;
                csv1 += `"${user.phone}",`;
                csv1 += `"${user.count}",`;
                csv1 += `"${user.ip}",`;
                csv1 += `"${user.state}",`;
                csv1 += `"${user.signup_reference_from}",`;

                // Add the conditionals directly in JavaScript
                let additionalInfo = "";
                if (user.OtherPleasedefine) {
                    additionalInfo = user.OtherPleasedefine;
                } else if (user.UniversityWhichone) {
                    additionalInfo = user.UniversityWhichone;
                } else if (user.Organizationwhichone) {
                    additionalInfo = user.Organizationwhichone;
                } else if (user.WebSearchtermsearched) {
                    additionalInfo = user.WebSearchtermsearched;
                }
                csv1 += `"${(additionalInfo) ? additionalInfo : '-'}",`;
                csv1 += `"${user.updated_at}"\n`;
            }



            var currentdate = new Date();
            var datetime = currentdate.getFullYear() + "-" + (currentdate.getMonth() + 1) + "-" + currentdate.getDate();
            this.viewLoader = false;
            const anchor = document.createElement('a');
            anchor.href = 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv1);
            anchor.target = '_blank';
            anchor.download = 'Demo Report ' + datetime + '.csv';
            anchor.click();
        },
        getDemoInquiries( filters = false ) {
            let app = this;
            app.viewLoader = true;
            let request = null;

            if( filters ) {
            } else {
                filters = {};
            }
            request = axios.post( app.url + '/admin/demoinquiries', filters );
            
            request.then((response) => { 
                if( response.data.success ) {
                    app.demoinquiries = response.data.data.demo_inquiries;
                    app.total = response.data.data.demo_inquiries.length;
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
            });
        },
        updateDemoInquiry(e) {
            e.preventDefault();

            let app = this;

            // console.log(app.popupinquiry);
            // return;

            axios.post( app.url + '/admin/demoinquiries/update', app.popupinquiry).then((response) => { 
                if( response.data.success ) {
                    showSuccessMessage(response.data.data.msg);
                } else {
                    showErrorMessage("Something went wrong!!");
                }
                app.viewLoader = false;
            }).catch((error) => {
                app.viewLoader = false;
            });
        },
        sortTableWebapp(){
            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => ((v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2) ) (getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

            document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
                const table = th.closest('table');
                Array.from(table.querySelectorAll('tr.data-employee'))
                    .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                    .forEach(tr => table.appendChild(tr) );
            })));
        },
        sortTable(key, direction){
            this.sort = `${key} > ${direction}`;

            if (direction === 'asc') {
               if (key == 'date'){
                    this.demoinquiries.sort((a, b) => this.toTimestamp(a[key]) > this.toTimestamp(b[key]) ? 1: -1);
               }
               else if ( key == 'ip' ) {
                    this.demoinquiries.sort((a, b) => this.rmvString(a[key]) > this.rmvString(b[key]) ? 1: -1);
               }
               else if ( key == 'employee' ) {
                    this.demoinquiries.sort((a, b) => this.rmvString(a[key]) > this.rmvString(b[key]) ? 1: -1);
               }
               else{
                   this.demoinquiries.sort((a, b) => a[key] > b[key] ? 1: -1);
               }
            } else { 

                if (key == 'date'){
                    this.demoinquiries.sort((a, b) => this.toTimestamp(a[key]) < this.toTimestamp(b[key]) ? 1: -1);
                }
                else if ( key == 'ip' ) {
                    this.demoinquiries.sort((a, b) => this.rmvString(a[key]) < this.rmvString(b[key]) ? 1: -1);
                }
                else if ( key == 'employee' ) {
                    this.demoinquiries.sort((a, b) => this.rmvString(a[key]) < this.rmvString(b[key]) ? 1: -1);
                }
                else{
                   this.demoinquiries.sort((a, b) => a[key] < b[key] ? 1: -1);
               }
            }
        },
        openPopup(user_id) {
            this.popupinquiry = this.demoinquiries.find(x => x.id === user_id);
            if(this.popupinquiry) {
                this.userD = user_id;
            } else {
                showErrorMessage("Something went wrong!");
            }
        },
        toTimestamp (strDate){  
            let dt = Date.parse(strDate);
            return (dt / 1000);  
        },
        rmvString(){
            let app = this;
            for( let j in app.demoinquiries ) {
                let str = this.demoinquiries[j].ip;
                str = str.replaceAll('+', '');
                return str.replaceAll('.', '');
            }
        },
        removeEmply(){
            this.hideEmply = !this.hideEmply;
        },
        removeEmail(){
            this.hideEmail = !this.hideEmail;
        },
        removePhone(){
            this.hidePhone = !this.hidePhone;
        },
        removeViews(){
            this.hideViews = !this.hideViews;
        },
        removeIP(){
            this.hideIP = !this.hideIP;
        },
        removeInd(){
            this.hideInd = !this.hideInd;
        },
        removeDate(){
            this.hideDate = !this.hideDate;
        },
        hoveractionclck(){
            this.hoveraction = !this.hoveraction;
        },
        userDclick(){
            this.userD = true;
        },
        orderBySele(){
            let selected = this.orderBySelect.find((a) => this.orderByO === a.key);
            this.sortTable(selected.key, selected.direction); 
        },
        mark_became_order() {
            if( this.selected < 1 ) {
                alert("Please select at least 1 demo Inquiry.");
                return;
            }
            if( confirm( 'Do you want to mark the selected demo inquiries as a purchase?' ) ) {
                this.changeStatus(this.selected, 'mark');
            }
        },
        unmark_became_order() {
            if( this.selected < 1 ) {
                alert("Please select at least 1 demo Inquiry.");
                return;
            }
            if( confirm( 'Do you want to mark the selected demo inquiries as not purchase?' ) ) {
                this.changeStatus(this.selected, 'unmark');
            }
        },
        delete_became_order() {
            if( this.selected < 1 ) {
                alert("Please select at least 1 demo Inquiry.");
                return;
            }
            if( confirm( 'Do you want to delete the selected demo inquiries?' ) ) {
                this.changeStatus(this.selected, 'delete');
                this.selected = [];
            }
            this.$nextTick(() => {
                $('.democheckbox').prop('checked', false);
            });
        },
        changeStatus( ids, action ) {
            let app = this;
            app.viewLoader = true;
            axios.post(app.url + '/admin/demoinquiries/status', {ids:ids, action:action}).then((response) => { 
                if( response.data.success ) {
                    showSuccessMessage(response.data.data.msg);
                    app.viewLoader = false;
                    app.getDemoInquiries();
                    window.location.reload();
                } else {
                    showErrorMessage("Something went wrong!!");
                    app.viewLoader = false;
                }
            }).catch((error) => {
                app.viewLoader = false;
            });
        },
        checkboxChange(user_id) {
            if( this.selected.includes(user_id) ) {
                const index = this.selected.indexOf(user_id);
                if (index > -1) {
                    this.selected.splice(index, 1);
                }
            } else {
                this.selected.push(user_id);
            }
        }
    }
}
</script>
<template>
    <!-- Webapp Benefit Index -->
    <div>
        <a :href="url+'/benefitspdf/Compackage_Benefits.pdf'" target="_blank" class="inline-block mb-5 rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">View These Benefit Ideas</a>
        <a :href="url+'/webapp/insurance-program-types'" class="inline-block mb-5 ml-4 rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">Insurance Program Type</a>
        <form v-on:submit="saveBenefits" method="POST" enctype="multipart/form-data">
            <input v-if="permissions.update" type="submit" value="Save" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" />
            <div v-for="(benefit_type, benefit_type_index) in benefit_types" :key="benefit_type" class="mt-8">
                
                <div class="mb-3 flex items-center cursor-pointer" v-on:click="showhidebenefits(benefit_type_index)">
                    <div class="expandcollapse_heading gradient-green rounded-xl text-white mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                    <h3 class="text-xl text-black mb-2" v-html="benefit_type.name"></h3>
                </div>
                <!-- <div v-if="benefit_type.id == 4" class="description">
                    E.g., Free Coffee, Company Picnic, etc. at no dollar value.
                </div> -->
                
                <div :class="'relative overflow-x-auto '+ (showhidebenefitsarr[benefit_type_index] ? ' hidebenefit' : '' )">
                    <table :id="'items' + benefit_type_index" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead>
                            <tr>
                                <th class="align-top"></th> <!-- Move -->
                                <th :value="benefit_types.id" class="align-top">
                                    <input type="checkbox" v-model="selectAll" v-on:click="testSelectAll(benefit_type_index)" />
                                    <span class="ml-1">Select All</span>
                                    <span class="flex items-center mt-3">
                                        <span>Include</span>
                                        <span class="cursor-pointer"  v-on:mouseleave="hover = false" v-on:mouseover="hover = benefit_type.id">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                            </svg>
                                        </span>
                                        <div v-show="hover === benefit_type.id">
                                            <span class="p-1.5	left-[45%] -translate-x-2/4 top-0 absolute bg-slate-700 text-white border-2 border-black w-3/5 rounded">
                                                <span class="relative z-10">
                                                    Consider trying our unique Illuminative Metrics™ feature that allows you to elevate and illustrate in certain situations special benefits provided key employees beyond a total comp number. Examples might include:
                                                    <ul class="pl-5 list-disc">
                                                        <li>Illustrate to your drivers how much they're earning per mile, or per trip</li>
                                                        <li>ProForma today's value of options granted in phantom stock</li>
                                                        <li>Provide greater focus on sales commissions earned for different types of wins over the period</li>
                                                        <li>Demonstrate the present year-end value of your ESOP per employee</li>
                                                    </ul>
                                                    Be creative! You can bold it, italicize it, display it numerically or in currency. The important feature of Illuminative Metrics is that it is NOT included in any of the above total compensation calculations.
                                                </span>
                                                <div class="absolute -left-2 -translate-y-1/2 top-1/2 w-3 h-3 -mt-2 rotate-45 bg-slate-700"></div>
                                            </span>
                                        </div>
                                    </span>
                                </th>
                                <th scope="col" class="px-2 align-top pt-0 px-2 py-3">{{benefit_type.sub_heading || 'Benefit Name'}}</th>
                                <th v-if="benefit_type.id != 5" scope="col" class="px-2 align-top pt-0 py-3">Preferred Benefit Name</th>
                                <th v-else scope="col" class="px-2 align-top pt-0 py-3">Custom Benefit Name</th>
                                <th v-if="benefit_type.id != 4" scope="col" class="align-top pt-0 py-3" >Co-Pay Benefit</th>
                                <th v-if="0" scope="col" class="px-2 align-top pt-0 py-3">Employer Contribution Default</th>
                                <th v-if="0" scope="col" class="px-2 align-top pt-0 py-3">Employee Contribution Default</th>
                            </tr>
                        </thead>
                        <tbody :data-pos="benefit_index" :data-benefit_id="benefit.id" :data-benefittype="benefit_type.id" v-for="(benefit, benefit_index) in benefit_type.benefits">
                            <tr>
                                <td class="sortableColumn1">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="cursor-move h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg> -->
                                    <input type="hidden" v-model="benefit.addedby" />
                                </td>
                                <td data-label="Show" class="px-2 py-2">
                                    <input type="checkbox" :data-benefit-index="benefit_index" :class="'benefit_' + benefit.id" v-model="benefit.show" :value="benefit.id"  v-on:click="checkHourlyPair(benefit_type_index, benefit.id)" />
                                </td>
                                <td data-label="Benefit Name" class="px-2 py-2">
                                    {{benefit.name}}
                                    <span v-if="benefit.can_categorize" class="block mt-3">Categorize the above benefit:</span>
                                </td>
                                
                                 <td data-label="Additional Benefit Name" class="px-2 py-2">
                                    <input v-model="benefit.additional_benefit_name" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    <select v-if="benefit.can_categorize" v-model="benefit.category_id" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control mt-3">
                                        <option value="0">{{'<Choose a Category>'}}</option>
                                        <option v-for="category in benefit.categories" :value="category.id">{{category.name}}</option>
                                    </select>
                                    
                                    <label for="bold" class="mr-4 pr-3" v-if="benefit_type.id == 7">
                                        <input type="checkbox" name="bold" v-model="benefit.bold" :value="benefit.bold" class="mr-1"/>
                                        <b class="">Bold</b>
                                    </label>
                                    <label for="italic" class="mr-4 pr-3" v-if="benefit_type.id == 7">
                                        <input type="checkbox" name="italic" v-model="benefit.italic" :value="benefit.italic" class="mr-1" />
                                        <i class="">Italic</i>
                                    </label>
                                    <label for="add_dollar" class="mr-4 pr-3" v-if="benefit_type.id == 7">
                                        <input type="checkbox" name="add_dollar" v-model="benefit.add_dollar" :value="benefit.add_dollar" class="mr-1" />
                                        <i class="">Add Dollar</i>
                                    </label>
                                    <label for="decimal_cents" class="mr-4 pr-3" v-if="benefit_type.id == 7">
                                        <input type="checkbox" name="decimal_cents" v-model="benefit.decimal_cents" :value="benefit.decimal_cents" class="mr-1" />
                                        <i class=""> Include decimal/cents</i>
                                    </label>
                                    <br v-if="benefit.id == 76">
                                    <small v-if="benefit.id == 76">Use the category Additional Benefits if you don't want the amount to appear as part of their total compensation.</small>
                                </td>
                                <td v-if="benefit.category_id != 8 && benefit_type.id != 7">
                                    <input type="checkbox" name="employee_co_pay" v-model="benefit.employee_co_pay" :value="benefit.id" />
                                </td>

                                <td v-if="0" data-label="Employee Contribution Default" class="px-2 py-2"> <!-- benefit_type.id != 4 && benefit_type.id != 7 -->
                                    <span class="flex items-center">
                                        <span class="mr-3">$</span>
                                        <input v-model="benefit.employer_default_value" name="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    </span>
                                </td>
                                <td v-if="0" data-label="Employee Contribution Default" class="px-2 py-2"> <!-- benefit_type.id != 4 && benefit_type.id != 7 -->
                                    <span class="flex items-center">
                                        <span class="mr-3">$</span>
                                        <input v-model="benefit.employee_default_value" name="" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    </span>
                                </td>
                                <!-- <td v-if="benefit_type.id == 5">
                                    <div class="flex">
                                        <svg v-if="(benefit_index + 1) == benefit_type.benefits.length" v-on:click="addCustomBenefits(benefit_type_index, benefit_index)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <svg v-if="benefit_index != 0 && (benefit.addedby != 'admin' && benefit.addedby == benefit.company_id )" v-on:click="removeCustomBenefits(benefit_type_index, benefit_index)" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <input v-if="permissions.update" type="submit" value="Save" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" />
        </form>
        
        <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
            <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
        </div>
    </div>
</template>

<script>
// Default SortableJS
import Sortable from 'sortablejs';
export default {
    props: ['permissions'],
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            hover: false,
            benefit_types: [
                {
                    id: '',
                    name: '',
                    benefit: [
                        {
                            id: '',
                            name: '',
                            show: '',
                            employee_co_pay: '',
                            additional_benefit_name: '',
                            employer_default_value: '',
                            employee_default_value: '',
                            category_id: '',
                            addedby: '',
                            bold: false,
                            italic: false,
                            add_dollar: false,
                            decimal_cents: false
                        }
                    ]
                }
            ],
            benefits_to_be_deleted: [],
            selected: [],
            benefit_type_id_for_checkbox:0,
            showhidebenefitsarr: []
        }
    },
    created() {
        this.getBenefitsTypes();
    },
    computed: {
        
        selectAll: {
            get: function () {
                return this.benefit_types && this.benefit_type_id_for_checkbox && this.benefit_types[this.benefit_type_id_for_checkbox] ? this.selected.length == this.benefit_types[this.benefit_type_id_for_checkbox].benefits.length : false;
            },
            set: function (value) {
                let app = this;
                var selected = [];

                if (value) {
                    this.benefit_types[this.benefit_type_id_for_checkbox].benefits.forEach(function (benefit, index) {
                        app.benefit_types[app.benefit_type_id_for_checkbox].benefits[index].show = true;
                        // selected.push(benefit.id);
                    });
                } else {
                    this.benefit_types[this.benefit_type_id_for_checkbox].benefits.forEach(function (benefit, index) {
                        app.benefit_types[app.benefit_type_id_for_checkbox].benefits[index].show = false;
                    });
                }

                this.selected = selected;
            }
        }
    },
    methods: {
        getBenefitsTypes() {
            let app = this;
            app.viewLoader = true;

            axios.get(app.url + '/webapp/get-benefit-types').then((response) => {
                if( response.data.success ) {
                    app.benefit_types = response.data.data.benefitTypes;

                    // Sorting the benefit based on order_sequence key
                    app.benefit_types.forEach((value, benefitTypesIndex) => {
                        app.sortByKey(benefitTypesIndex, 'order_sequence')
                        /** Loop through all the benefits types and add deafult visibility to true. */
                        this.showhidebenefitsarr[benefitTypesIndex] = !this.showhidebenefitsarr[benefitTypesIndex];
                    });

                    app.initiateOrdering();
                    
                } else {
                    showErrorMessage(response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                showErrorMessage(error);
                app.viewLoader = false;
            }); 
        },
        saveBenefits(e) {
            let app = this;
            e.preventDefault();

            if( ! this.checkPermission('update') ) {
                return false;
            }

            app.viewLoader = true;
            let fire_ajax = true;

            let benefit_types_arr = Array();
            
            this.benefit_types.forEach((benefit_type, index) => {
                let benefits_arr = Array();
                benefit_type.benefits.forEach((benefit, order_sequence) => {
                    if(benefit.show && benefit_type.id == 5 && benefit.category_id == 0) {
                        showErrorMessage("Please choose a category for active Custom benefits.");
                        app.viewLoader = false;
                        fire_ajax = false;
                        return false;
                    } else if(benefit.show && benefit_type.id == 7 && benefit.category_id == 0) {
                        showErrorMessage("You must choose a category for the Illuminative Metric you are adding.");
                        app.viewLoader = false;
                        fire_ajax = false;
                        return false;
                    }
                    
                    benefits_arr.push({
                        'additional_benefit_name': benefit.additional_benefit_name,
                        'employee_co_pay': benefit.employee_co_pay,
                        'employee_default_value': benefit.employee_default_value,
                        'employer_default_value': benefit.employer_default_value,
                        'id': benefit.id,
                        'name': benefit.name,
                        'show': benefit.show,
                        'category_id': benefit.category_id,
                        'can_categorize': benefit.can_categorize,
                        'order_sequence': (order_sequence + 1),
                        'addedby': benefit.addedby,
                        'bold': benefit.bold,
                        'italic': benefit.italic,
                        'add_dollar': benefit.add_dollar,
                        'decimal_cents': benefit.decimal_cents
                    });
                })

                if( benefits_arr && benefits_arr.length > 0 ) {
                    benefit_types_arr.push({'id': benefit_type.id, 'name': benefit_type.name, 'benefits': benefits_arr});
                }
            });

            if( ! fire_ajax ) {
                return false;
            }

            axios.post( app.url + '/webapp/benefits/store', { benefits: benefit_types_arr} ).then( (response) => {
                //console.log(response.data.success);
                if(response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                } else {
                    showErrorMessage(response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch( (error) => {
                showErrorMessage(error);
                app.viewLoader = false;
            });
        },
        addCustomBenefits( benefit_type_index, benefit_index) {

            if( ! this.checkPermission('update') ) {
                return false;
            }

            let copiedObject = Object.assign({}, this.benefit_types[benefit_type_index].benefits[benefit_index])

            copiedObject.additional_benefit_name = "";
            copiedObject.employee_default_value = "0.00";
            copiedObject.employer_default_value = "0.00";
            copiedObject.addedby = (this.benefit_types[benefit_type_index].benefits[benefit_index].company_id) ? this.benefit_types[benefit_type_index].benefits[benefit_index].company_id : '';
            copiedObject.id = 0;
            benefit_index += 1;
            copiedObject.name = "Custom Benefit " + (parseInt(benefit_index) + 1);


            this.benefit_types[benefit_type_index].benefits.push(copiedObject);
        },
        removeCustomBenefits(benefit_type_index, benefit_index) {

            if( ! this.checkPermission('update') ) {
                return false;
            }

            this.benefits_to_be_deleted.push(this.benefit_types[benefit_type_index].benefits[benefit_index].id);
            this.benefit_types[benefit_type_index].benefits.splice(benefit_index, 1);
        },
        sortByKey(benefitTypesIndex, sortKey) {
            this.benefit_types[benefitTypesIndex].benefits = Object.values(this.benefit_types[benefitTypesIndex].benefits).sort((a, b) => a.order_sequence - b.order_sequence);
        },
        initiateOrdering() {

            if( ! this.checkPermission('update') ) {
                return false;
            }

            let app = this;
            setTimeout(() => {
                this.benefit_types.forEach((value, index) => {
                    var el = document.getElementById('items' + index);
                    
                    var sortable = Sortable.create(el, {
                        handle: ".sortableColumn",
                        onChoose: function (evt) {
                            evt.item.style = 'background-color: rgb(229 231 235); border: 1px solid rgb(163 163 163);';  // element index within parent
                        },
                        onUnchoose: function (evt) {
                            evt.item.style = 'background-color: " "';  // element index within parent
                        },
                        onEnd: function (evt) {
                            app.viewLoader = true;
                            var oldIndex = evt.item.getAttribute("data-pos");
                            var benefit_id = evt.item.getAttribute("data-benefit_id");
                            var benefitType = evt.item.getAttribute("data-benefittype");
                            var newIndex = evt.newIndex;

                            // console.log(oldIndex, benefitType, newIndex);
                            // oldIndex = (oldIndex == 0) ? 1 : oldIndex;
                            newIndex = (newIndex == 0) ? 1 : newIndex;
                            

                            app.benefit_types.find((benefit_type) => {
                                if (benefit_type.id == benefitType ) {
                                    for( let i in benefit_type.benefits ) {
                                        if( oldIndex == i ) {
                                            let removed_benefit = benefit_type.benefits.splice(i, 1);
                                            benefit_type.benefits.splice((newIndex-1), 0, removed_benefit[0])
                                        }
                                    }
                                }
                            });
                            
                            axios.post( process.env.MIX_API_URL + '/benefits/re-ordering', {
                                "oldIndex": oldIndex,
                                "newIndex": newIndex,
                                "benefitType": benefitType,
                                "benefit_id": benefit_id, 
                                "benefit_types": app.benefit_types
                            }).then((res) => {
                                app.viewLoader = false;
                                app.getBenefitsTypes();
                            });
                        }
                    });
                });
            }, 1000);
        },
        checkPermission(action) {
            if( this.permissions[action] ) {
                return true;
            }
            return false;
        },
        testSelectAll(id) {
            this.benefit_type_id_for_checkbox = id;
        },
        showhidebenefits(benefit_index)
        {
            this.showhidebenefitsarr[benefit_index] = !this.showhidebenefitsarr[benefit_index];
        },
        checkHourlyPair(benefit_type_index, benefit_id) {
            if( this.benefit_types[benefit_type_index].id != 10 ) {
                return;
            }

            let perChunk = 3;
            let will_prop = jQuery('.benefit_' + benefit_id).is(":checked");

            let hourly_benefits = this.benefit_types.filter(benefit_type => benefit_type.id == 10)[0].benefits.map(a => a.id).reduce((all,one,i) => {
                const ch = Math.floor(i/perChunk); 
                all[ch] = [].concat((all[ch]||[]),one); 
                return all
            }, [])

            // console.log(this.benefit_types.filter(benefit_type => benefit_type.id == 10)[0].benefits.map(a => a.id));
            let benefit_index = '';
            for( let triple of hourly_benefits ) {
                if(triple.includes(benefit_id)) {
                    for( let single of triple ) {
                        benefit_index = jQuery('.benefit_' + single).attr('data-benefit-index');
                        this.benefit_types[benefit_type_index].benefits[benefit_index].show = will_prop;
                        jQuery('.benefit_' + single).prop("checked", will_prop).trigger('change');
                    }
                }
            }
        }
    }
}
</script>
<style>
    .hidebenefit
    {
        display: none;
    }
</style>
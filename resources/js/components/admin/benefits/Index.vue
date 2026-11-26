<template>
    <!-- Admin Benefit Index  -->
    <div>
        <a :href="url+'/benefitspdf/Compackage_Benefits.pdf'" target="_blank" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">View These Benefit Ideas</a>
        <form v-on:submit="saveBenefits" class="mt-5" method="POST" enctype="multipart/form-data">
            <input type="submit" value="Save" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" />
            <div v-for="(benefit_type, benefit_type_index) in benefit_types" class="mt-8">
                <h3 class="text-xl text-black mb-2">{{benefit_type.name}}</h3>

                <div class="relative overflow-x-auto">
                    <table :id="'items' + benefit_type_index" class="box-site w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead>
                            <tr>
                                <th>Move</th>
                                <th><input type="checkbox" v-model="selectAll" v-on:click="testSelectAll(benefit_type_index)" /><span class="ml-3">Select All</span></th>
                                <th scope="col" class="px-2 py-3">{{benefit_type.sub_heading || 'Benefit Name'}}</th>
                                <th v-if="benefit_type.id != 5" scope="col" class="px-2 py-3">Preferred Benefit Name</th>
                                <th v-else scope="col" class="px-2 py-3">Custom Benefit Name</th>
                                <th scope="col" class="align-top pt-0 py-3" >Co-Pay Benefit</th>
                                <!-- <th scope="col" class="px-2 py-3">Employer Contribution Default</th>
                                <th scope="col" class="px-2 py-3">Employee Contribution Default</th> -->
                            </tr>
                        </thead>
                        <tbody :data-pos="benefit_index" :data-benefit_id="benefit.id" :index="benefit_index" :data-benefittype="benefit_type.id" v-for="(benefit, benefit_index) in benefit_type.benefits" :key="benefit" class="sup-box height">
                            <tr >
                                <td class="sortableColumn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-move h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </td>
                                <td data-label="Show" class="px-2 py-2">
                                    <input type="checkbox" v-model="benefit.show" />
                                </td>
                                <td data-label="Benefit Name" class="px-2 py-2">
                                    {{benefit.name}}
                                    <span v-if="benefit.can_categorize" class="block mt-3">Categorize the above benefit:</span>
                                </td>
                                 <td data-label="Preferred Benefit Name" class="px-2 py-2">
                                    <input v-model="benefit.additional_benefit_name" type="text" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    <!-- <select v-if="benefit.can_categorize" v-model="benefit.category_id" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control mt-3">
                                        <option value="0">{{'<Choose a Category>'}}</option>
                                        <option v-for="category in benefit.categories" :value="category.id" :key="category">{{category.name}}</option>
                                    </select> -->
                                    <select v-if="benefit.can_categorize" v-model="benefit.category_id" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control mt-3">
                                        <option value="0">{{'<Choose a Category>'}}</option>
                                        <option v-for="category in benefit.categories.filter(c => c.categorie_id === 0)" :value="category.id" :key="category.id">
                                        {{ formatCategoryLabel(category,benefit.categories) }}
                                        </option>
                                    </select>
                                    

                                </td>
                                <td v-if="benefit.category_id != 8">
                                    <input type="checkbox" name="employee_co_pay" v-model="benefit.employee_co_pay" :value="benefit.id" />
                                </td>
                                <!-- <td data-label="Employee Contribution Default" class="px-2 py-2">
                                    <span class="flex items-center" v-if="benefit_type.id != 4 && benefit_type.id != 7">
                                        <span class="mr-3">$</span>
                                        <input v-model="benefit.employer_default_value" name="" type="text" id="" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    </span>
                                </td>
                                <td data-label="Employee Contribution Default" class="px-2 py-2">
                                    <span class="flex items-center" v-if="benefit_type.id != 4 && benefit_type.id != 7">
                                        <span class="mr-3">$</span>
                                        <input v-model="benefit.employee_default_value" name="" type="text" id="" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"/>
                                    </span>
                                </td> -->
                                <!-- <td v-if="benefit_type.id == 5">
                                    <div class="flex">
                                        <svg v-if="(benefit_index + 1) == benefit_type.benefits.length" v-on:click="addCustomBenefits(benefit_type_index, benefit_index)" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <svg v-if="benefit_index != 0" v-on:click="removeCustomBenefits(benefit_type_index, benefit_index)" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <input type="submit" value="Save" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md" />
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
    
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            benefit_types: [
                {
                    id: '',
                    name: '',
                    sub_heading: '',
                    benefit: [
                        {
                            id: '',
                            name: '',
                            show: '',
                            additional_benefit_name: '',
                            employer_default_value: '',
                            employee_default_value: '',
                            employee_co_pay: '',
                            category_id: '',
                        }
                    ]
                }
            ],
            benefits_to_be_deleted: [],
            benefit_type_id_for_checkbox:0
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
                        selected.push(benefit.id);
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

            axios.get(app.url + '/admin/get-benefit-types').then((response) => {
                if( response.data.success ) {
                    app.benefit_types = response.data.data.benefitTypes;
                    console.log("****************************DWS****************************");
                    console.log(response.data.data.benefitTypes);
                    console.log("****************************DWS****************************");
                    // Sorting the benefit based on order_sequence key
                    app.benefit_types.forEach((value, benefitTypesIndex) => {
                        app.sortByKey(benefitTypesIndex, 'order_sequence')
                    });
                    setTimeout(() => app.initiateOrdering(), 100);
                } else {
                    showErrorMessage(response.data.data.msg);
                }
                app.viewLoader = false;
            }).catch((error) => {
                showErrorMessage(error);
                app.viewLoader = false;
            }); 
        },
        formatCategoryLabel(parent, allCategories) {
            const child = allCategories.find(c => c.categorie_id === parent.id);
            return child ? `${parent.name} / ${child.name}` : parent.name;
        },
        saveBenefits(e) {
            let app = this;
            e.preventDefault();
            app.viewLoader = true;

            let benefit_types_arr = Array();
            
            this.benefit_types.forEach((benefit_type, index) => {
                let benefits_arr = Array();
                benefit_type.benefits.forEach((benefit, order_sequence) => {
                    // if(benefit.show) {
                        benefits_arr.push({
                            'additional_benefit_name': benefit.additional_benefit_name,
                            'employee_default_value': benefit.employee_default_value,
                            'employer_default_value': benefit.employer_default_value,
                            'employee_co_pay': benefit.employee_co_pay,
                            'id': benefit.id,
                            'name': benefit.name,
                            'show': benefit.show,
                            'category_id': benefit.category_id,
                            'can_categorize': benefit.can_categorize,
                            'order_sequence': (order_sequence + 1)
                        });
                    // }
                })

                if( benefits_arr && benefits_arr.length > 0 ) {
                    benefit_types_arr.push({'id': benefit_type.id, 'name': benefit_type.name, 'benefits': benefits_arr});
                }
                else
                {
                    benefit_types_arr.push({'id': 0, 'name': '', 'benefits': ''});
                }
            });

            axios.post( app.url + '/admin/benefits/store', { "benefits": benefit_types_arr, "benefits_to_be_deleted": this.benefits_to_be_deleted} ).then( (response) => {
                if(response.data.success) {
                    showSuccessMessage(response.data.data.msg);
                    app.viewLoader = false;
                    app.getBenefitsTypes();
                } else {
                    showErrorMessage(response.data.data.msg);
                    app.viewLoader = false;
                }
            }).catch( (error) => {
                showErrorMessage(error);
                app.viewLoader = false;
            });
        },
        addCustomBenefits( benefit_type_index, benefit_index) {
            let copiedObject = Object.assign({}, this.benefit_types[benefit_type_index].benefits[benefit_index])

            copiedObject.additional_benefit_name = "";
            copiedObject.employee_default_value = "0.00";
            copiedObject.employer_default_value = "0.00";
            copiedObject.id = 0;
            benefit_index += 1;
            copiedObject.name = "Custom Benefit " + (parseInt(benefit_index) + 1);


            this.benefit_types[benefit_type_index].benefits.push(copiedObject);
        },
        removeCustomBenefits(benefit_type_index, benefit_index) {
            this.benefits_to_be_deleted.push(this.benefit_types[benefit_type_index].benefits[benefit_index].id);
            this.benefit_types[benefit_type_index].benefits.splice(benefit_index, 1);
        },
        sortByKey(benefitTypesIndex, sortKey) {
            this.benefit_types[benefitTypesIndex].benefits = Object.values(this.benefit_types[benefitTypesIndex].benefits).sort((a, b) => a.order_sequence - b.order_sequence);
        },
        testSelectAll(id) {
            this.benefit_type_id_for_checkbox = id;
        },
        initiateOrdering() {
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
                            // return false;
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
        }
    }
}
</script>
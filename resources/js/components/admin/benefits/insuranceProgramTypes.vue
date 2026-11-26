<template>
    <div>
        <h3 class="text-xl text-black">Health Insurance Census Informationdfds</h3>
        <div class="mt-5">
            <a href="#" target="_blank" class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-md">New Health Census</a>
            <form>
                <div class="flex -mx-3.5 mt-5">
                    <div class="w-2/5 px-3.5">
                        <select name="healthinsurance" size="5" v-on:change="changeItem($event)" v-model="select_status" class="focus:border-lbrwnclr outline-0 border border-neutral-400 px-2.5 rounded bg-neutral-100 w-full form-control">
                            <option v-for="sstatus in status" :value="sstatus.id">{{sstatus.val}}</option>
                        </select>
                    </div>
                    <div class="w-3/5 px-3.5">
                        <div class="flex flex-wrap mb-3 -mx-2.5">
                            <div class="w-full md:w-1/2 px-2.5">
                                <label class="mb-1" for="description">Description</label>
                                <input name="description" type="text" :value="selected" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                            </div>
                            <div class="w-full md:w-1/2 px-2.5">
                                <label class="mb-1" for="payrollsyear"># of Payrolls in a Year</label>
                                <input name="payrollsyear" type="text" value="" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                            </div>
                        </div>
                        <div class="w-full mb-3">
                            <label class="mb-1" for="employerpaycosts">Employer Per-Pay Costs</label>
                            <input name="employerpaycosts" type="text" value="" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="w-full mb-3">
                            <label class="mb-1" for="employeepaycosts">Employee Per-Pay Costs</label>
                            <input name="employerpaycosts" type="text" value="" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" />
                        </div>
                        <div class="flex justify-end back-btnend"><input type="submit" name="btn_defaults" value="Save" id="" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm mr-2"><input type="submit" name="btn_defaults" value="Delete" id="" class="outline-none cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:bg-red-900 bg-red-700 text-white font-sans font-bold text-sm" /></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    
    data() {
        return {
            selected: "",
            select_status: 0,
             status:[
                {   
                    id: '1',
                    val: 'Single'
                },
                {   
                    id: '2',
                    val: 'Married'
                }

             ],   

            url: process.env.MIX_API_URL,
            viewLoader: false,
            
        }
    },
    created() {
        
    },
    methods: {
        
        changeItem: function changeItem(event) {
            this.selected = event.target.value;
            
            for (let item in this.status) {
                if( this.status[item].id == this.select_status ) {
                    this.selected = this.status[item].val;

                }
            }
        }
    }
}
</script>
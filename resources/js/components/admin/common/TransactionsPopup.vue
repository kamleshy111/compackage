<template>

  <div class="flex flex-wrap -mx-2.5">
    <div class="w-full px-2.5 mb-5">
      <h3 class="text-xl text-black">User Data</h3>
      <div class="flex justify-between pb-3"><span><strong>COMPackage</strong> <em>Administration Area [<a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" :href="url + '/admin/switch-user?user_id='+user_id">View As User</a>] </em></span></div>
      <hr class="border-gray-600" />
    </div>
    <div class="mb-3 md:mb-0 w-full md:w-1/2 px-2.5 flex flex-wrap -mx-2.5">
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">User Name</label>
        <span class="text-[14px] font-bold">{{ popupUser.username }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Account Type</label>
        <span class="text-[14px] font-bold">{{ ( (popupUser && popupUser.user_role == 2)) ? 'Reseller User' : 'Retail User' }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">First Name</label>
        <span class="text-[14px] font-bold">{{ popupUser.firstname }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Last Name</label>
        <span class="text-[14px] font-bold">{{ popupUser.lastname }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Company</label>
        <span class="text-[14px] font-bold" v-if="popupUser && popupUser.companies && popupUser.companies.length">{{ popupUser.companies[0].name }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Industry</label>
        <span class="text-[14px] font-bold" v-if="popupUser && popupUser.companies && popupUser.companies.length">{{ popupUser.companies[0].industry }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Phone</label>
        <span class="text-[14px] font-bold" v-if="popupUser && popupUser.companies && popupUser.companies.length">{{ popupUser.companies[0].telephone }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Ext.</label>
        <span class="text-[14px] font-bold" v-if="popupUser && popupUser.companies && popupUser.companies.length">{{ popupUser.companies[0].phone_ext }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Email</label>
        <span class="text-[14px] font-bold break-all"> <a :href="popupUser.email" class="underline cursor-pointer" >{{ popupUser.email || '-' }}</a> </span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Reports Left</label>
        <span class="text-[14px] font-bold" v-if="popupUser && popupUser.companies && popupUser.companies.length">{{ popupUser.companies[0].reports_left }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Processed</label>
        <span class="text-[14px] font-bold" v-if="popupUser && popupUser.companies && popupUser.companies.length">{{ popupUser.companies[0].reportsprocessed }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Expiration Date</label>
        <span class="text-[14px] font-bold" v-if="popupUser && popupUser.companies && popupUser.companies.length">{{ formatDate(popupUser.companies[0].reports_expire) }}</span>
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Sign-up Date</label>
        <span class="text-[14px] font-bold" v-if="popupUser && popupUser.companies && popupUser.companies.length">{{ formatDate(popupUser.companies[0].signup_date) }}</span>
      </div>
      <!-- <div class="w-full px-2.5 mt-4">
        <a href="javascript:void(0)"
          class="rounded px-3 py-1.5 leading-4 text-center hover:greenback gradient-green text-white font-sans font-bold text-sm inline-block">Update
          Testing Status</a>
      </div> -->
    </div>
    <div class="w-full md:w-1/2 px-2.5">
      <div class="mb-4">
          <label class="mb-1.5 inline-block">Add/Remove Report Credits</label>
          <div class="space-x-4">
              <span>
                  <input v-model="add_remove_radio" value="add" type="radio" name="AddRemove"><label class="ml-1.5" for="Add">Add</label>
              </span>
              <span>
                  <input v-model="add_remove_radio" value="remove" type="radio" name="AddRemove"><label class="ml-1.5" for="Remove">Remove</label>
              </span>
              <span>
                <input name="add_remove_reports" type="number" v-model="add_remove_reports" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-20 form-control mr-2">
                <input type="submit" v-on:click="add_remove_report_button" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback h-7 gradient-green text-white font-sans font-bold text-md" value="Submit">
              </span>
          </div>
      </div>
      
      <div class="flex flex-wrap border border-black p-2.5 max-h-[300px] overflow-auto">
        <div class="w-full mb-3"><strong>Transaction History</strong></div>
        
        <div class="w-full text-xs">
          <div class="font-bold"></div>
          <table>
            <thead>
              <tr>
                <th class="w-1/2">Description</th>
                <th class="w-1/5 text-center">Status</th>
                <th class="w-1/3">Date / Transaction Info</th>
              </tr>
            </thead>
          <tbody>
              <tr v-for="sale in popupUser.sales" style="border-bottom: 1pt solid gray;">
                <td class="w-1/2">{{sale.description}}</td>
                <td class="w-1/5 text-center">
                  {{ sale.status == 0 ? 'Failed' : sale.status }}
                </td>
                <td class="w-1/3">{{sale.created_at || ''}} <br/>{{sale.transactions && sale.transactions.transaction_id || 0}} <br/>$ {{sale.transactions && sale.transactions.amount || 0}}</td>
              </tr>
              
          </tbody>
        </table>
        <p class="text-[14px] font-bold justify-end flex">Total Amount:	${{transactionsTotal(popupUser)}}</p>
          <!-- <p> -->
            <!-- <p v-if="sale.plans" >
            Purchase {{sale.plans ? sale.plans.name : ''}} reports plan for ${{sale.transactions.amount}}
            <span v-if="popupUser && popupUser.companies && popupUser.companies.length">plus {{ popupUser.companies[0].reportsadditional || 0 }} report(s) @ $20 each, EmployeeLoaderModule</span>
            </p> -->
            <!-- <p></p>
            <br/> -->
          <!-- </p> -->
        </div>
        <!-- <div class="w-1/2 text-xs text-right"> -->
          <!-- <div class="font-bold">Date / Transaction Info</div> -->
          <!-- <p v-for="sale in popupUser.sales">
            <span>{{sale.created_at || ''}} <br/>{{sale.transactions && sale.transactions.transaction_id || 0}} <br/>$ {{sale.transactions && sale.transactions.amount || 0}}</span>
            <br/><br/>
          </p> -->
          
        <!-- </div> -->
      </div>

      <!-- <div class="flex flex-wrap border border-black p-2.5">
        <div style="width:225px; height:75px; border:1px solid #CCCCCC; padding:5px;">
          <b>Add/Remove Report Credits</b><br>
          <input id="Add" value="Add" type="radio" name="AddRemove" checked=""><label for="Add">Add</label>
          <input id="Remove" value="Remove" type="radio" name="AddRemove"><label for="Remove">Remove</label><br>
          Number of Reports: <input type="text" size="4" name="Number" value="" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full mb-3 form-control">
          <input type="submit" name="Submit" value="Submit" class="flex items-center justify-center rounded-lg w-96 px-4 py-2.5 leading-4 text-center gradient-green hover:gradient-lgreen text-white font-sans font-bold text-lg">
        </div>
      </div> -->
    </div>

    <!-- Loader -->
    <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
        <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
    </div>
  </div>
</template>

<script>
  export default {
    props:['user_id'],
    data() {
      return {
        popupUser: {},
        add_remove_radio:'add',
        add_remove_reports:'',
        viewLoader: false,
        url: process.env.MIX_API_URL
      }
    },
    created() {
      this.getUserWithRelations();
    },
    methods: {
      getUserWithRelations() {
        let app = this;

        app.viewLoader = true;
        
        axios.post( app.url + '/admin/user-details', {user_id: app.user_id} ).then((response) => { 
            if( response.data.success ) {
                app.popupUser = response.data.data.user;
            } else {
                showErrorMessage("Something went wrong!!");
            }
            app.viewLoader = false;
        }).catch((error) => {
            app.viewLoader = false;
        });
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
      transactionsTotal(popupUser) {
        let total = 0;
        for( let i in popupUser.sales ) {
          if( popupUser.sales[i] && popupUser.sales[i].transactions && popupUser.sales[i].transactions.amount) {
            total += popupUser.sales[i].transactions.amount;
          }
        }
        return numberWithCommas(total);
      },
      add_remove_report_button() {
        let app = this;
        app.viewLoader = true;
        
        if( app.add_remove_reports > 0 ) {
          let action = '';
          if( app.add_remove_radio == 'add' ) {
            action = 'add';
          } else if( app.add_remove_radio == 'remove' ) {
            action = 'remove';
          }
          
          axios.post( app.url + '/admin/add-remove-report', {action: action, user_id: app.user_id, report_count: app.add_remove_reports, popupUser: app.popupUser } ).then((response) => { 
              if( response.data.success ) {
                app.add_remove_reports = '';
                app.getUserWithRelations();
                showSuccessMessage(response.data.data.msg);
              } else {
                  showErrorMessage("Something went wrong!!");
              }
              app.viewLoader = false;
          }).catch((error) => {
              app.viewLoader = false;
          });

        } else {
          showErrorMessage("Report count should be greater than 0.");
          return false;
        }
      }
    }
  }
</script>
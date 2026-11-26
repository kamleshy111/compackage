<template>

  <div class="flex flex-wrap -mx-2.5" id="single_transaction">
    <div class="w-full px-2.5 mb-5">
      <h3 class="text-xl text-black">Transaction Data</h3>
      <div class="flex justify-between pb-3"><span><strong>COMPackage</strong>&nbsp;
          <em>Administration Area</em></span></div>
      <hr class="border-gray-600" />
    </div>
    <div class="mb-3 md:mb-0 w-full md:w-full px-2.5 flex flex-wrap -mx-2.5">
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Transaction</label>
        <span v-show="!showInput" class="text-[14px] font-bold">{{ popupuser.transaction_id }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.transaction_id">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Amount</label>
        <span v-show="!showInput" class="text-[14px] font-bold">{{ popupuser.amount }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.amount">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">First Name</label>
        <span v-show="!showInput" class="text-[14px] font-bold">{{ popupuser.firstname }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.firstname">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Last Name</label>
        <span v-show="!showInput" class="text-[14px] font-bold">{{ popupuser.lastname }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.lastname">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">User Name</label>
        <span v-show="!showInput" class="text-[14px] font-bold">{{ popupuser.username }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.username">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Email</label>
        <span v-show="!showInput" class="text-[14px] font-bold break-all"> {{ popupuser.email || '-' }} </span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.email">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Company</label>
        <span v-show="!showInput" class="text-[14px] font-bold">{{ popupuser.company_name }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.company_name">
      </div>
      <input type="hidden" v-show="showInput" v-model="popupuser.company_pivot.company_id">
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Industry</label>
        <span v-show="!showInput" class="text-[14px] font-bold" >{{ popupuser.company_industry }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.company_industry">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Reports</label>
        <span v-show="!showInput" class="text-[14px] font-bold" >{{ popupuser.company_reports_left }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.company_reports_left">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Phone</label>
        <span v-show="!showInput" class="text-[14px] font-bold">{{ popupuser.company_telephone || '-' }}</span>
        <input class="border border-danger" required type="phone" v-show="showInput" v-model="popupuser.company_telephone">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Ext.</label>
        <span v-show="!showInput" class="text-[14px] font-bold">{{ popupuser.company_phone_ext || '-' }}</span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.company_phone_ext">
      </div>
      <div class="w-1/2 px-2.5 mb-3">
        <label class="text-[15px] block text-black leading-[1.1]">Expiry date</label>
        <span v-show="!showInput" class="text-[14px] font-bold break-all"> {{ popupuser.company_reports_expire || '-' }} </span>
        <input class="border border-danger" required type="text" v-show="showInput" v-model="popupuser.company_reports_expire">
      </div>
      <a v-on:click="showInput = true" v-show="!showInput" title="Edit" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback h-7 gradient-green text-white font-sans font-bold text-md">Edit Record</a>
      <a v-show="showInput" v-on:click="editUserDetailsTransactions(popupuser.id)" title="Update" class="cursor-pointer rounded px-3 mr-1 py-1.5 leading-4 text-center hover:greenback h-7 gradient-green text-white font-sans font-bold text-md">Update</a>
      <a v-show="showInput" title="Cancel" class="cursor-pointer rounded px-3 py-1.5 leading-4 text-center hover:greenback h-7 gradient-green text-white font-sans    font-bold text-md" @click="hideInputs">Cancel</a>
    </div>

    <!-- Loader -->
    <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
        <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
    </div>
  </div>
</template>

<script>
  export default {
    props:['popupuser'],
    data() {
      return {
        showInput: false,
        //popupuser: {},
        viewLoader: false,
        url: process.env.MIX_API_URL,
        popup_inputs: {
          companies: [
          {
            industry: '',
            phone_ext: '',
            telephone: '',
            name: '' ,
            reports_expire: ''
          }
        ]
        },
      }
    },
    created() {
      //console.log(this.popupuser);
      //console.log(this.popupuser.username);
      //this.getUserWithRelations();
    },
    methods: {
      hideInputs() {
        this.showInput = false;
      },
      showInputs() {
        this.showInput = true;
      },
      editUserDetailsTransactions(popupUser_id) {
          let app = this;
          app.viewLoader = true;

          if (popupUser_id > 0) {
              axios.post(app.url + '/admin/updatesalesrecord', app.popupuser)
                  .then((response) => {
                      //console.log(response);
                      if (response.data.success) {
                          showSuccessMessage(response.data.data.successmsg);
                          jQuery("#close_transaction").click();
                          jQuery("#search_results").click();
                          
                          //location.reload(); // Use location.reload() to refresh the page
                      } else {
                          showErrorMessage(response.data.data.errors_msg);
                          showErrorMessage(response.data.data.errors.firstname);
                          showErrorMessage(response.data.data.errors.lastname);
                          showErrorMessage(response.data.data.errors.lastname);
                          showErrorMessage(response.data.data.errors.username);
                          showErrorMessage(response.data.data.errors.email);
                          showErrorMessage(response.data.data.errors.company_name);
                          showErrorMessage(response.data.data.errors.company_telephone);
                          showErrorMessage(response.data.data.errors.company_industry);
                          showErrorMessage(response.data.data.errors.company_reports_expire);
                          showErrorMessage(response.data.data.errors.company_reports_left);
                          showErrorMessage(response.data.data.errors.transaction_id);
                          showErrorMessage(response.data.data.errors.company_phone_ext);
                          showErrorMessage(response.data.data.errors.amount);
                      }
                      app.viewLoader = false;
                  })
                  .catch((error) => {
                      showErrorMessage("Something went wrong");
                      app.viewLoader = false;
                  });
          } else {
              alert('Please enter valid user data.');
              app.viewLoader = false;
          }
      },

      getUserWithRelations() {
        let app = this;

        app.viewLoader = true;
        
        axios.post( app.url + '/admin/user-details', {user_id: app.user_id} ).then((response) => { 
            if( response.data.success ) {
                app.popupuser = response.data.data.user;
                //console.log(app.popupuser);
            } else {
                showErrorMessage("Something went wrong!!");
            }
            app.viewLoader = false;
        }).catch((error) => {
            app.viewLoader = false;
        });
      }
    }
  }
</script>
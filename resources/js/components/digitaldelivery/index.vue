<template>
  <div>
    <ul v-if="error_msg" class="list-disc">
      <li class="ml-3 mb-3 text-red-600 text-xs">{{ error_msg }}</li>
    </ul>

    <form v-on:submit="submitForm">
      <div class="flex flex-wrap -mx-2 mb-3">
        <div class="w-full px-2 mb-3 lg:mb-0">
          <label for="Email" class="mb-1"
            >Email (your email on the file with your employer)</label
          >
          <input
            type="email"
            required
            name="email"
            v-model="demoForm.email"
            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"
          />
        </div>
        <!-- <p class="flex flex-wrap item-center justify-center w-full mt-5">AND</p> -->
        <div class="w-full px-2 mt-3">
          <div class="flex flex-wrap">
            <div class="w-full">
              <label for="Phone" class="mb-1"
                >Digital Delivery ID (your unique ID provided to you by your
                employer)
                <span
                  title="If you are not sure your DDID then, please contact to your employer"
                  >(?)</span
                ></label
              >
              <input
                type="text"
                required
                name="phone"
                v-model="demoForm.phone"
                class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap -mx-2 mb-3">
        <div class="lg:w-1/2 w-full px-2">
          <label for="otp" class="mb-1">Enter One-Time Passcode</label>
          <input
            type="text"
            name="otp"
            v-model="demoForm.otp"
            :disabled="is_otp_disabled"
            :class="is_otp_disabled ? 'opacity-50 cursor-not-allowed' : ''"
            class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"
          />
        </div>

        <div
          v-if="otp_sent && timerCount != 0"
          class="lg:w-1/3 w-full px-2 flex flex-wrap item-center justify-center"
        >
          You can resend in 00:{{ timerCount }}
        </div>
        <div
          v-else-if="!is_otp_disabled && resend_otp"
          class="lg:w-1/3 w-full px-2 flex flex-wrap item-center justify-center"
        >
          <input
            type="button"
            v-on:click="resend_otp1"
            name="Submit"
            value="Resend One-Time Passcode"
            class="mt-5 transition ease-in-out delay-150 outline-none cursor-pointer mr-50 rounded-lg md:px-5 lg:px-5 px-9 md:py-1 py-1 leading-4 text-center gradient-lgreen hover:gradient-green text-white font-sans font-bold md:text-sm"
          />
        </div>
      </div>
      <div class="w-full flex flex-wrap items-center justify-center mt-10">
        <input
          type="submit"
          name="Submit"
          :value="button_text"
          class="transition ease-in-out delay-150 outline-none cursor-pointer mr-3 rounded-lg md:px-5 lg:px-9 px-9 md:py-1.5 py-2.5 leading-4 text-center hover:opacity-90 gradient-brown text-white font-sans font-bold md:text-sm lg:text-lg text-lg"
        />
      </div>
    </form>
    <div class="get-report-instructions mt-4">
      <ul>
        <li>
          Enter your email and ID provided by your employer and click "Get
          One-Time Passcode."
        </li>
        <li>A code will be emailed to you.</li>
        <li>
          Enter that code and validate the code after that click on "Get Report"
          to access your total compensation report.
        </li>
      </ul>
      <p class="mt-2 font-bold text-[15px]">
        ​If you do not have your Digital Delivery ID or need assistance, please
        contact your HR Department.
      </p>
    </div>
    <div
      class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0"
      v-show="viewLoader"
    >
      <img
        :src="url + '/images/com-loader.gif'"
        alt="loader"
        class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]"
      />
    </div>
  </div>
</template>
<script>
export default {
  props: ["redirect_url"],
  data() {
    return {
      viewLoader: false,
      button_text: "Get One-Time Passcode",
      otp_sent: false,
      otp_validated: false,
      is_otp_disabled: true,
      demoForm: {
        email: "",
        phone: "",
        otp: "",
      },
      timerCount: 60,
      url: process.env.MIX_API_URL,
      download_url: "",
      error_msg: "",
      resend_otp: true,
    };
  },
  watch: {
    timerCount: {
      handler(value) {
        if (value > 0) {
          setTimeout(() => {
            if (this.timerCount > 0) {
              this.timerCount--;
            }
          }, 1000);
        }
      },
      immediate: true, // This ensures the watcher is triggered upon creation
    },
  },
  methods: {
    resend_otp1() {
      let app = this;
      app.viewLoader = true;
      app.error_msg = "";

      axios
        .post(app.url + "/send-otp", app.demoForm)
        .then((response) => {
          if (response.data.success) {
            showSuccessMessage(response.data.data.msg);
          } else {
            // showErrorMessage(response.data.data.msg);
            app.error_msg = response.data.data.msg;
          }
          app.viewLoader = false;
        })
        .catch((error) => {
          // showErrorMessage(error.response.data.message)
          app.error_msg = response.data.data.msg;
        });

      this.resend_otp = false;
    },
    submitForm(e) {
      e.preventDefault();
      let app = this;
      app.error_msg = "";

      if (!app.otp_sent) {
        app.viewLoader = true;

        axios
          .post(app.url + "/send-otp", app.demoForm)
          .then((response) => {
            if (response.data.success) {
              app.button_text = "Validate One-Time Passcode";
              app.otp_sent = true;
              app.timerCount = 60;
              app.is_otp_disabled = false;
              showSuccessMessage(response.data.data.msg);
            } else {
              // showErrorMessage(response.data.data.msg);
              app.error_msg = response.data.data.msg;
            }
            app.viewLoader = false;
          })
          .catch((error) => {
            // showErrorMessage(error.response.data.message)
            app.error_msg = response.data.data.msg;
          });
      } else if (app.otp_sent) {
        // && !app.otp_validated

        app.viewLoader = true;

        axios
          .post(app.url + "/validate-otp", app.demoForm)
          .then((response) => {
            if (response.data.success) {
              app.button_text = "Get Report";
              app.otp_validated = true;
              // app.download_url = app.url + '/download-report?key=' + response.data.data.key;
              location.href =
                app.url + "/download-report?key=" + response.data.data.key;
            } else {
              // showErrorMessage(response.data.data.msg);
              app.error_msg = response.data.data.msg;
            }
            app.viewLoader = false;
          })
          .catch((error) => {
            // showErrorMessage(error.response.data.message)
            app.error_msg = response.data.data.msg;
          });
      } /*  else {
                location.href = app.download_url;
            } */
    },
    /* Show error message on the form */
    showFormError(key, message) {
      jQuery("[name=" + key + "]").addClass("border-2 border-rose-600");
      this.showErrorMessage(message);
      moveUp();
    },
  },
};
</script>

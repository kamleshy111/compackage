/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./bootstrap');*/
// try {
//     window.$ = window.jQuery = require("jquery");
// } catch (e) {}

try {
    window.axios = require("axios");
} catch (e) {
    console.error("Unable to load axios");
}

try {
    window.$ = require('jquery');
    window.jQuery = require('jquery');
} catch (e) {
    console.error('Unable to load jQuery');
}



// import { createApp } from 'vue';
import { createApp } from "vue";
let app = createApp({});



/* Public site components. Maybe not in user */
app.component('public-header-nav', require('./components/public/HeaderNav.vue').default);
app.component('webapp-purchaseform', require('./components/public/Purchaseform.vue').default);
app.component('public-sidebar', require('./components/public/Sidebar.vue').default);
app.component('public-sidebar2', require('./components/public/Sidebar2.vue').default);
app.component('public-contactform', require('./components/public/Contactform.vue').default);
app.component('public-compensationpricing', require('./components/public/Compensationpricing.vue').default);
app.component('public-referafriend', require('./components/public/forms/referaFriend.vue').default);
app.component('public-totalcompensationdemo', require('./components/public/forms/totalCompensationDemo.vue').default);
app.component('public-totalcompensationdemogw', require('./components/public/forms/totalCompensationDemoGW.vue').default);
app.component('public-purchaselogin', require('./components/public/forms/purchaseLogin.vue').default);
app.component('public-forgotpassword', require('./components/public/forms/forgotPassword.vue').default);
app.component('public-review-feedback', require('./components/public/reviewFeedback.vue').default);

// KRTech
app.component('posts', require('./components/public/Post.vue').default);
app.component('single-posts', require('./components/public/ItemPost.vue').default);
app.component('category', require('./components/public/Category.vue').default);
app.component('category-posts', require('./components/public/CategoryPosts.vue').default);
app.component('archives', require('./components/public/Archives.vue').default);
app.component('categories', require('./components/public/Categories.vue').default);
app.component('recent', require('./components/public/Recent.vue').default);
app.component('archive-posts', require('./components/public/ArchivePosts.vue').default);
app.component('search', require('./components/public/Search.vue').default);


/*
|--------------------------------------------------------------------------
| Company(WebApps) Routes
|--------------------------------------------------------------------------
*/

/** Dashboard */
app.component('webapp-dashboard', require('./components/webapp/dashboard.vue').default);

/** Webapp/Company */
app.component('company-create', require('./components/webapp/company/Create.vue').default);
app.component('company-index', require('./components/webapp/company/Index.vue').default);

/** Webapp/Benefits */
app.component('benefits-index', require('./components/webapp/benefits/Index.vue').default);
app.component('benefits-insurancetypes', require('./components/webapp/benefits/insuranceProgramTypes.vue').default);

/** Webapp/employee */
app.component('employee-index', require('./components/webapp/employee/Index.vue').default);
app.component('employee-create', require('./components/webapp/employee/Create.vue').default);
app.component('employee-edit', require('./components/webapp/employee/Edit.vue').default);

// /** Webapp/User */
app.component('user-create', require('./components/webapp/user/Create.vue').default);
app.component('user-index', require('./components/webapp/user/Index.vue').default);
app.component('webapp-sidebar', require('./components/webapp/common/Sidebar.vue').default);

/** Common */
app.component('header-user-company-information', require('./components/webapp/common/HeaderUserCompanyInformation.vue').default);
app.component('pagination', require('./components/global/Pagination.vue').default);

app.component('webapp-faq', require('./components/webapp/Faq.vue').default);
app.component('webapp-request-form', require('./components/webapp/supportrequest.vue').default);
app.component('webapp-change-pass', require('./components/webapp/changePassword.vue').default);
app.component('webapp-employee-loader', require('./components/webapp/employee-loader/employeeLoader.vue').default);

app.component('digital-delivery-report', require('./components/digitaldelivery/index.vue').default);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

/** Admin Benefits */
app.component('admin-dashboard', require('./components/admin/dashboard.vue').default);
app.component('admin-benefits-index', require('./components/admin/benefits/Index.vue').default);
app.component('admin-benefits-insurancetypes', require('./components/admin/benefits/insuranceProgramTypes.vue').default);

/** Admin Employees */
app.component('admin-employee-index', require('./components/admin/employee/Index.vue').default);
app.component('admin-employee-edit', require('./components/admin/employee/Edit.vue').default);

/** Admin Company */
app.component('admin-company-index', require('./components/admin/company/Index.vue').default);
app.component('admin-company-edit', require('./components/admin/company/Edit.vue').default);

/** UserManager Company */
app.component('admin-user-index', require('./components/admin/usermanager/index.vue').default);

/** Sales Reporting Company */
app.component('admin-salesreport-index', require('./components/admin/salesreporting/index.vue').default);

/** Demo Inquiries */
app.component('admin-demoinquiries-index', require('./components/admin/demoinquiries/index.vue').default);

app.component('coupon', require('./components/admin/coupon/Index.vue').default);
app.component('create-coupon', require('./components/admin/coupon/Create.vue').default);

/** Demo Inquiries email settings*/
app.component('admin-demoinquiries-emailsettings', require('./components/admin/demoinquiries/emailsettings.vue').default);

/**
 * Admin Common
 */
app.component('webapp-admin-sidebar', require('./components/admin/common/Sidebar.vue').default);
app.component('admin-transactions-popup', require('./components/admin/common/TransactionsPopup.vue').default);
app.component('admin-single-transactions-popup', require('./components/admin/common/SingleTransactionsPopup.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

app.mount("#app");
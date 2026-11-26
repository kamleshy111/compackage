<template>

  <div class="h-screen">
    <div class="shadow shadow-gray-300 w-44 left-11 top-3 hover:bg-gray-200"></div>
    <aside id="sidebar" class="sticky h-screen top-0 bg-gray-100 flex flex-col -mt-[104px]">
      <div class="flex relative flex-col flex-1 pt-0 min-h-0 bg-gray-50">
        <div class="flex flex-col flex-1 pt-8 pb-4">
          <div class="flex-1 bg-gray-50 px-3" id="sidebar-items">
            <ul class="pb-2 pt-20">
              <li>
                <a id="collps-menu" href="#" class="flex items-center py-2.5 px-1.5 text-base font-normal text-dark-500 rounded-lg group transition-all duration-200" v-bind:class="[isActive ? 'inactive hover:bg-transparent lg:hover:bg-gray-200 lg:px-4 px-0' : 'active hover:bg-gray-200 lg:hover:bg-transparent lg:px-0 px-4']" v-on:click="toggleClass()">
                  <div
                    class="bg-white shadow-lg shadow-gray-300  text-dark-700 w-8 h-8 p-1.5 mr-1 rounded-lg text-center grid place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                  </div>
                  <span class="menu-txt ml-3 text-dark-500 text-sm" sidebar-toggle-item="">Collapse menu</span>
                </a>
              </li>

              <li class="relative cursor-pointer" v-for="(smenu, index) in sidebarMenus" :key="smenu.id" :class="(currentLocation == smenu.url) ?  'active bg-gray-200 rounded-lg ' + smenu.subMenuClass : smenu.subMenuClass">
                <a :href="smenu.url" 
                  :class="[isActive ? 'hover:bg-transparent lg:hover:bg-gray-200 lg:px-4 px-0' : 'hover:bg-gray-200 lg:hover:bg-transparent lg:px-0 px-4']" 
                  class="flex items-center py-2.5 px-1.5 text-base font-normal text-dark-500 rounded-lg group transition-all duration-200"
                  :target="smenu.target ? smenu.target : '_self'"> <!-- Check if smenu.target exists -->
                  <div class="bg-white shadow-lg shadow-gray-300 text-dark-700 w-8 h-8 p-1.5 mr-1 rounded-lg text-center grid place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" :d="smenu.icon" />
                    </svg>
                  </div>
                  <span class="menu-txt ml-3 text-dark-500 text-sm" sidebar-toggle-item="">{{ smenu.name }}</span>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" class="comdrop-down absolute top-5 right-4 h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" :d="smenu.dropIcon"></path>
                </svg>

                <ul class="dash-submenu" style="display:none;">
                  <li v-for="subMenu in smenu.children" :class="{'active bg-gray-200 rounded-lg' : currentLocation == subMenu.url}">
                    <a :href="subMenu.url" class="flex items-center py-2.5 px-1.5 text-base font-normal text-dark-500 rounded-lg group transition-all duration-200">
                      <span class="ml-3 text-dark-500 text-sm" sidebar-toggle-item="">{{subMenu.name}}</span>
                    </a>
                  </li>  
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </aside>
  </div>

</template>
<script>
export default {
  props: [
    'current_route',
    'lic_pack',
    'plan',
    'isresubscribed'
  ],
  data() {
    return {
      
      isActive: true,
      url: process.env.MIX_API_URL,
      sidebarMenus:[
        {
          url:'/webapp/dashboard',
          icon:'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
          name:'Home',
        },
        {
          url:'javascript:void(0)',
          icon:'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
          name:'Company',
          dropIcon:'M19 9l-7 7-7-7',
          subMenuClass:'hasChild',
          open: false,
          children:[
            {
              url:'/webapp/companies',
              name:'Companies',
            },
            {
              url:'/webapp/companies/details',
              name:'Company Profile',
            }
          ]
        },
        /*
        {
          url:'javascript:void(0)',
          icon:'M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z',
          name:'Benefits',
          dropIcon:'M19 9l-7 7-7-7',
          subMenuClass:'hasChild',
          open: false,
          children:[
            {
              url:'/webapp/benefits-list',
              name:'Benefits List',
            },
            {
              url:'/webapp/insurance-program-types',
              name:'Insurance Program Type',
            }
          ]
        },
        */
        {
          url:'/webapp/benefits-list',
          icon:"M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z",
          name:'Benefits List',
        },
        /*
        {
          url:'javascript:void(0)',
          icon:'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
          name:'Employees',
          dropIcon:'M19 9l-7 7-7-7',
          subMenuClass:'hasChild',
          open: false,
          children:[
            {
              url:'/webapp/employees',
              name:'Employees',
            },
            {
              url:'/webapp/employees/create',
              name:'Add New',
            }
          ]
        },
        */
        {
          url:'/webapp/employees',
          icon:"M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z",
          name:'Employees',
        },
        {
          url:'/webapp/employee-loader',
          icon:"M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5",
          name:'Employee Loader',
        },
        {
          icon:'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
          url:'/webapp/users',
          name:'Users',
        },
        


        // {
        //   url:'javascript:void(0)',
        //   icon:'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
        //   name:'Utilities',
        //   dropIcon:'M19 9l-7 7-7-7',
        //   subMenuClass:'hasChild',
        //   open: false,
        //   children:[
        //     // {
        //     //   url:'/webapp/account-information',
        //     //   name:'Account Information',
        //     // },
        //     {
        //       url:'/webapp/users',
        //       name:'Users',
        //     }
        //   ]
        // },
        {
          url:'/webapp/faq',
          icon:'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
          name:'FAQ',
        },
        {
          url:'/webapp/change-password',
          icon:'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z',
          name:'Change Your Password',
        },
        {
          url:'/webapp/account-information',
          icon:'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99',
          name:'Annual Renewal',
        },
        {
          url:'/total-compensation-statements/software-purchase',
          icon:"M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5",
          name:'Order More Reports',
        },
        {
          url:'/review',
          icon:"M5 3h14a2 2 0 012 2v10a2 2 0 01-2 2H7l-4 4v-4H5a2 2 0 01-2-2V5a2 2 0 012-2zM4 6.5l1 .5-1 .5-1-.5 1-.5zm12 0l1 .5-1 .5-1-.5 1-.5zm-4 6.25l2.25-1.25L12 9.75l-2.25 1.75L10 10.5 8.75 8 7.5 10.5 6 9.75 8.25 11.5 6 13.5l2.25-1.75L10 13.75z",
          name:'Write a Review',
          target: '_blank'
        }
      ],
      currentLocation: location.href.split(process.env.MIX_API_URL)[1]
    }
  },
  created() {
    console.log(this.isresubscribed);
    if((this.lic_pack > 1 || this.isresubscribed) && this.plan == 'standard') {
      this.sidebarMenus.push({
        url:'/webapp/annual-refresh',
        icon:'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99',
        name:'Annual Refresh',
      });
    }
  },
  methods: {
    
    toggleClass(event) {
      jQuery('#main-content').toggleClass('menu-active blur-sm lg:blur-none');
      jQuery('.comdrop-down').toggleClass('invisible opacity-0');
      jQuery('.submenu').toggleClass('submenu-inactive absolute invisible opacity-0');
      this.isActive = !this.isActive;
    }
  }
}
</script>
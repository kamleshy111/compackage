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
                
                <a :target="smenu.target" :href="smenu.url" :class="[isActive ? 'hover:bg-transparent lg:hover:bg-gray-200 lg:px-4 px-0' : 'hover:bg-gray-200 lg:hover:bg-transparent lg:px-0 px-4']" class="flex items-center py-2.5 px-1.5 text-base font-normal text-dark-500 rounded-lg group transition-all duration-200">
                  <div class="bg-white shadow-lg shadow-gray-300  text-dark-700 w-8 h-8 p-1.5 mr-1 rounded-lg text-center grid place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" :d="smenu.icon" />
                    </svg>
                  </div>
                  <span class="menu-txt ml-3 text-dark-500 text-sm" sidebar-toggle-item="">{{ smenu.name }}</span>
                </a>
                
                <svg xmlns="http://www.w3.org/2000/svg" class="comdrop-down absolute top-5 right-4 h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" :d="smenu.dropIcon"></path>
                </svg>
                
                <ul class="dash-submenu" style="display:none;">
                  <li v-for="subMenu in smenu.children" :class="{'active bg-gray-200 rounded-lg' : (currentLocation == subMenu.url || currentLocation.includes(subMenu.url))}">
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
  data() {
    return {
      croute: '',
      isActive: true,
      url: process.env.MIX_API_URL,
      sidebarMenus:[
        {
          url:'/admin/dashboard',
          icon:'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
          name:'Home',
        },
        {
          url:'/admin/usermanager',
          icon:'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
          name:'User Manager',
        },
        {
          url:'/admin/demoinquiries',
          icon:'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
          name:'Demo Inquiry',
        },
        {
          url:'/admin/emailsettings',
          icon:'M5 0h14a5 5 0 015 5v14a5 5 0 01-5 5H5a5 5 0 01-5-5V5a5 5 0 015-5zM7 18h10v2H7v-2zm0-4h10v2H7v-2zm0-4h10v2H7v-2zm0-4h10v2H7V6zm-2 2h2v2H5V8zm0 4h2v2H5v-2zm0 4h2v2H5v-2zm0 4h2v2H5v-2zM9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
          name:'Demo Inquiry Email Setting',
        },
        {
          url:'/admin/salesreporting',
          icon:'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605',
          name:'Sales Reporting',
        },
        {
          url:'#',
          icon:'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
          name:'Company',
          dropIcon:'M19 9l-7 7-7-7',
          subMenuClass:'hasChild',
          open: false,
          children:[
            {
              url:'/admin/companies',
              urls: [
                '/admin/companies',
                '/admin/companies/edit/{id}'
              ],
              name:'Companies',
            },

          ]
        },
        {
          url:'/admin/benefits-list',
          icon:'M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z',
          name:'Benefits',
        },
        {
          url:'/admin/employees',
          icon:'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
          name:'Employees',
        },
        {
          url:'/admin/coupons',
          icon:'M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z',
          name:'Coupons',
        }




        /* {
          url:'/total-compensation-statements/software-purchase',
          icon:'M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z',
          name:'Admin Order Form',
          target:'_blank'
        } */
      ],
      currentLocation: location.href.split(process.env.MIX_API_URL)[1]
    }
  },
  created() {
    setTimeout(() => {
      this.replaceBladeVariables();
    },100);
    console.log(location.href);
  },
  methods: {
    replaceBladeVariables() {
      let v = '/admin/companies/edit/{id}';
      let arr1 = '';
      let arr2 = '';
      arr1 = this.currentLocation.split('/');
      arr2 = v.split('/');
      arr1 = arr1.filter(val => !arr2.includes(val));
      
      let a = v.match('\{(.*?)\}');

      if( Array.isArray(arr1) && arr1[0] ) {
        v = v.replace(a[0], arr1[0]);
      }
      
      return v;
    },
    toggleClass(event) {
      jQuery('#main-content').toggleClass('menu-active blur-sm lg:blur-none');
      jQuery('.comdrop-down').toggleClass('invisible opacity-0');
      jQuery('.submenu').toggleClass('submenu-inactive absolute invisible opacity-0');
      this.isActive = !this.isActive;
    },
  }
}
</script>
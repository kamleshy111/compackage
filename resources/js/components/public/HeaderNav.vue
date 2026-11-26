<template>
<div class="hidden relative" id="mobile-menu">
  <div class="mobtopmenu">
    <ul class="w-full text-center">
      <li v-for="fullMenu in topMenu" class="border-b-[#fff] border-b bg-greendarkclr items-center relative">
        <a :href="fullMenu.url" v-if="!fullMenu.children" class="text-white h-full h-full text-white text-base md:text-sm lg:text-lg inline-block py-3 px-3 font-bold w-[6.7rem] lg:w-[9.5rem] lg:leading-[18px]">
          <span class="self-center">{{ fullMenu.name }}</span>
        </a>
        <span class="flex flex-wrap h-full hover:text-white h-full text-white text-base md:text-sm lg:text-lg block py-3 px-3 font-bold lg:leading-[18px]" v-else><a :href="fullMenu.url" class="flex item-center">{{ fullMenu.name }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" v-on:click="fullMenu.open = !fullMenu.open">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
          <div class="w-full bg-greendarkclr pt-3.5" v-on:mouseover="fullMenu.open = true" v-show="fullMenu.open">
            <ul v-for="childFull in fullMenu.children" class="z-10 px-3.5 topsub-menu">
              <li v-for="chil in childFull" class="pb-1.5 mb-1.5">
                <a :href="chil.url" v-if="!chil.children" class="items-center flex font-sans font-bold text-black text-white text-[14px]"><span>{{ chil.name }}</span></a>
                <span class="relative" v-else  v-on:click="chil.open = !chil.open"><a :href="chil.url" class="items-center flex font-sans font-bold text-white text-[14px]">{{ chil.name }}</a>
                  <ul v-show="chil.open" v-on:mouseover="chil.open = true" class="bg-greendarkclr p-3.5 topsub-menu">
                    <li v-for="childchildFull in chil.children" class="last:mb-0 text-left pb-1.5 mb-1.5">
                      <a :href="childchildFull.url" class="items-center flex font-sans font-bold text-white text-[14px]"><span>{{ childchildFull.name }}</span></a>
                    </li>
                  </ul>
                </span>
              </li>
            </ul>
          </div>
        </span>
      </li>
      <li v-for="Mlogin in customerLogin" class="border-b-[#fff] border-b bg-greendarkclr items-center relative">
        <a :href="Mlogin.url" v-if="!Mlogin.children" class="text-white h-full h-full text-white text-base md:text-sm lg:text-lg inline-block py-3 px-3 font-bold w-[6.7rem] lg:w-[9.5rem] lg:leading-[18px]">
          <span class="self-center">{{ Mlogin.name }}</span>
        </a>
        <span class="flex flex-wrap h-full hover:text-white h-full text-white text-base md:text-sm lg:text-lg block py-3 px-3 font-bold lg:leading-[18px]" v-else><a :href="Mlogin.url" class="flex item-center">{{ Mlogin.name }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" v-on:click="Mlogin.open = !Mlogin.open">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
          <div class="w-full bg-greendarkclr pt-3.5" v-on:mouseover="Mlogin.open = true" v-show="Mlogin.open">
            <ul v-for="loginFull in Mlogin.children" class="z-10 px-3.5 topsub-menu">
              <li v-for="loginchil in loginFull" class="pb-1.5 mb-1.5">
                <a :href="loginchil.url" v-if="!loginchil.children" class="items-center flex font-sans font-bold text-black text-white text-[15px]"><span>{{ loginchil.name }}</span></a>
                <span class="relative" v-else  v-on:click="loginchil.open = !loginchil.open"><a :href="loginchil.url" class="items-center flex font-sans font-bold text-white text-[15px]">{{ loginchil.name }}</a>
                  <ul v-show="loginchil.open" v-on:mouseover="loginchil.open = true" class="bg-greendarkclr p-3.5 topsub-menu">
                    <li v-for="loginchildd in loginchil.children" class="last:mb-0 text-left pb-1.5 mb-1.5">
                      <a :href="loginchildd.url" class="items-center flex font-sans font-bold text-white text-[15px]"><span>{{ loginchildd.name }}</span></a>
                    </li>
                  </ul>
                </span>
              </li>
            </ul>
          </div>
        </span>
      </li>
    </ul>
  </div>
  <div class="mob-mainmenu">
    <ul class="w-full bg-white">
      <li v-for="item in items" class="leading-4">
        <a :href="item.url" class="text-center inline-block py-3 px-3 font-sans text-white text-[16px] text-[#524242]"><span class="self-center">{{ item.name }}</span></a>
      </li>
    </ul>
    <div class="py-3 px-3">
      <div class="mb-5"><span class="text-[16px] text-[#524242] mr-2">Phone:</span><a href="tel:833-468-7674" class="text-greendarkclr">833-468-7674</a></div>
      <ul class="flex space-x-4">
        <li class=""><a class="text-dgreenclr" href="https://plus.google.com/113669704258318451394" target="_blank"><img  :src="url + '/images/gplus.png'" alt="Google Plus" /></a></li>
        <li class=""><a class="text-dgreenclr" href="https://www.facebook.com/TotalCompensationReports/" target="_blank"><img class="rounded-[5px]" :src="url + '/images/icon-facebook.jpg'" alt="facebook" /></a></li>
        <li class=""><a class="text-dgreenclr" href="https://www.linkedin.com/company/compackage" target="_blank"><img :src="url + '/images/linkedIn.jpg'" alt="linkedIn" /></a></li>
        <li class=""><a class="text-dgreenclr" href="http://feeds.feedburner.com/CompackageBlog" target="_blank"><img class="rounded-[5px]" :src="url + '/images/icon-rss.png'" alt="RSS" /></a></li>
      </ul>
    </div>
  </div>
</div>
  <div class="hidden md:block relative">
    <!--<div id="full-menu1" class="menu-green py-3 px-2.5 z-10 absolute w-full left-0 top-10" style="display:none;">
      <div class="container mx-auto px-6">
        <div class="row flex -mx-3.5">
          <div class="w-1/3 px-3.5 border-l border-r-[#b1d77e]">
            <ul>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">For Insurance Agencies</a></li>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">For HR Consultants</a></li>
            </ul>
          </div>
          <div class="w-1/3 px-3.5 border-l border-r-[#b1d77e]">
            <ul>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">For Benefits Consultants</a></li>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">For Accounting Firms</a></li>
            </ul>
          </div>
          <div class="w-1/3 px-3.5 border-l border-r-[#b1d77e]">
            <ul>
              <li><a class="font-bold text-sm text-black hover:text-white" href="">For Large Businesses</a></li>
              <li><a class="font-bold text-sm text-black hover:text-white" href="">For Small Businesses</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="full-menu2" class="menu-green py-3 px-2.5 z-10 absolute w-full left-0 top-10" style="display:none;">
      <div class="container mx-auto px-6">
        <div class="row flex -mx-3.5">
          <div class="w-1/3 px-3.5 border-l border-r-[#b1d77e]">
            <ul>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">View a Free Demo</a></li>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">View a Total Compensation Statement</a></li>
            </ul>
          </div>
          <div class="w-1/3 px-3.5 border-l border-r-[#b1d77e]">
            <ul>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">View Pricing</a></li>
              <li class="cphaschild-menu relative"><a class="font-bold text-sm text-black hover:text-white" href="#">Practical uses of Employee Benefit Reports ▼</a>
                <ul class="menu-green sub-menu absolute hidden">
                  <li class="p-1.5 text-sm"><a href="" class="hover:text-white">Year End Reports</a></li>
                  <li class="p-1.5 text-sm"><a href="" class="hover:text-white">Employee Performance Reviews</a></li>
                  <li class="p-1.5 text-sm"><a href="" class="hover:text-white">Employee Recruitment</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="w-1/3 px-3.5 border-l border-r-[#b1d77e]">
            <ul>
              <li><a class="font-bold text-sm text-black hover:text-white" href="">Benefit Statement Glossary</a></li>
              <li><a class="font-bold text-sm text-black hover:text-white" href="">FAQ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="full-menu3" class="menu-green py-3 px-2.5 z-10 absolute w-full left-0 top-10" style="display:none;">
      <div class="container mx-auto px-6">
        <div class="row flex -mx-3.5">
          <div class="w-1/3 px-3.5 border-l border-r-[#b1d77e]">
            <ul>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">Cost of Hidden Perks</a></li>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">Cost of Employee Benefits</a></li>
            </ul>
          </div>
          <div class="w-1/3 px-3.5 border-l border-r-[#b1d77e]">
            <ul>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">Reducing Employee Turnover</a></li>
              <li><a class="font-bold text-sm text-black hover:text-white" href="#">Read Client Testimonials</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>-->


    <nav class="gradient-brown">
      <div class="container relative mx-auto px-3.5">
        <div class="row flex flex-wrap -mx-4">
          <div class="w-5/12 md:w-[46%] lg:w-1/2 px-4 md:-mt-6 lg:-mt-5">
            <ul class="rounded-t-lg flex w-full text-center">
              
              <li v-for="fullMenu in topMenu" :class="(currentLocation == fullMenu.url) ? 'menu-green' : 'gradient-menu'" class="border-r-[#498c5e] first:rounded-tl-lg last:rounded-tr-lg border-r hover:menu-green flex flex-wrap items-center">
                <a :href="fullMenu.url" v-if="!fullMenu.children" class="last:rounded-tr-lg hover:text-white h-full h-full text-white text-base md:text-sm lg:text-lg flex item-center justify-center py-3 px-1 font-bold w-[6.7rem] lg:w-[9.5rem] lg:leading-[18px]">
                  <span class="self-center">{{ fullMenu.name }}</span>
                </a>
                <span class="h-full hover:text-white h-full text-white text-base md:text-sm lg:text-lg flex items-center justify-center py-3 px-1 font-bold w-[6.7rem] lg:w-[9.5rem] lg:leading-[18px]" v-else v-on:mouseover="fullMenu.open = true" v-on:mouseleave="fullMenu.open = false"><a :href="fullMenu.url" class="flex item-center">{{ fullMenu.name }}</a>
                  <div class="after:absolute before:absolute after:content-[''] before:content-[''] after:menu-green before:menu-green after:w-[100vw] after:h-[100%] after:top-[0] before:left-[-100vw] before:w-[100vw] before:h-[100%] before:top-[0] before:right-[-100vw] z-10 top-[40px] left-0 menu-green absolute py-3.5 w-full max-w-[980px] flex" v-on:mouseover="fullMenu.open = true" v-show="fullMenu.open">
                  <ul v-for="childFull in fullMenu.children" class="text-left z-10 w-2/6 px-3.5 topsub-menu border-l border-r-[#b1d77e]">
                    <li v-for="chil in childFull" class="even:mb-0 pb-1.5 mb-1.5">
                        <a :href="chil.url" v-if="!chil.children" :class="(currentLocation == chil.url) ? 'text-white' : 'text-[#323232]'" class="items-center flex font-sans font-bold hover:text-white text-[15px]"><span>{{ chil.name }}</span></a>
                        <span class="relative" v-else v-on:mouseover="chil.open = true" v-on:mouseleave="chil.open = false"><a :href="chil.url" class="items-center flex font-sans font-bold text-[#323232] hover:text-white text-[15px]">{{ chil.name }}</a>
                          <ul v-show="chil.open" v-on:mouseover="chil.open = true" class="z-10 menu-green z-10 top-[17px] w-[250px] left-[auto] p-3.5 topsub-menu absolute">
                              <li v-for="childchildFull in chil.children" class="last:mb-0 text-left pb-1.5 mb-1.5">
                                <a :href="childchildFull.url" :class="(currentLocation == childchildFull.url) ? 'text-white' : 'text-[#323232]'" class="items-center flex font-sans font-bold hover:text-white text-[15px]"><span>{{ childchildFull.name }}</span></a>
                              </li>
                          </ul>
                        </span>
                    </li>
                  </ul>
                  </div>
                </span>
              </li>
            </ul>
          </div>
          <div class="w-7/12 md:w-[54%] lg:w-1/2 px-4">
            <ul class="w-full justify-end flex items-center">
              <li v-for="item in items" class="leading-4">
                <a :href="item.url" v-if="!item.children" :class="{'bg-graylightclr text-[#524242]' : currentLocation == item.url}" class="text-center inline-block py-3 px-3 lg:px-5 border-x border-r-lbrwnclr border-l-brwnclr font-sans font-bold text-white text-[15px] hover:text-[#524242] hover:bg-graylightclr"><span class="self-center">{{ item.name }}</span></a>
                <span class="relative test cursor-pointer text-center inline-block py-3 px-3 lg:px-5 border-x border-r-lbrwnclr border-l-brwnclr font-sans font-bold text-white text-[15px] hover:text-[#524242] hover:bg-graylightclr" v-else v-on:mouseover="item.open = true" v-on:mouseleave="item.open = false"><a :href="item.url">{{ item.name }}</a>
                  <ul v-show="item.open"  v-on:mouseover="item.open = true" class="z-10 top-10 -left-10 p-3.5 w-96 border border-t-0 border-graybdclr sub-menu absolute bg-graylightclr">
                    <li v-for="child in item.children" class="pb-1.5 mb-1.5 border-b-grayccc border border-t-0 border-l-0 border-r-0">
                      <a :href="child.url" :target="child.target" class="items-center flex font-sans font-bold text-[#524242] text-[15px]"><img :src="url + child.img" :alt="child.name"><span class="ml-2.5">{{ child.name }}</span></a>
                    </li>
                  </ul>
                </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: process.env.MIX_API_URL,
      topMenu:[
        {
          url:'/total-compensation-statements',
          name:'Total Benefit Statements',
          open: false,
          children:[
            [
              {
                url:'/total-compensation-statements/insurance-agencies-benefits-software',
                name:'For Insurance Agencies',
              },
              {
                url:'/total-compensation-statements/hr-consultants-benefits-software',
                name:'For HR Consultants',
              }
            ],
            [
              {
                url:'/total-compensation-statements/benefits-consultants-software',
                name:'For Benefits Consultants',
              },
              {
                url:'/total-compensation-statements/accounting-firms-benefits-software',
                name:'For Accounting Firms',
              }
            ],
            [
              {
                url:'/total-compensation-statements/large-business-benefits-software',
                name:'For Large Businesses',
              },
              {
                url:'/total-compensation-statements/small-business-benefits-software',
                name:'For Small Businesses',
              }
            ]
          ]
        },
        {
          url:'/employee-benefit-resources',
          name:'Learn More',
          open: false,
          children:[
            [
              {
                url:'/total-compensation-demo',
                name:'View a Free Demo',
              },
              {
                url:'/compensation-software/sample-total-compensation-report',
                name:'View a Total Compensation Statement',
              }
            ],
            [
              {
                url:'/compensation-software/compensation-statement-pricing',
                name:'View Pricing',
              },
              {
                url:'#',
                name:'Practical uses of Employee Benefit Reports ▼',
                open: false,
                children:[
                {
                  url:'/employee-benefit-resources/employee-year-end-reports',
                  name:'Year End Reports',
                },
                {
                  url:'/employee-benefit-resources/employee-performance-reviews',
                  name:'Employee Performance Reviews',
                },
                {
                  url:'/employee-benefit-resources/employee-recruitment',
                  name:'Employee Recruitment',
                }
                ]
              }
            ],
            [
              {
                url:'/employee-benefit-resources/benefit-statement-glossary',
                name:'Benefit Statement Glossary',
              },
              {
                url:'/compensation-software/benefit-software-faq',
                name:'FAQ',
              }
            ]
          ]
        },
        {
          url:'/why-compackage',
          name:'Why COMPackage?',
          open: false,
          children:[
            [
              {
                url:'/employee-benefit-resources/hidden-employee-compensation-perks',
                name:'Cost of Hidden Perks',
              },
              {
                url:'/employee-benefit-resources/employee-benefits-cost',
                name:'Cost of Employee Benefits',
              }
            ],
            [
              {
                url:'/employee-benefit-resources/reducing-employee-turnover',
                name:'Reducing Employee Turnover',
              },
              {
                url:'/product-reviews',
                name:'Read Client Testimonials',
              }
            ]
          ]
        }
      ],
      customerLogin:[
        {
          url:'#',
          name: 'Customer Login',
          open: false,
          children:[
            [
              {
                url:'/login',
                name:'Hosted Login',
              },
              {
                url:'/login',
                name:'Partner Login',
              }
            ]
          ]
        }
      ],
      items: [
        {
          url: '/',
          name: 'Home'
        },
        {
          url: '/aboutus',
          name: 'About',
          open: false,
          children: [
            {
              url: '/aboutus',
              name: 'About Us',
              img: '/images/menu-compackage.png',
            },
            {
              url: '/referafriend',
              name: 'Tell an Associate about COMPackage',
              img: '/images/menu-payroll.png',
            }
          ]
        },
        {
          url: 'http://blog.compackage.com',
          name: 'Blog',
          target: '_blank',
          open: true,
          // children: [
          //   {
          //     url: 'http://www.linkedin.com/in/joeblattner',
          //     name: 'Stay in Touch Through Linked In',
          //     img: '/images/menu-li.png',
          //     target: 'blank',
          //   },
          //   {
          //     url: 'http://blog.compackage.com',
          //     name: 'Visit our Blog',
          //     img: '/images/menu-rss.png',
          //     
          //   }
          // ]
        },
        {
          url: '/total-compensation-statements/software-purchase',
          name: 'Purchase'
        },
        {
          url: '/contactus',
          name: 'Contact Us'
        }
      ],
      showName: null,
      currentLocation: location.href.split(process.env.MIX_API_URL)[1]
      
    }
  },
  methods: {
  }
}
</script>
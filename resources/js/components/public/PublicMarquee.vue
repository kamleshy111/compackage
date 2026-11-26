<template>
    <div class="h-full">
    	<div class="outer-wrapper h-full">
      		<!-- <dynamic-marquee direction="column" reverse duration="1000"> -->
				<ul class="simply-scroll-list">
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">COMPackage is an extremely easy software to use to create total wage/benefit statements. It is visually appealing and provides greater benefit and wage transparency for employees. We have used COMPackage for six or more years and we are happy to recommend the product.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Jodi Ovens</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Business Administrator &amp; HR Manager, Housewright Construction, Newbury, Vermont</p>
                    </li>
                    <!-- <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold"><img :src="url + '/images/Brett.jpg'" class="w-14 h-14 float-left mr-2">Compackage has given my small business a Professional look at a very affordable cost.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Brett B.</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Business Administrator &amp; HR Manager, Housewright Construction, Newbury, Vermont</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold"><img :src="url + '/images/Jessica-Schreader.png'" class="w-14 h-14 float-left mr-2">COMPackage is an awesome program that has exceeded our expectations. The fact that COMPackage is Web-based is terrific because the program is so accessible and easy to use.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Jessica Schreader</p>
                        <p class="font-serif text-tgray text-[10px] px-3">HR, Vance Metal Fabricators, Geneva, NY</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">With COMPackage we have a detailed, big picture of the costs of employment at our company. COMPackage’s cost is a good deal and it is really user friendly.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Stephanie Iden</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Director of Human Resources, FBD Partnership, San Antonio, TX</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold"><img :src="url + '/images/Tifanni-Vizza.png'" class="w-14 h-14 float-left mr-2">COMPackage demonstrated that fringe benefits add 35% at the lowest paid workers and as high as 50% for some employees. The program certainly met our expectations.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Tiffani Vizza</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Treasuer, Napa Valley Petroleum, American Canyon, CA</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>    
                            <p class="pt-2 text-tgray text-lg font-bold"><img :src="url + '/images/Judy-Grier.png'" class="w-14 h-14 float-left mr-2">We found the COMPackage program easy to use and it met our expectations.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Judy Grier</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Human Resources Manager, Masco Retail Sales Support, Mooresville, NC</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">We are very happy with COMPackage. It’s an easy system to use and the tech staff is responsive and capable.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Becky Bertolasi</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Administrative Manager, La Monica Beverage, Loves Park, IL</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">We had no way to calculate the true cost of our fringe benefits until we found COMPackage. Their software allows us to show employees that their fringe benefits add up to an additional 42% to 52% to their annual compensation.</p>
                        <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Becky Allen</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Bullard Manufacturing, Cynthiana, KY</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">COMPackage is very good, very easy to use. The TCR gave us a bigger picture, one that we had never seen before.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Bill Melang</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Owner, Ultratech Tool &amp; Design, Fond du Lac, WI</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">COMPackage more than met our expectations and our employees liked the annual report. They saw information that they had never seen before.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Linda Collins</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Payroll Administration, DYWIDAG Systems, Worldwide</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">We like COMPackage because the program is easy to use and the technical staff is accessible and friendly. The program has met our expectations.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Carla Reed</p>
                        <p class="font-serif text-tgray text-[10px] px-3">HR Administrator America’s Promise Alliance, Washington, D.C</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold"><img :src="url + '/images/Carmen-Detherage.png'" class="w-14 h-14 float-left mr-2">COMPackage gives us a much bigger picture of the cost of fringe benefits than we ever had before.”  “It is a very good, easy to use program that exceeded our expectations.</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Carmen Detherage</p>
                        <p class="font-serif text-tgray text-[10px] px-3">Linville Management Service, Jacksonville, FL</p>
                    </li>
                    <li class="mb-5">
                        <div class="relative px-3">
                            <div class="quote-box bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/tl-quote.png)'"></div>
                            <p class="pt-2 text-tgray text-lg font-bold">I wanted to extend my appreciation for all your help as we created these compensation summaries.  You epitomized great customer service, and will be one of the main reasons Riverdale Park returns next year to COMPackage for our next summaries. Well done!</p>
                            <div class="br-quote bg-contain bg-no-repeat w-4 h-3" :style="'background-image:url('+url+'/images/br-quote.png)'"></div>
                        </div>
                        <p class="text-white text-lg font-bold px-3">- Anthony Dubosee</p>
                        <p class="font-serif text-tgray text-[10px] px-3">HR Director, Town of Riverdale Park, Riverdale Park, MD</p>
                    </li> -->
				</ul>
      		<!-- </dynamic-marquee> -->
    	</div>
    </div>
</template>
<script>
// import DynamicMarquee from 'vue-dynamic-marquee';

    export default {
      components: {
    //   DynamicMarquee,
    },
      data() {
			  return {
				liNum: 1,
          isActive: true,
          active_el:0,
          url: process.env.MIX_API_URL,
			  }
		  },
      created() {
        
      },
      methods: {
          toggleClass: function(event){
            jQuery('#main-content').toggleClass('menu-active blur-sm lg:blur-none')
            jQuery('.comdrop-down').toggleClass('invisible opacity-0')
            jQuery('.submenu').toggleClass('submenu-inactive absolute invisible opacity-0')
            this.isActive = !this.isActive;
        },
        activate:function(el){
          this.active_el = el;
        }
      }
    }
</script>
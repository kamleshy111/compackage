<template>
  
  <div class="hidden md:block text-center" v-if ="(croute =='/compackageonline') || (croute =='/index.php/compackageonline')">
    <h3 class="mb-2 leading-[1] text-white font-bold text-lg">Video Index</h3>
    <h6 class="text-white font-bold text-sm">Not available on mobile devices</h6>
    <ul class="pt-4">
      <li class="mb-1"><a v-on:click="forward(0, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="0" title="00:00 - Introduction">Introduction</a></li>
      <li class="mb-1"><a v-on:click="forward(88, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="88" title="01:28 - Product Overview">Product Overview</a></li>
      <li class="mb-1"><a v-on:click="forward(105, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="105" title="01:45 - Add Company">Add Company</a></li>
      <li class="mb-1"><a v-on:click="forward(110, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="110" title="01:50 - Input Company Details">Input Company Details</a></li>
      <li class="mb-1"><a v-on:click="forward(135, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="135" title="02:15 - Identify Benefits to Include">Identify Benefits to Include</a></li>
      <li class="mb-1"><a v-on:click="forward(242, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="242" title="04:02 - Add Employees - Intro">Add Employees - Intro</a></li>
      <li class="mb-1"><a v-on:click="forward(281, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="281" title="04:41 - Add Employees – Bulk Loading">Add Employees - Bulk Loading</a></li>
      <li class="mb-1"><a v-on:click="forward(353, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="353" title="05:53 - Add Employees – Manual">Add Employees - Manual</a></li>
      <li class="mb-1"><a v-on:click="forward(416, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="416" title="06:56 - Committing Employees">Committing Employees</a></li>
      <li class="mb-1"><a v-on:click="forward(458, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="458" title="07:38 - Auto Calculators">Auto Calculators</a></li>
      <li class="mb-1"><a v-on:click="forward(632, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="632" title="10:32 - Customizing Benefits">Customizing Benefits</a></li>
      <li class="mb-1"><a v-on:click="forward(695, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="695" title="11:35 - Illuminative Metrics">Illuminative Metrics<sup>TM</sup></a></li>
      <li class="mb-1"><a v-on:click="forward(729, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="729" title="12:09 - Printing Reports">Printing Reports</a></li>
      <li class="mb-1"><a v-on:click="forward(759, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="759" title="12:39 - Digital Delivery of Reports">Digital Delivery of Reports</a></li>
      <li class="mb-1"><a v-on:click="forward(859, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="859" title="14:19 - Hourly Top Box Scores">Hourly Top Box Scores</a></li>
      <li class="mb-1"><a v-on:click="forward(900, 'player')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="900" title="15:00 - Next Steps">Next Steps</a></li>
    </ul>
  </div>

  <div class="hidden md:block text-center" v-else-if ="(croute == '/compackageonlineprofessional') || (croute =='/index.php/compackageonlineprofessional')">
    <h3 class="mb-2 leading-[1] text-white font-bold text-lg">Video Index</h3>
    <h6 class="text-white font-bold text-sm">Not available on mobile devices</h6>
    <ul class="pt-4">
      <li class="mb-1"><a v-on:click="forward(0, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="0" title="00:00 - Introduction">Introduction</a></li>
      <li class="mb-1"><a v-on:click="forward(113, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="113" title="01:53 - Product Overview">Product Overview</a></li>
      <li class="mb-1"><a v-on:click="forward(134, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="134" title="02:14 - Add Company">Add Company</a></li>
      <li class="mb-1"><a v-on:click="forward(141, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="141" title="02:21 - Input Company Details">Input Company Details</a></li>
      <li class="mb-1"><a v-on:click="forward(167, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="167" title="02:47 - Identify Benefits to Include">Identify Benefits to Include</a></li>
      <li class="mb-1"><a v-on:click="forward(274, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="274" title="04:34 - Add Employees - Intro">Add Employees - Intro</a></li>
      <li class="mb-1"><a v-on:click="forward(312, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="312" title="05:12 - Add Employees – Bulk Loading">Add Employees - Bulk Loading</a></li>
      <li class="mb-1"><a v-on:click="forward(384, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="384" title="06:24 - Add Employees – Manual">Add Employees - Manual</a></li>
      <li class="mb-1"><a v-on:click="forward(447, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="447" title="07:27 - Committing Employees">Committing Employees</a></li>
      <li class="mb-1"><a v-on:click="forward(490, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="490" title="08:10 - Auto Calculators">Auto Calculators</a></li>
      <li class="mb-1"><a v-on:click="forward(663, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="663" title="11:03 - Customizing Benefits">Customizing Benefits</a></li>
      <li class="mb-1"><a v-on:click="forward(727, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="727" title="12:07 - Illuminative Metrics">Illuminative Metrics<sup>TM</sup></a></li>
      <li class="mb-1"><a v-on:click="forward(760, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="760" title="12:40 - Printing Reports">Printing Reports</a></li>
      <li class="mb-1"><a v-on:click="forward(791, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="791" title="13:11 - Digital Delivery of Reports">Digital Delivery of Reports</a></li>
      <li class="mb-1"><a v-on:click="forward(891, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="891" title="14:51 - Hourly Top Box Scores">Hourly Top Box Scores</a></li>
      <li class="mb-1"><a v-on:click="forward(930, 'player1')" class="seek-button rounded gradient-lgreen hover:gradient-green w-full text-center py-1 px-2.5 text-md text-white font-bold inline-block" href="javascript:void(0)" data-seek="930" title="15:30 - Next Steps">Next Steps</a></li>
    </ul>
  </div>
  <div v-else>
    <ul :class="(croute == '/aboutus') ? 'mb-0' : 'mb-8'">

      <li :class="(croute =='/ChooseDemo') ? 'hidden' : 'mb-1 block'" class="mb-1" v-if ="(croute =='/employee-benefit-resources/11-benefits-to-consider-including-in-your-employee-total-compensation-statements') || (croute =='/index.php/employee-benefit-resources/11-benefits-to-consider-including-in-your-employee-total-compensation-statements') || (croute =='/research-on-the-impact-total-compensation-statements-have-on-retention-recruitment') || (croute =='/index.php/research-on-the-impact-total-compensation-statements-have-on-retention-recruitment') || (croute =='/how-to-implement-hourly-total-comp-statements') ||
(croute =='/index.php/how-to-implement-hourly-total-comp-statements') " ><a :href="url + '/ChooseDemo'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-yellowclr font-bold inline-block" data-croute="croute">View Demo</a></li>
        <li :class="(croute =='/ChooseDemo') ? 'hidden' : 'mb-1 block'" class="mb-1" v-else><a :href="url + '/total-compensation-demo'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-yellowclr font-bold inline-block" data-croute="croute">View Demo</a></li>
        <li class="mb-1"><a :href="url + '/compensation-software/sample-total-compensation-report'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">View Sample</a></li>
        <li class="mb-1"><a :href="url + '/product-reviews'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Read Product Reviews</a></li>
        <li :class="(croute =='/compensation-software/compensation-statement-pricing') ? 'hidden' : 'mb-1 block'"><a :href="url + '/compensation-software/compensation-statement-pricing'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">View Pricing</a></li>
        <li :class="(croute == '/aboutus' || croute == '/employee-benefit-resources/employee-benefits-cost' || croute =='/compensation-software/compensation-statement-pricing' || croute =='/30day' || croute =='/employee-benefit-resources/reducing-employee-turnover' || croute =='/total-compensation-statements/large-business-benefits-software' || croute =='/total-compensation-statements/insurance-agencies-benefits-software' || croute =='/total-compensation-statements/hr-consultants-benefits-software' || croute == '/total-compensation-statements/benefits-consultants-software' || croute == '/total-compensation-statements/accounting-firms-benefits-software' || croute == '/total-compensation-statements/small-business-benefits-software' || croute == '/total-compensation-statements' || croute == '/employee-benefit-resources/employee-year-end-reports' || croute == '/employee-benefit-resources/hidden-employee-compensation-perks' || croute == '/employee-benefit-resources/employee-performance-reviews' || croute == '/employee-benefit-resources/employee-recruitment' || croute == '/employee-benefit-resources/benefit-statement-glossary' || croute == '/compensation-software/benefit-software-faq' || croute == '/employee-benefit-resources' || croute =='/ChooseDemo' || croute == '/forgotpassword') ? 'mb-1 block' : 'hidden'"><a :href="url + '/total-compensation-statements/software-purchase'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Purchase Now</a></li>
        <li :class="(croute == '/total-compensation-statements') ? 'mb-1 block' : 'hidden'"><a :href="url + '/referafriend'" class="rounded gradient-orange hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Refer a Friend</a></li>
    </ul>
    <div :class="(croute == '/compensation-software/compensation-statement-pricing') ? 'mt-3 block mb-5' : 'hidden'">
        <div class="mb-3">
          <div class="rounded-t-lg gradient-lgreen w-full text-center py-1 px-1.5 text-lg text-white font-bold inline-block">Additional Report License(s)</div>
          <div class="p-2 bg-white rounded-b-lg">
            <p class="pb-3 font-serif text-[13px] text-dgray">If you reach the employee limit for the Report Package you purchase, you can purchase additional report licenses for $20.00 per report license. The license for the additional benefit statement reports will expire on the same anniversary date as the base package.</p>
          </div>
        </div>
        <div class="mb-3">
          <div class="rounded-t-lg gradient-lgreen w-full text-center py-1 px-1.5 text-lg text-white font-bold inline-block">Upgrading Report Packages</div>
          <div class="p-2 bg-white rounded-b-lg">
            <p class="pb-3 font-serif text-[13px] text-dgray">You may, at any time during the year, upgrade your employee compensation statement package without penalty. For example, if you choose to upgrade from a 15-employee package to a 25-employee package, you would only pay the present difference between the package prices. The license for the upgraded report package will expire on the same anniversary date as the base package.)</p>
          </div>
        </div>
        <div class="">
          <div class="rounded-t-lg gradient-lgreen w-full text-center py-1 px-1.5 text-lg text-white font-bold inline-block">Multiple Report Packages</div>
          <div class="p-2 bg-white rounded-b-lg">
            <p class="pb-3 font-serif text-[13px] text-dgray">In the event that it is more convenient or cost effective to purchase more than one license package, you can purchase individual packages any time during the year. These individual employee compensation package licenses will expire 365 days after they are purchased and can be renewed on the anniversary date of their purchase.</p>
          </div>
        </div>
    </div>
    <div :class="(croute == '/aboutus') ? 'mt-3 block mb-5' : 'hidden'">
        <div class="rounded-t-lg gradient-lgreen w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Joe Blattner, Founder</div>
        <div class="p-2 bg-white rounded-b-lg">
          <img :src="url+'/images/joe-blattner.jpg'" alt="Joe Blattner" class="mb-3 mx-auto block">
          <p class="pb-3 font-serif text-[13px] text-dgray">COMPackage is a second business venture of Joseph R. Blattner and is designed to improve the recognition by employees of most any sized companies of the value of their total compensation package. COMPackage's total compensation statement software goes well beyond what other reporting services offer by vastly increasing the number of benefits or perks that can easily be reported, creating a more compelling total compensation statement.</p>
          <p class="font-serif text-[13px] text-dgray">Blattner is active in the Young Presidents Organization (YPO), and has served as Chairman and Director of the Auberle Development Corp, a home for children-at-risk near Pittsburgh. He and his wife, Jane, and two rescued dogs (Pepe & Pancho) live on a golf course community in Southwest Pennsylvania, where he currently serves as the President of the 490 resident Homeowner Association.</p>
        </div>
    </div>
    <div :class="(croute == '/employee-benefit-resources/employee-benefits-cost' || croute =='/employee-benefit-resources/reducing-employee-turnover' || croute == '/employee-benefit-resources/hidden-employee-compensation-perks') ? 'block' : 'hidden'">
      <div class="mb-5">
        <h4 class="font-bold text-lg text-white border-b border-grybclr pb-2.5 mb-2.5">Why Use Total Compensation Reports?</h4>
        <a :href="url + '/employee-benefit-resources/hidden-employee-compensation-perks'" :class="(croute == '/employee-benefit-resources/hidden-employee-compensation-perks') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">Cost of Hidden Perks</a>
        <a :href="url + '/employee-benefit-resources/employee-benefits-cost'" :class="(croute == '/employee-benefit-resources/employee-benefits-cost') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px]">Cost of Employee Benefits</a>
        <a :href="url + '/employee-benefit-resources/reducing-employee-turnover'" :class="(croute =='/employee-benefit-resources/reducing-employee-turnover') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">Reducing Employee Turnover</a>
      </div>
    </div>
    <div :class="(croute == '/total-compensation-statements/large-business-benefits-software' || croute =='/total-compensation-statements/insurance-agencies-benefits-software' || croute =='/total-compensation-statements/hr-consultants-benefits-software' || croute == '/total-compensation-statements/benefits-consultants-software' || croute == '/total-compensation-statements/accounting-firms-benefits-software' || croute == '/total-compensation-statements/small-business-benefits-software') ? 'block' : 'hidden'">
      <div class="mb-5">
        <h4 class="font-bold text-lg text-white border-b border-grybclr pb-2.5 mb-2.5">Total Benefit Statements</h4>
        <a :href="url + '/total-compensation-statements/insurance-agencies-benefits-software'" :class="(croute =='/total-compensation-statements/insurance-agencies-benefits-software') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">For Insurance Agencies</a>
        <a :href="url + '/total-compensation-statements/hr-consultants-benefits-software'" :class="(croute =='/total-compensation-statements/hr-consultants-benefits-software') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">For HR Consultants</a>
        <a :href="url + '/total-compensation-statements/benefits-consultants-software'" :class="(croute == '/total-compensation-statements/benefits-consultants-software') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">For Benefits Consultants</a>
        <a :href="url + '/total-compensation-statements/accounting-firms-benefits-software'" :class="(croute == '/total-compensation-statements/accounting-firms-benefits-software') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">For Accounting Firms</a>
        <a :href="url + '/total-compensation-statements/large-business-benefits-software'" :class="(croute =='/total-compensation-statements/large-business-benefits-software') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">For Large Businesses</a>
        <a :href="url + '/total-compensation-statements/small-business-benefits-software'" :class="(croute == '/total-compensation-statements/small-business-benefits-software') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">For Small Businesses</a>
      </div>
    </div>

    <div :class="(croute == '/employee-benefit-resources/employee-year-end-reports' || croute == '/employee-benefit-resources' || croute =='/compensation-software/sample-total-compensation-report' || croute == '/employee-benefit-resources/employee-performance-reviews' || croute == '/employee-benefit-resources/employee-recruitment' || croute == '/employee-benefit-resources/benefit-statement-glossary' || croute == '/compensation-software/benefit-software-faq' || croute == '/total-compensation-statements/sample-total-compensation-report') ? 'block' : 'hidden'">
      <div class="mb-5">
        <h4 class="font-bold text-lg text-white border-b border-grybclr pb-2.5 mb-2.5">Total Benefit Statements</h4>
        <ul>
          <li><a :href="url + '/total-compensation-demo'" :class="(croute =='/total-compensation-demo') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">View a Free Demo</a></li>
          <li><a :href="url + '/compensation-software/sample-total-compensation-report'" :class="(croute =='/compensation-software/sample-total-compensation-report') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">View a Total Compensation Statement</a></li>
          <li><a :href="url + '/compensation-software/compensation-statement-pricing'" class="block text-greenlightclr font-serif text-[13px] hover:text-white">View Pricing</a></li>
          <li><a href="javascript:void(0)" class="text-greenlightclr block font-serif text-[13px] hover:text-white">Practical uses of Employee Benefit Reports ▼</a></li>
            <ul class="pl-3 pb-2">
              <li><a :href="url + '/employee-benefit-resources/employee-year-end-reports'" :class="(croute == '/employee-benefit-resources/employee-year-end-reports') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">Year End Reports</a></li>
              <li><a :href="url + '/employee-benefit-resources/employee-performance-reviews'" :class="(croute == '/employee-benefit-resources/employee-performance-reviews') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">Employee Performance Reviews</a></li>
              <li><a :href="url + '/employee-benefit-resources/employee-recruitment'" :class="(croute == '/employee-benefit-resources/employee-recruitment') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">Employee Recruitment</a></li>
            </ul>
          <li><a :href="url + '/employee-benefit-resources/benefit-statement-glossary'" :class="(croute == '/employee-benefit-resources/benefit-statement-glossary') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">Benefit Statement Glossary</a></li>
          <li><a :href="url + '/compensation-software/benefit-software-faq'" :class="(croute == '/compensation-software/benefit-software-faq') ? 'text-white' : 'text-greenlightclr hover:text-white'" class="block font-serif text-[13px] hover:text-white">FAQ</a></li>
        </ul>
      </div>
    </div>

    <div :class="(croute == '/total-compensation-statements') ? 'block' : 'hidden'">
      <div class="mb-5">
        <h4 class="font-bold text-lg text-white border-b border-grybclr pb-2.5 mb-2.5">COMPackage Uses</h4>
        <a :href="url + '/employee-benefit-resources/employee-year-end-reports'" class="block font-serif text-greenlightclr text-sm hover:text-white">Year End Report</a>
        <a :href="url + '/employee-benefit-resources/employee-performance-reviews'" class="block font-serif text-greenlightclr text-sm hover:text-white">Employee Reviews</a>
        <a :href="url + '/employee-benefit-resources/employee-recruitment'" class="block font-serif text-greenlightclr text-sm hover:text-white">Recruitment</a>
      </div>
    </div>
    
    <div :class="(croute == '/purchase' || croute == '/total-compensation-statements/software-purchase' || croute == '/forgotpassword' || croute =='/purchaselogin') ? 'block' : 'hidden'">
      <div class="mb-5">
        <h4 :class="(croute == '/purchaselogin  ') ? 'hidden' : 'block'" class="font-bold text-lg text-white border-b border-grybclr pb-2.5 mb-2.5">Existing Users</h4>
        <h4 :class="(croute == '/purchaselogin  ') ? 'block' : 'hidden'" class="font-bold text-lg text-white border-b border-grybclr pb-2.5 mb-2.5">New Users</h4>
        <span :class="(croute == '/forgotpassword' || croute =='/purchaselogin') ? 'hidden' : 'block'"><a :href="url + '/login'" class="font-serif text-sm text-greenlightclr hover:text-white">Log In</a></span>
        <span :class="(croute == '/forgotpassword') ? 'block' : 'hidden'" class="font-serif text-sm text-greenlightclr">Welcome back</span>
        <div :class="(croute == '/purchaselogin') ? 'block' : 'hidden'">
          <div class="font-serif text-xs text-greenlightclr">Don't have a COMPackage account?</div>
          <div><a :href="url + '/total-compensation-statements/software-purchase'" class="font-serif text-xs text-greenlightclr hover:text-white">Click Here to Sign Up</a>.</div>
        </div>
      </div>
      <div class="mb-8 md:mb-16">
        <h4 class="font-bold text-lg text-white border-b border-grybclr pb-2.5 mb-2.5">Secure Order System</h4>
        <p class="font-serif text-sm text-greenlightclr">GoDaddy provides authentication and assurance to 200,000 web sites worldwide. GoDaddy leads the SSL Certificate industry as founder of the Certificate Authority/Browser Forum that developed Extended Validation (EV), the new standard in the Internet Explorer 7.0, Opera 9.5 and Firefox 3.0 browsers.</p>
      </div>
    </div>
    <div class="flex justify-center items-center flex-wrap px-12 mx-auto w-60 h-60 rounded-full bg-dgreenclr border-[6px] border-white text-2xl text-center text-white font-bold">
      <span>30 Day Money-Back Guarantee
      <a :href="url + '/30day'" class="mt-5 justify-center items-center flex text-base text-center text-white font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="text-greenlightclr h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
      </svg>Learn More</a></span>
    </div>
  </div>
</template>
<script>
    export default {
      props: [
        'pcurrent_route'
      ],
      data() {
			  return {
          croute: '',
          url: process.env.MIX_API_URL,
          currentLocation: location.href.split(process.env.MIX_API_URL)[1],
          profile: {
            name: ''
          }
			  }
		  },
      created() {
        this.croute = this.pcurrent_route.replace(this.url, '');
        //console.log(this.croute);
        this.name
      },
      methods: {
        forward(sec, id) {
            if( id == 'player' ) {
                seek(sec);
            }
            if( id == 'player1' ) {
                seek1(sec);
            }
        }
      }
    }
</script>
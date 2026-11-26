<template>
    <div>
        <!-- <button type="button" >Seek forward 30 seconds</button> -->

        <div class="flex -mx-2.5 mt-3">
            <div class="px-2.5">
                <a href="javascript:void(0);" v-on:click="showVdo = true, showVdo2 = false" :class="(showVdo == true) ?  'greenback ' : 'gradient-green' " class="cursor-pointer inline-block hover:greenback rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-md">COMPackage Hosted</a>
            </div>
            <div class="px-2.5">
                <a href="javascript:void(0);" v-on:click="showVdo = false, showVdo2 = true" :class="(showVdo2 == true) ?  'greenback ' : 'gradient-green' " class="cursor-pointer inline-block hover:greenback rounded px-3 py-1.5 leading-4 text-center gradient-green text-white font-sans font-bold text-md">COMPackage Professional</a>
            </div>
        </div>
        <div class="mt-5 flex flex-wrap" v-show="showVdo">
            <div class="w-full md:w-[65%] lg:w-3/4 gradient-brown flex items-center justify-center p-4">
                <!-- id="ytapiplayer1" -->
                <!--<iframe class="w-full lg:h-[650px] md:h-[450px] h-[300px]"  id="player" type="text/html" frameborder="0" allowfullscreen="1" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="Total Compensation Statements - Creating Total Benefit Reports Video: Compackage Online" src="https://www.youtube.com/embed/sUqTN91w6dY?enablejsapi=1"></iframe>-->
                <div class="w-full relative border-2 border-solid border-black">
                    <div class="w-full relative p-[28.1%]">
                        <iframe class="w-full h-full absolute block top-0 left-0 m-0"  id="player" type="text/html" frameborder="0" allowfullscreen="1" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="Total Compensation Statements - Creating Total Benefit Reports Video: Compackage Online" src="https://www.youtube.com/embed/61tMePQ30Eo?enablejsapi=1&playlist=61tMePQ30Eo&loop=1&autoplay=0&controls=1&rel=0"></iframe>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-[35%] lg:w-1/4 px-5 py-10 gradient-brown text-center">
                <h3 class="text-white text-xl mb-3">Video Index</h3>
                <a v-on:click="forward(0, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="0" title="00:00 - Introduction">Introduction</a>
                <a v-on:click="forward(88, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="88" title="01:28 - Product Overview">Product Overview</a>
                <a v-on:click="forward(105, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="105" title="01:45 - Add Company">Add Company</a>
                <a v-on:click="forward(110, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="110" title="01:50 - Input Company Details">Input Company Details</a>
                <a v-on:click="forward(135, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="135" title="02:15 - Identify Benefits to Include">Identify Benefits to Include</a>
                <a v-on:click="forward(242, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="242" title="04:02 - Add Employees - Intro">Add Employees - Intro</a>
                <a v-on:click="forward(281, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="281" title="04:41 - Add Employees – Bulk Loading">Add Employees - Bulk Loading</a>
                <a v-on:click="forward(353, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="353" title="05:53 - Add Employees – Manual">Add Employees - Manual</a>
                <a v-on:click="forward(416, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="416" title="06:56 - Committing Employees">Committing Employees</a>
                <a v-on:click="forward(458, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="458" title="07:38 - Auto Calculators">Auto Calculators</a>
                <a v-on:click="forward(632, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="632" title="10:32 - Customizing Benefits">Customizing Benefits</a>
                <a v-on:click="forward(695, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="695" title="11:35 - Illuminative Metrics">Illuminative Metrics<sup>TM</sup></a>
                <a v-on:click="forward(729, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="729" title="12:09 - Printing Reports">Printing Reports</a>
                <a v-on:click="forward(759, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="759" title="12:39 - Digital Delivery of Reports">Digital Delivery of Reports</a>
                <a v-on:click="forward(859, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="859" title="14:19 - Hourly Top Box Scores">Hourly Top Box Scores</a>
                <a v-on:click="forward(900, 'player')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="900" title="15:00 - Next Steps">Next Steps</a>
            </div>                    
        </div>

        <div class="mt-5 flex flex-wrap" v-show="showVdo2">
            <div class="w-full md:w-[65%] lg:w-3/4 gradient-brown flex items-center justify-center p-4">
                <!--<iframe class="w-full lg:h-[650px] md:h-[450px] h-[300px]" id="player1" frameborder="0" allowfullscreen="1" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="Total Compensation Statements - Creating Total Benefit Reports: Compackage Online Professional" src="https://www.youtube.com/embed/PQL4VuvlOjw?enablejsapi=1"></iframe>-->
                <div class="w-full relative border-2 border-solid border-black">
                    <div class="w-full relative p-[28.1%]">
                        <iframe class="w-full h-full absolute block top-0 left-0 m-0" id="player1" frameborder="0" allowfullscreen="1" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="Total Compensation Statements - Creating Total Benefit Reports: Compackage Online Professional" src="https://www.youtube.com/embed/9wnRNYYRHHQ?enablejsapi=1&playlist=9wnRNYYRHHQ&loop=1&autoplay=0&controls=1&rel=0"></iframe>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-[35%] lg:w-1/4 px-5 py-10 gradient-brown text-center">
                <h3 class="text-white text-xl mb-3">Video Index</h3>
                <a v-on:click="forward(0, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="0" title="00:00 - Introduction">Introduction</a>
                <a v-on:click="forward(113, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="113" title="01:53 - Product Overview">Product Overview</a>
                <a v-on:click="forward(134, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="134" title="02:14 - Add Company">Add Company</a>
                <a v-on:click="forward(141, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="141" title="02:21 - Input Company Details">Input Company Details</a>
                <a v-on:click="forward(167, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="167" title="02:47 - Identify Benefits to Include">Identify Benefits to Include</a>
                <a v-on:click="forward(274, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="274" title="04:34 - Add Employees - Intro">Add Employees - Intro</a>
                <a v-on:click="forward(312, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="312" title="05:12 - Add Employees – Bulk Loading">Add Employees - Bulk Loading</a>
                <a v-on:click="forward(384, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="384" title="06:24 - Add Employees – Manual">Add Employees - Manual</a>
                <a v-on:click="forward(447, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="447" title="07:27 - Committing Employees">Committing Employees</a>
                <a v-on:click="forward(490, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="490" title="08:10 - Auto Calculators">Auto Calculators</a>
                <a v-on:click="forward(663, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="663" title="11:03 - Customizing Benefits">Customizing Benefits</a>
                <a v-on:click="forward(727, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="727" title="12:07 - Illuminative Metrics">Illuminative Metrics<sup>TM</sup></a>
                <a v-on:click="forward(760, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="760" title="12:40 - Printing Reports">Printing Reports</a>
                <a v-on:click="forward(791, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="791" title="13:11 - Digital Delivery of Reports">Digital Delivery of Reports</a>
                <a v-on:click="forward(891, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="891" title="14:51 - Hourly Top Box Scores">Hourly Top Box Scores</a>
                <a v-on:click="forward(930, 'player1')" class="seek-button-2 cursor-pointer mb-2 inline-block hover:gradient-green rounded px-3 md:px-2 lg:px-3 py-3 leading-4 text-center greenback text-white font-sans font-bold text-md w-full" href="javascript:void(0)" data-seek="930" title="15:30 - Next Steps">Next Steps</a>
            </div>                    
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: process.env.MIX_API_URL,
            viewLoader: false,
            showVdo: false,
            showVdo2: false,
        }
    },
    created() {},
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
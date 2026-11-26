<template>
  <div>
    <div class="relative pt-10">
      <img :src="url + '/images/best-value-lol.png'" alt="" class="hidden md:block z-10 absolute top-0 right-36" />
      <div class="relative overflow-x-auto md:overflow-visible" id="PriceList">
        <table class="border border-black w-full text-sm text-left text-black">
          <thead class="text-xs text-white uppercase bg-greendarkclr">
            <tr>
              <th scope="col" class="px-2 py-3">Report Packages</th>
              <th scope="col" class="px-2 py-3">1 Year</th>
              <th scope="col" class="px-2 py-3">2 Years (20% off)†</th>
              <th scope="col" class="px-2 py-3">3 Years (33% off)†</th>
              <th scope="col" class="px-2 py-3">4 Years (40% off)†</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="purchaseTbl in pplansbyyear" class="border-b border-black odd:bg-white even:bg-lghtgreen">
              <td scope="row" data-label="" class="px-2 py-2" :value="purchaseTbl[0].id">{{ purchaseTbl[0].name }}</td>
              <td scope="row" data-label="" class="cursor-pointer relative text-center px-2 py-2" v-on:click="change(purchaseTbl[0].id, prchyear.id)" v-for="prchyear in purchaseTbl" :value="prchyear.id" v-on:mouseleave="action = false" v-on:mouseover="action = prchyear.id"><span v-show="action === prchyear.id" class="left-1/2 -translate-x-2/4 -top-5 absolute bg-slate-700 text-white border-2 border-black w-40 rounded" v-if="prchyear.year > 1"><span v-if="prchyear.year == 2">That's </span><span v-if="prchyear.year == 3">Best Value! </span><span v-if="prchyear.year == 4">Only per year </span><span>{{ Math.floor ((prchyear.price) / (prchyear.year)) }} per year</span><div class="absolute left-1/2 -translate-x-2/4 -bottom-2 w-3 h-3 -mt-2 rotate-45 bg-slate-700"></div></span><span>${{ prchyear.price }}</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="text-xs text-black">* Additional reports available at $20 each.</div>

    
    <!-- Loader -->
    <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
        <img :src="url + '/images/com-loader.gif'" alt=""
            class="loader-img top-[50%] right-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
    </div>
  </div>
</template>
<script>
export default {
  props: ['pplansbyyear'],
  data() {
    return {
      url: process.env.MIX_API_URL,
      action: false,
      plans: {},
      error: '',
      viewLoader: false,
    }
  },
  created() {

  },
  methods: {

  }
}
</script>
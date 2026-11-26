<template>
    <div>
        <h3 class="text-greenlightclr text-2xl font-bold">The World's First</h3>
        <h4 class="text-white text-4xl font-bold">Easy-to-Use<br>Total Compensation Statements</h4>
        <div  :class="(croute == '/total-compensation-demo') ? 'hidden' : 'block'">
          <ul class="mt-5 mb-8">
              <li class="mb-1"><a :href="url + '/product-reviews'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Read Product Reviews</a></li>
              <li class="mb-1"><a :href="url + '/compensation-software/sample-total-compensation-report'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">View Sample</a></li>
              <li class=""><a :href="url + '/total-compensation-demo'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">View Demo</a></li>
          </ul>
        </div>
        <div :class="(croute == '/total-compensation-demo') ? 'mt-3 block mb-5' : 'hidden'">
        <ul>
          <li class="mb-1"><a :href="url + '/total-compensation-demo'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-yellowclr font-bold inline-block">View Demo</a></li>
          <li class="mb-1"><a :href="url + '/compensation-software/sample-total-compensation-report'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">View Sample</a></li>
          <li class="mb-1"><a :href="url + '/product-reviews'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Read Product Reviews</a></li>
          <li class="mb-1"><a :href="url + '/compensation-software/compensation-statement-pricing'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">View Pricing</a></li>
          <li class=""><a :href="url + '/total-compensation-statements/software-purchase'" class="rounded gradient-lgreen hover:gradient-green hover:text-white w-full text-center py-1 px-2.5 text-lg text-white font-bold inline-block">Purchase Now</a></li>
        </ul>
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
        
      }
    }
</script>
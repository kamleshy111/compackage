<script setup>
import { ref } from "vue";

const props = defineProps({
  archive_options: {
    type: Array,
    required: false,
  },
});

var value1 = '';
if(location.pathname && location.pathname.split('/').length > 3) {
  value1 = location.pathname.split('/').slice(2,4).join('/')
}
const selected_option = ref(value1);

const redirectToPage = () => {
  if (selected_option.value) {
    location.href = '/archive/'+ selected_option.value;
  }
};
</script>
<template>
  <h2
    class="widgettitle text-white text-lg font-bold border-b border-[#7e7373] pt-4 pb-1 mb-5 font-[Roboto_Condensed,Arial,sans-serif]">
    Archives</h2>
  <select v-model="selected_option" @change="redirectToPage"
    class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control">
    <option value="">Select Month</option>
    <option v-for="(label, key) in archive_options" :key="key" :value="key">
      {{ label }}
    </option>
  </select>
</template>
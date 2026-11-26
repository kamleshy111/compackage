<script setup>
import { ref, onMounted } from "vue";

const categories = ref([]);
const error = ref(null);

const fetchPosts = async () => {
  try {

    const response = await fetch("https://blog.compackage.com/wp-json/wp/v2/categories?per_page=100&hide_empty=true");
    const data = await response.json();
    categories.value = data;
  } catch (err) {
    error.value = "Failed to fetch categories.";
  }
};

onMounted(fetchPosts);
</script>

<template>
    <h2 class="widgettitle text-white text-lg font-bold border-b border-[#7e7373] pt-4 pb-1 mb-5 font-[Roboto_Condensed,Arial,sans-serif]">
  Categories</h2>
  
    <ul class="wid-page-class-1" style="padding: 0;" v-if="categories.length">
      <li v-for="category in categories" :key="category.id" class="" style="font-family: Arial;">
        <a :href="`/category/${category.slug}`" class="text-[13px] text-[#8ac33f] no-underline hover:text-white">{{ category.name }}</a>
      </li>
    </ul>

</template>
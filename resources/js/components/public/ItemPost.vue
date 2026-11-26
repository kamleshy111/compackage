<script setup>
import { defineProps } from "vue";
import { ref, onMounted } from "vue";
const props = defineProps(['slug', 'search_query', 'posts', ])
const search = (props.search_query);
const posts = (props.posts);
const error = ref(null);

console.log('Props:', props);
console.log('Search Query:', search);

</script>

<template>

  <h1 v-if="search">Search Results for "{{ search }}"</h1>

  <div v-if="posts.length > 0">
    <div v-for="post in posts" :key="post.id">
      <a :href="`/blog/${post.slug}`">
      <component 
        :is="slug ? 'h1' : 'h2'" 
        v-html="post.title.rendered" class="text-[23px] text-[#098046] font-bold no-underline leading-normal font-['Roboto Condensed', Arial] hover:text-[#16622e]">
      </component>
      </a>
      <p class="postauthor main-scop-1" v-html="'by '+post.author_name"></p>
     <div v-html="post.content.rendered"></div>
    </div>
  </div>

  <div v-else-if="error">{{ error }}</div>

  
  <div v-else-if="search && posts.length === 0">
      <h2>No Results.</h2>
      <p>Please feel free try again using the form in the sidebar of the page..</p>
    </div>
</template>



<style>
    .form-control::placeholder {
    color: #000;
}
</style>
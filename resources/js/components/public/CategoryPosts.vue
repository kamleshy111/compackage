<script setup>
import { defineProps } from 'vue';
const props = defineProps(['slug', 'posts', 'category_name']);

const posts = JSON.parse(props.posts);
const category_name = props.category_name;

function format_date(date1) {
    var date = new Date(date1);

    const formattedDate = date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
    return formattedDate;
}

function getPostCategory(post) {
  return post._embedded['wp:term'][0].map((category) => '<a href="' + category.link + '">' + category.name + '</a>' ).join(", ");
}

</script>

<template>
  <h1>Archive for the ‘{{ category_name }}’ Category</h1>
  <ul v-if="posts.length" class="main-2-class-1">
    <li v-for="post in posts" :key="post.id" class="main-sec-1-2">
      <a :href="`/blog/${post.slug}`">
        <h2 class="main-clas-cont-1">{{ post.title.rendered }}</h2>
      </a>
      <p class="postauthor main-scop-1" v-html="'by '+ post.author_name + ' | '+ format_date(post.date)"></p>
      
      <div v-html="post.content.rendered"></div>
      <p class="postauthor main-scop-1" v-html="'Comments Off on '+ post.title.rendered"></p>
      <div class="postmeta">
        <p v-html="'Category: '+ getPostCategory(post)"></p>
      </div>
    </li>
  </ul>
</template>

<style>
.content-post ul li div h2 {
    color: #16622e;
    font-size: 20px;
}
</style>
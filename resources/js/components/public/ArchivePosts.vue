<script setup>
const props = defineProps(['slug', 'posts', 'month_year']);
const posts = JSON.parse(props.posts);
const month_year = props.month_year;

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
    <div class="content-1 same-class-2">
        <div class="content-post content-mains-1">
            <h1>Archive for the {{ month_year }}</h1>
            <ul v-if="posts.length" class="main-2-class-1">
                <li v-for="post in posts" :key="post.id" class="main-sec-1-2">
                    <a :href="`/blog/${post.slug}`">
                        <h2 class="main-clas-cont-1">{{ post.title.rendered }}</h2>
                    </a>
                    <p class="postauthor" v-html="'by '+ post.author_name"></p>
                    <div v-html="post.content.rendered"></div>
                    <div class="postmeta">
                        <p v-html="'Category: '+ getPostCategory(post)"></p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<style>
.content-post h1 {
    font-size: 30px;
    border-bottom: 1px solid #d9d9d9;
    color: #16622e;
    font-family: "Roboto Condensed", Arial;
    padding: 0px 0px 20px;
    margin: 0px 0px 20px;
    font-weight: bold;
}

.content-post h4 {
    font-size: 16px !important;
    font-weight: 700 !important;
}

.content-post h2 {
    color: #098046;
    font-family: "Roboto Condensed", Arial;
    font-weight: bold;
    font-size: 22px;
    margin: 30px 0px 15px;
    line-height: 30px;
}

.content-post p {
    color: #353535;
    font-size: 13px;
    margin: 0px 0px 12px;
    font-family: Arial !important;
}

.main-2-class-1 {
    margin: 0 !important;
}

.content-post ul {
    font-size: 12px;
    margin: 0px 0px 0px 30px;
    font-family: Arial;
}

.content-post ul li {
    list-style: disc;
    padding: 0px 0px 5px;
    vertical-align: top;
    line-height: 16px;
    font-size: 13px;
    color: #353535;
}

.content-post ol {
    margin: 0px 0px 0px 30px;
    list-style: decimal;
    font-family: Arial;
}

.content-post ol li {
    font-size: 12px;
    padding: 0px 0px 10px;
    line-height: 16px;
}

.content-post p a {
    color: #098046;
    text-decoration: none;
}

.content-mains-1 .main-clas-cont-1 {
    list-style: none;
    line-height: normal;
}

.main-sec-1-2 {
    list-style: none !important;
    margin: 0px 0px 0px 0px !important;
}

.content-post a h2 {
    font-size: 28px;
    color: rgb(22 98 46);
}

.content-post a:hover h2 {
    color: #098046;
}

</style>
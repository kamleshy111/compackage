<script setup>
import { ref } from "vue";

const searchQuery = ref("");
const baseURL = "/blog";


const searchPosts = (event) => {
    event.preventDefault();

    if (!searchQuery.value.trim()) {
        alert("Please enter a search query");
        return;
    }

    window.location.href = `${baseURL}?s=${encodeURIComponent(searchQuery.value)}`;
};
</script>
<template>

    <h2 class="widgettitle widgettitle text-white text-lg font-bold border-b border-[#7e7373] pt-4 pb-1 mb-5 font-[Roboto_Condensed,Arial,sans-serif]">Search</h2>
    <form @submit="searchPosts">
        <input type="text" v-model="searchQuery" placeholder="Search Blog" class="top-search-box focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control"><br>
        <input type="submit" class="lime-grad gradient searchsubmit" value="Search">
    </form>

</template>
<style>
#searchtext {
    margin-bottom: 7px;
    width: 180px;
    border: none;
    padding: 6px 10px 6px 4px;
    border-radius: 3px;
    font-size: 16px;
}
.lime-grad.gradient.searchsubmit {
    background: #a1d167;
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ExZDE2NyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3NWE1M2IiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
    background: linear-gradient(to bottom,  #a1d167 0%,#75a53b 100%);
    margin: 0px;
    padding: 3px 10px;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-family: "Roboto Condensed";
    font-size: 18px;
    font-weight: 800;
    -webkit-text-stroke: #fff;
}
.top-search-box {
    margin-bottom: 7px;
    width: 180px;
    border: none;
    padding: 6px 10px 6px 4px;
    border-radius: 3px;
    font-size: 16px;
}
</style>
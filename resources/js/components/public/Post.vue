<script>
export default {
  props: {
    slug: String,
    search_query: String,
    posts: Array,
    pagination: Object,
  },
  data() {
    return {
      postList: this.posts,
      currentPage: this.pagination.current_page,
      lastPage: this.pagination.last_page,
      isLoading: false,
    };
  },
  methods: {
    // ✅ Limit text to 100 words
    truncateText(text, wordLimit = 100) {
      if (!text) return '';

      // ✅ Keep <img>, <p>, <strong>, <em>, <ul>, <li>
      const temp = text.replace(/<(?!img|p|strong|em|ul|li)[^>]*>/g, '').trim();

      const words = temp.split(/\s+/);
      return words.length > wordLimit
        ? words.slice(0, wordLimit).join(' ') + ' [...]'
        : temp;
    },

    // ✅ AJAX pagination
    async changePage(page) {
      if (page < 1 || page > this.lastPage) return;
      this.isLoading = true;

      const params = new URLSearchParams({
        page,
        s: this.search_query || '',
        slug: this.slug || ''
      });

      try {
        const res = await fetch(`/api/ajax/posts?${params.toString()}`);
        const json = await res.json();

        this.postList = json.data;
        this.currentPage = json.current_page;
        this.lastPage = json.last_page;
        window.scrollTo({ top: 0, behavior: 'smooth' });
        window.history.pushState({}, '', `?page=${page}`);
      } catch (e) {
        console.error("Error fetching posts:", e);
      } finally {
        this.isLoading = false;
      }
    },

    // ✅ Safely get featured image
    getFeaturedImage(post) {
      if (
        post._embedded &&
        post._embedded['wp:featuredmedia'] &&
        post._embedded['wp:featuredmedia'][0] &&
        post._embedded['wp:featuredmedia'][0].source_url
      ) {
        return post._embedded['wp:featuredmedia'][0].source_url;
      }
      return '/images/no-image.jpg'; // fallback image
    }
  }
};
</script>

<template>
  <div v-if="lastPage == 1" class="pagination">
    <div class="content-1-item DWS">
      <!-- Loader -->
      <div v-if="isLoading" class="loader">
        <div class="spinner"></div>
        <p>Loading posts...</p>
      </div>

      <div v-else>
        <div class="content-post">
          <div v-for="post in postList" :key="post.id" class="post-item">
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
      </div>
    </div>
  </div>
  <div v-else>
    <div class="content-1-item DWS">
      <!-- Loader -->
      <div v-if="isLoading" class="loader">
        <div class="spinner"></div>
        <p>Loading posts...</p>
      </div>

      <div v-else>
        <div class="content-post">
          <div v-for="post in postList" :key="post.id" class="post-item">
            <a :href="`/blog/${post.slug}`">
            <component 
              :is="slug ? 'h1' : 'h2'" 
              v-html="post.title.rendered" class="text-[23px] text-[#098046] font-bold no-underline leading-normal font-['Roboto Condensed', Arial] hover:text-[#16622e]">
            </component>
            </a>
            <p class="postauthor main-scop-1" v-html="'by '+post.author_name"></p>
            <!-- <p v-html="truncateText(post.content.rendered)"></p> -->
            <!-- <p v-html="post.content.rendered"></p> -->
            <div v-html="truncateText(post.content.rendered)"></div>
            <a :href="`/blog/${post.slug}`" class="text-[#16622e] hover:text-[#098046] font-bold">Read More</a>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="lastPage > 1" class="pagination">
          <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1">
            Prev
          </button>

          <span>Page {{ currentPage }} of {{ lastPage }}</span>

          <button @click="changePage(currentPage + 1)" :disabled="currentPage === lastPage">
            Next
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* ✅ Loader */
.loader {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px 0;
}
.spinner {
  border: 4px solid #eee;
  border-top: 4px solid #098046;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* ✅ Post styling */
.post-item {
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 1px solid #ddd;
}
.post-thumb img {
  width: 100%;
  max-height: 250px;
  object-fit: cover;
  margin-bottom: 10px;
  border-radius: 5px;
}
.post-item h3 {
  font-size: 18px;
  margin-bottom: 6px;
}
.post-item p {
  color: #555;
  font-size: 14px;
}

/* ✅ Pagination */
.pagination {
  margin-top: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
}
.pagination button {
  background-color: #098046;
  color: white;
  border: none;
  border-radius: 3px;
  padding: 8px 14px;
  cursor: pointer;
}
.pagination button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
.alignright {
    float: right;
}
.content-1-item p {
    color: #353535;
    font-size: 13px;
    margin: 0px 0px 12px;
    font-family: Arial !important;
}
.content-1-item ul {
     font-size: 12px;
    margin: 0px 0px 0px 30px;
    font-family: Arial;
}
.content-1-item ul li {
    list-style: disc;
    padding: 0px 0px 5px;
    vertical-align: top;
    line-height: 16px;
    font-size: 13px;
    color: #353535;
}
.main-scop-1 {
    margin-top: 20px !important;
}
.content-1-item ol {
    margin: 0px 0px 0px 30px;
    list-style: decimal;
    font-family: Arial;
}
.content-1-item ol li {
    font-size: 12px;
    padding: 0px 0px 10px;
    line-height: 16px;
}
.content-1-item p a {
    color: #098046;
    text-decoration: none;
}
</style>
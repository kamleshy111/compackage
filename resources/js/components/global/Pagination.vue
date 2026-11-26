<template>
    <nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
        <div class="bg-white mt-5 px-2 py-3 flex items-center justify-between sm:px-1">
            <div class=" sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">{{pagination.from}}</span> to <span class="font-medium">{{pagination.to}}</span> of <span class="font-medium">{{pagination.total}}</span> results
                    </p>
                </div>
                <div>
                    <!-- -space-x-px -->
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm " aria-label="Pagination">
                        <a href="javascript.void(0)" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1" :class="(pagination.current_page <= 1) ? 'cursor-not-allowed' : 'cursor-pointer' "  class="relative inline-flex items-center px-1.5 py-1.5 rounded-l-md border border-gray-300 bg-white text-[16px] font-medium text-gray-500 hover:bg-green-50 hover:border-[#1b6632] hover:text-[#1b6632]">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        </a>

                        <a v-for="page in pages" href="javascript.void(0)" :class="isCurrentPage(page) ? 'cursor-not-allowed bg-green-50 border-[#1b6632] text-[#1b6632] ' : 'text-black-600 hover:bg-green-50 hover:border-[#1b6632] hover:text-[#1b6632]'" @click.prevent="changePage(page)" class="z-10 relative inline-flex items-center px-4 py-2 border text-[18px] leading-4 font-medium">
                            {{ page }}
                        </a>
                        
                        <a href="javascript.void(0)" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page" :class="(pagination.current_page >= pagination.last_page) ? 'cursor-not-allowed' : 'cursor-pointer' " class="relative inline-flex items-center px-1.5 py-1.5 rounded-r-md border border-gray-300 bg-white text-[16px] font-medium text-gray-500 hover:bg-green-50 hover:border-[#1b6632] hover:text-[#1b6632]">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>

    <!-- <div class="mt-5 footer-pagination">
        <ul class="flex justify-end items-center w-full text-[15px]">
            <li class="mr-3">
                <a href="javascript:void(0);">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                        </svg>
                        <span>Prev</span>
                    </span>
                </a>
            </li>
            <li>
                <a class="hover:bg-[#0e5925] hover:text-[#fff] hover:border-[#0e5925] border-r-0 border border-[#b9b9b9] inline-block text-center leading-[28px] w-8 h-7" href="javascript:void(0);">
                    <span>1</span>
                </a>
            </li>
            <li>
                <a class="hover:bg-[#0e5925] hover:text-[#fff] hover:border-[#0e5925] border border-[#b9b9b9] inline-block text-center leading-[28px] w-8 h-7" href="javascript:void(0);">
                    <span>2</span>
                </a>
            </li>
            <li>
                <a class="hover:bg-[#0e5925] hover:text-[#fff] hover:border-[#0e5925] border-l-0 border border-[#b9b9b9] inline-block text-center leading-[28px] w-8 h-7" href="javascript:void(0);">
                    <span>3</span>
                </a>
            </li>
            <li class="ml-3">
                <a href="javascript:void(0);">
                    <span class="flex items-center">
                        <span>Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </span>
                </a>
            </li>      
        </ul>
    </div> -->
</template>

<script>
    export default {
        props: ['pagination', 'offset', 'paginate'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                if(this.isCurrentPage(page)) {
                    return;
                }

                this.pagination.current_page = page;

                this.paginate(false, this.pagination.current_page);

            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);

                // Set default page to 1
                if (from < 1) {
                    from = 1;
                }

                // set to
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                // fix: sometimes page number reduce to 10: 7 8 9 10 but it should be 6 7 8 9 10
                if( this.pagination.last_page >= this.offset && ( this.offset - 1 ) > (parseInt(to) - parseInt(from)) ) {
                    from = to - (this.offset - 1);
                }

                // Creatting page number
                while (from <= to) {
                    pages.push(from);
                    from++;
                }

                return pages;
            }
        }
    }
</script>
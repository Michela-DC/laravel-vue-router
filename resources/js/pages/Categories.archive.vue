<template>
    <div class="container py-12">
        <!-- pagina archivio della categoria -->

        <h1 v-if="category" class="pb-6 uppercase font-bold text-2xl text-center"> {{ category.name }} </h1>

        <div class="card-container grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 flex gap-8 py-5">
            <div class="card-body bg-slate-300 rounded-md overflow-hidden shadow-md shadow-slate-500" 
            tag="li" v-for="post in posts" :key="post.id">
                <figure class="img-wrapper">
                    <img src="https://picsum.photos/450/250" class="w-full object-cover" alt="">
                </figure>
                
                <div class="card-content p-5">
                    <ul class="pb-5">
                        <li>
                            <span class="font-bold">Title: </span> 
                            {{post.title}}
                        </li>
                    </ul>

                    <router-link :to="{name: 'posts.show', params: {slug:post.slug} }" 
                    class="bg-amber-500 rounded-md px-3 py-1 text-md text-white hover:bg-orange-500" 
                    tag="button">
                        Read full post
                    </router-link>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        
        data() {
            return {
                category: null,
                posts: [],
            }
        },

        methods: {

            fetchPostsByCategorySlug () {

                axios.get(`/api/categories/${ this.$route.params.slug }/posts`)
                .then( res =>{
                    const {posts, category} = res.data;
                    //posso passargli sia posts che category perché nella risposta json ho passato i parametri 'category' => $category e 'posts' => $category->posts,
                    
                    this.posts = posts;
                    this.category = category;

                })
                .catch( error => {
                    console.warn(error);
                }) 

            },
        },

        beforeMount() { //in questo caso potevo chiamre la funzione anche nel mount
            this.fetchPostsByCategorySlug();
        }

    }
</script>

<style lang="scss" scoped>

</style>
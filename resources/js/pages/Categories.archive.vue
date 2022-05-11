<template>
    <div>
        <!-- pagina archivio della categoria -->
        <h1 v-if="category"> {{ category.name }} </h1>
        <ul class="flex flex-col items-start">
            <router-link tag="li" v-for="post in posts" :key="post.id" 
            :to="{name: 'posts.show', params: {slug:post.slug} }" 
            class="cursor-pointer py-4 hover:text-orange-300">
                Post title:  {{post.title}}
            </router-link>
        </ul>
        <!-- {{ posts.length }} -->
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

            }
        },

        beforeMount() { //in questo caso potevo chiamre la funzione anche nel mount
            this.fetchPostsByCategorySlug();
        }

    }
</script>

<style lang="scss" scoped>

</style>
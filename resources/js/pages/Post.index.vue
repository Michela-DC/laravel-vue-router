<template>
    <div class="container grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 flex gap-8 py-12">
        <PostCard v-for="post in posts" :key="post.id" :post="post"/>
        <!-- :post="post" mi serve per collegarlo al props in PostCard -->

        <div class="container py-8">
            <ul class="pagination flex justify-center gap-4">
                <!-- assegno il colore a seconda del se è la pagina attiva o no -->
                <li @click="fetchPosts(n)" :class="[currentPage === n ? 'bg-amber-400' : 'bg-white', 'cursor-pointer rounded-full h-10 w-10 flex items-center justify-center text-center']" v-for="n in lastPage" :key="n">{{ n }}</li>
                <!-- quando clicco va a chiamare la funzione fetchPosts a cui passo un nuovo parametro per recuperare la pagina (il parametro n è quello che ho usato per ciclare e stampare i numeri delle pagine) -->
            </ul>
        </div>
    </div>
</template>

<script>
import PostCard from '../components/PostCard.vue'

    export default {
        components: {
            PostCard,
        },

        data() {
            return {
                posts: [],
                lastPage: 0,
                currentPage: 0,
            }
        },

        methods: {
            fetchPosts(page = 1) { //di default la pagina che recupera è la 1

                //gli passo la rotta che ho creato per i post del front-office
                axios.get('/api/posts',{
                    params: { //gli passo il parametro page
                        page
                    }
                }) 
                .then( res => {

                    const {posts} = res.data;
                    const {data, last_page, current_page} = posts;
                    // console.log(res.data.posts.current_page);

                    this.posts = data;
                    this.currentPage = current_page;
                    this.lastPage = last_page;

                })
                .catch( error => {
                    console.warn(error);
                })
            }
        },

        mounted() {
            // una volta montato il componente, verrà chiamata la funzione che fa l'axios.get
            this.fetchPosts();
        }

    }
</script>

<style lang="scss" scoped>

</style>
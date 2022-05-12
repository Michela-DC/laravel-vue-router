<template>
    <!-- solo quando loading è diverso da false, quindi la chiamata avrà già ricevuto il post, allora avrò la visualizzaione del post -->
    <!-- oppure potevo anche fare v-if=post -->
    <div v-if="!loading" class="slug container my-12 rounded-md bg-slate-200 overflow-hidden shadow-lg shadow-slate-500">
        <img src="https://picsum.photos/850/350" class="w-full object-cover" alt="">

        <div class="container post-content p-10">
            <h1 v-if="post" class="pb-4">
                <span class="font-bold">Title: </span> 
                {{ post.title }}
            </h1>

            <p v-if="post.category">
                <span class="font-bold">Category: </span>
                {{ post.category.name }}
            </p>

            <ul class="tags pb-4 flex gap-1">
                <li v-for="tag in post.tags" :key="tag.id" class="flex gap-3 italic tag bg-cyan-200 text-blue-900 text-xs rounded-full px-3 py-1">
                    {{ tag.name }}
                </li>
            </ul>

            <p v-if="post"> {{ post.content }}}</p>
        </div>
    </div>

</template>

<script>
import axios from 'axios'

export default {
    
    data() {
        return {
            post: null, //la chiamata axios salva qui il post che recupero tramite slug
            loading: true,
        }
    },

    methods: {
        fetchPost() {
            // la rotta di questa pagina deve fare una chiamata axios al server per recuperare il singolo post, ha però bisogno di ricevere lo slug per chimare un dato post
            // per recuperare lo slug posso sfruttare una proprietà che hanno tutti i componenti, ovvero la proprietà $route, che contiene tutte le informazioni della rotta corrente,
            // $route ha una chiave params all'interno del quale trovo lo slug 
            axios.get(`/api/posts/${ this.$route.params.slug }`)
            .then(res => {
                const { post } = res.data;

                this.post = post;
                this.loading = false; 
                //se ha finito di caricare eh ha ricevuto il post allora loading diventa true
            })
            .catch( err => {
                console.warn( err );

                // redirect to 404 page
                // Inside of a Vue instance, you have access to the router instance as $router. You can therefore call this.$router.push.
                // in pratica this.$router è il const router che ho istanziato in index.js
                this.$router.pish('/404'); 
                //quindi nella pagina 404 ci finirò anche nel caso in cui non abbia ricevuto una risposta positiva dal server

            }) // il catch viene intercettato perchè nel controller, nella chiamata json, ho specificato l'errore 404
            //se non specificassi il 404 e non mettessi niente allora il catch non verebbe eseguito perchè axios vedrebbe una risposta 200, quindi una chiamata andata a buon fine
        }
    },

    beforeMount() {
        this.fetchPost();
    }   

}
</script>

<style lang="scss" scoped>
</style>
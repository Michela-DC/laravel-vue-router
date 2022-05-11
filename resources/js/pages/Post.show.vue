<template>
  <div class="py-8">
      <div class="slug">Slug: {{ $route.params.slug }}</div>
      <!-- post l'ho inizializzato come nullo quindi vue cercherà di accedere a qualcosa che inizialmente è null.
       Per risolvere vue deve ricevere la risposta prima di stamparlo altrimenti avrò errore.
       Faccio quindi un v-if per dirgli di stampare solo quando ho effettivamente post -->
      <h1 v-if="post">Title: {{ post.title }}</h1>
      <p v-if="post"> {{ post.content }}}</p>
  </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            post: null, //la chiamata axios salva qui il post che recupero tramite slug
        }
    },

    beforeMount() {
        // la rotta di questa pagina deve fare una chiamata axios al server per recuperare il singolo post, ha però bisogno di ricevere lo slug per chimare un dato post
        // per recuperare lo slug posso sfruttare una proprietà che hanno tutti i componenti, ovvero la proprietà $route, che contiene tutte le informazioni della rotta corrente,
        // $route ha una chiave params all'interno del quale trovo lo slug 
        axios.get(`/api/posts/${ this.$route.params.slug }`)
        .then(res => {
            const { post } = res.data;
            this.post = post;
        })
        .catch( err => {
            console.warn( err );
        })
    }

}
</script>

<style lang="scss" scoped>
</style>
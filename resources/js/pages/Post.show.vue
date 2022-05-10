<template>
  <div class="py-8">
      {{ $route.params.slug }}
  </div>
</template>

<script>
import axios from 'axios'

export default {
    beforeMount() {
        // la rotta di questa pagina deve fare una chiamata axios al server per recuperare il singolo post, ha però bisogno di ricevere lo slug per chimare un dato post
        // per recuperare lo slug posso sfruttare una proprietà che hanno tutti i componenti, ovvero la proprietà $route, che contiene tutte le informazioni della rotta corrente,
        // $route ha una chiave params all'interno del quale trovo lo slug 
        axios.get(`/api/posts/${ this.$route.params.slug }`)
    }

}
</script>

<style lang="scss" scoped>
</style>
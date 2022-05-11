import { post } from 'jquery';
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Posts from '../pages/Post.index.vue'
import Post from '../pages/Post.show.vue'

//definisco l'array di rotte
const routes = [
    {
        path: '/posts',
        name: 'posts.index',
        component: Posts
    },
    {   
        //rotta per mostrare la pagina di dettaglio del singolo post
        // nel front-office per per recuperare il singolo post posso usare il suo slug, quindi lo passo come parametro alla rotta
        path: '/posts/:slug' ,
        name: 'posts.show',
        component: Post
    }
];

//creo l'istanza del router
const router = new VueRouter({
    mode: 'history', //modalità in cui andrà a mostrare la rotta
    routes: routes //array di rotte
});

//esporto l'istanza del router che importerò in front.js
export default router;

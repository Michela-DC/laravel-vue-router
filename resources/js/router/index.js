import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//definisco l'array di rotte
const routes = [ 
];

//creo l'istanza del router
const router = new VueRouter({
    mode: 'history', //modalità in cui andrà a mostrare la rotta
    routes: routes //array di rotte
});

//esporto l'istanza del router che importerò in front.js
export default router;
<template>
    <div class="app-container bg-slate-400 h-screen overflow-y-auto">
        <header>
            <nav class="py-6 flex bg-slate-300">
                <div class="container">
                    <li class="uppercase hover:text-orange-500">
                        <!-- use router-link component for navigation.
                        Posso usarlo passando al to solo il path della rotta:
                        <router-link to="/posts">Posts</router-link> 
                        oppure posso passargli il nome della rotta:  -->
                        <router-link class="font-bold text-red-500" :to="{ name: 'posts.index' }">Show all Posts</router-link>
                        <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
                    </li>
                </div>
            </nav>
        </header>

        <!-- <PostGrid /> non serve più, ma al suo posto ci va: -->
        <!-- route outlet -->
        <!-- component matched by the route will render here -->
        <router-view></router-view>

        <footer>
            &copy; Boolpress!
        </footer>
    </div>
</template>

<script>
import PostGrid from '../pages/Post.index.vue';

export default {
    components: {
        PostGrid,
    }
}
</script>

<style>

</style>
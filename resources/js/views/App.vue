<template>
    <div class="app-container bg-slate-500">
        <header>
            <nav class="py-6 flex gap-4 bg-slate-300">
                <li>
                    <!-- use router-link component for navigation.
                    Posso usarlo passando al to solo il path della rotta:
                    <router-link to="/posts">Posts</router-link> 
                    oppure posso passargli il nome della rotta:  -->
                    <router-link :to="{ name: 'posts.index' }">Posts</router-link>
                    <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
                </li>
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
    /* .app-container{
        height: 100vh;
    } */
</style>
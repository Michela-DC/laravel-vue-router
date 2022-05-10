<template>
    <div class="app-container bg-slate-400">
        <header>
            <nav>
                <li>Home</li>
                <li>Posts</li>
                <li>Categories</li>
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
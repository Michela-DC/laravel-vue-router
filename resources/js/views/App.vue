<template>
    <div class="app-container bg-slate-400">
        <header>
            <nav>
                <li>Home</li>
                <li>Posts</li>
                <li>Categories</li>
            </nav>
        </header>

        <PostGrid />

        <footer>
            &copy; Boolpress!
        </footer>
    </div>
</template>

<script>
import PostGrid from './Post.index.vue';

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
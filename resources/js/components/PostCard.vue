<template>
    <div class="card post flex flex-col border-2 border-slate-300 rounded-md overflow-hidden shadow-md shadow-slate-200">
        <figure class="img-wrapper">
            <img src="https://picsum.photos/450/250" class="w-full object-cover" alt="">
        </figure>
        <div class="card-content p-4 flex-1">
            <h4 class="card-title">Title: {{ post.title }}</h4>
            <!-- le categorie potrebbero non esserci quindi uso il v-if per farle stampare solo se ci sono -->
            <p v-if="post.category">Category: {{ post.category.name }}</p>
            <ul class="tags pb-4">
                <li class="tag" v-for="tag in post.tags" :key="tag.id">Tag: {{ tag.name }}</li>
            </ul>
            <router-link 
            class="bg-amber-500 rounded-md px-3 py-1 text-sm text-white hover:bg-orange-500" 
            tag="button" 
            :to="{ name: 'posts.show', params:{ slug: post.slug } }">Read full post
            </router-link>
            <!-- la rotta posts.show vuole anche un parametro slug a cui passo lo slug che recupero da post -->
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: false,
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
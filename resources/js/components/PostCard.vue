<template>
    <div class="card post flex flex-col border-4 border-slate-300 rounded-md overflow-hidden shadow-md shadow-slate-500">
        <figure class="img-wrapper">
            <img src="https://picsum.photos/450/250" class="w-full object-cover" alt="">
        </figure>
        
        <div class="card-content p-4">
            <h4 class="card-title pb-2 text-lg">
                <span class="font-bold">Title: </span>
                {{ post.title }}
            </h4>
            <!-- le categorie potrebbero non esserci quindi uso il v-if per farle stampare solo se ci sono -->
            <p v-if="post.category">
                <span class="font-bold">Category: </span>
                {{ post.category.name }}
            </p>

            <ul class="tags py-4 flex gap-1">
                <li class="tag bg-cyan-200 text-blue-900 text-xs rounded-full px-3 py-1" v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</li>
            </ul>

            <router-link 
            class="bg-amber-500 rounded-md px-3 py-1 text-sm text-white hover:bg-orange-500" 
            tag="button" 
            :to="{ name: 'posts.show', params:{ slug: post.slug } }">
                Read full post
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
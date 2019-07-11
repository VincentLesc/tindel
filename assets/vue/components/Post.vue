<template>
        <div class="card w-100 mt-2" v-on:click="deletePost(post.id)">
            <div class="card-body" style="background-color: black">
                {{ post.message }}
            </div>
        </div>
</template>

<script>
    export default {
        name: 'post',
        props: ['post'],
        methods: {
            deletePost (id) {
                this.$store.dispatch('post/deletePost', id)
            }
        }
    }
</script>

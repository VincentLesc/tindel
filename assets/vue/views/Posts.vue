<template>
    <div>
        <div class="row">
            <h1 class="text-center w-100">Posts</h1>
        </div>

        <div class="row ml-0">
            <form @submit="createPost()" class="w-100 mr-3">
                <input  v-model="message" type="text" class="form-control w-100 mb-1" placeholder="Message">
                <button @click="createPost()" :disabled="message.length === 0 || isLoading" type="button" class="btn btn-primary w-100">Create</button>
            </form>
        </div>

        <div v-if="isLoading" class="row col">
            <p>Loading...</p>
        </div>

        <div v-else-if="hasError" class="row col">
            <div class="alert alert-danger" role="alert">
                {{ error }}
            </div>
        </div>

        <div v-if="!hasPosts" class="row col">
            No posts!
        </div>
        <div v-else>
            <transition-group name="list" tag="div" class="w-100 row m-0">
                <div v-for="post in posts" v-bind:key="post.id" class="list-item col-4 p-1">
                    <post :post="post"></post>
                </div>
            </transition-group>
        </div>
    </div>
</template>

<script>
    import Post from '../components/Post';

    export default {
        name: 'posts',
        components: {
            Post
        },
        data () {
            return {
                message: '',
            };
        },
        created () {
            this.$store.dispatch('post/fetchPosts');
        },
        computed: {
            isLoading () {
                return this.$store.getters['post/isLoading'];
            },
            hasError () {
                return this.$store.getters['post/hasError'];
            },
            error () {
                return this.$store.getters['post/error'];
            },
            hasPosts () {
                return this.$store.getters['post/hasPosts'];
            },
            posts () {
                return this.$store.getters['post/posts'];
            },
        },
        methods: {
            createPost () {
                this.$store.dispatch('post/createPost', this.$data.message)
                    .then(() => this.$data.message = '')
            },
        },
    }
</script>

<style>
    .list-enter-active, .list-leave-active {
        transition: all 1s;
    }
    .list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>

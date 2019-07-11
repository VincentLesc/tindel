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

        <div v-else-if="!hasPosts" class="row col">
            No posts!
        </div>
        <div v-else class="row">
            <div v-for="post in posts" class="col-md-4">
                <post :post="post"></post>
            </div>
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

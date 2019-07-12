<template>
    <div class="flex-row">
        <div v-if="login" class="main text-center">
            <login></login>
        </div>
        <div v-else class="main">
            <register></register>
        </div>
    </div>
</template>

<script>

    import Login from '../components/Login'
    import Register from '../components/Register'

    export default {
        name: 'authentication',
        data () {
            return {
                login: true,
            };
        },
        components: {
            Login,
            Register
        }
    }
</script>

<style scoped>
    .main {
        height: 66vh;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: transparent;
    }
</style>
<template>

        <div v-if="login" class="main text-center flex-column">
            <p @click="login=false">Not account yet ? create one</p>
            <login></login>
        </div>
        <div v-else class="main text-center flex-column">
            <p @click="login=true">Already an account ? Login here !</p>
            <register></register>
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
        },
        created () {
            let redirect = this.$route.query.redirect;

            if (this.$store.getters['security/isAuthenticated']) {
                if (typeof redirect !== 'undefined') {
                    this.$router.push({path: redirect});
                } else {
                    this.$router.push({path: '/home'});
                }
            }
        },
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
    p:hover {
        color: #0F83E8;
        font-size: 1.25rem;
    }
    p {
        transition: 0.5s;
    }
</style>

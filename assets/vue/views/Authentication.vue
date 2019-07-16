<template>
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12" v-if="login">
                        <login></login>
                        <v-toolbar dark>
                            <v-toolbar-title @click="login=false">Not account yet ? create one</v-toolbar-title>
                        </v-toolbar>
                    </v-card>
                    <v-card class="elevation-12" v-else>
                        <register></register>
                        <v-toolbar dark>
                            <v-toolbar-title @click="login=true">Already an account ? Sign in</v-toolbar-title>
                        </v-toolbar>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
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

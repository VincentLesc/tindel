<template>
    <v-app id="inspire" dark>
        <v-toolbar app fixed clipped-left>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Application</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn flat>
                    <router-link to="/home">Home</router-link>
                </v-btn>
                <v-btn flat>
                    <router-link to="/posts">Posts </router-link>
                </v-btn>
                <v-btn  v-if="isAuthenticated">>
                    <router-link to="/user/profile">User Profile
                    </router-link>
                </v-btn>
                <v-btn  href="/api/security/logout" v-if="isAuthenticated">Log Out

                </v-btn>
                <v-btn  v-if="!isAuthenticated">
                    <router-link to="/authentication">Login
                    </router-link>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <router-view></router-view>
        <v-footer app fixed>
            <span>&copy; 2017</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        name: 'app',
        data: () => ({
            drawer: true
        }),
        props: {
            source: String
        },
        created () {
            let isAuthenticated = JSON.parse(this.$parent.$el.attributes['data-is-authenticated'].value),
                roles = JSON.parse(this.$parent.$el.attributes['data-roles'].value);

            let payload = {isAuthenticated: isAuthenticated, roles: roles};
            this.$store.dispatch('security/onRefresh', payload);
        },
        computed: {
            isAuthenticated () {
                return this.$store.getters['security/isAuthenticated']
            },
        },
    }
</script>

<style>
    @import "~vuetify/dist/vuetify.css";
    /*
     * Globals
     */

    /* Links */
    a {
        text-decoration: none;
        color: white !important;
        -webkit-transition-delay: 100ms;
        -moz-transition-delay: 100ms;
        -ms-transition-delay: 100ms;
        -o-transition-delay: 100ms;
        transition-delay: 100ms;
    }
    a:hover {
        font-weight: bold;
    }

</style>

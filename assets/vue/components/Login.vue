<template>
    <div>
        <v-toolbar dark color="primary">
            <v-toolbar-title>Login form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-form>
                <v-text-field v-model="email" prepend-icon="person" name="email" label="Login" type="text"></v-text-field>
                <v-text-field v-model="plainPassword" prepend-icon="lock" name="plainPassword" label="Password" id="password" type="password"></v-text-field>
            </v-form>
            <v-alert
                    :value="hasError"
                    type="error"
                    outline
            >
                Error
            </v-alert>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" v-on:click="performLogin">Login</v-btn>
        </v-card-actions>
    </div>
</template>

<script>

    import Alert from '../components/Alert';

    export default {
        name: 'login',
        components: {
            Alert
        },
        data () {
            return {
                email : '',
                plainPassword: ''
            }
        },
        computed: {
            hasError() {
                return this.$store.getters['security/hasError'];
            },
        },
        methods: {
            performLogin(){
                let user = {email: this.email, plainPassword: this.plainPassword};
                this.$store.dispatch(
                    'security/loginUser',
                    user
                ).then(() => {
                    if (!this.$store.getters['security/hasError']) {
                        if (typeof redirect !== 'undefined') {
                            this.$router.push({path: redirect});
                        } else {
                            this.$router.push({path: '/home'});
                        }
                    }
                });
            }
        }
    }
</script>

<template>
    <div>
        <v-toolbar dark color="primary">
            <v-toolbar-title>Register form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-form>
                <v-text-field v-on:change="controlEmailIsUnique" v-model="login" prepend-icon="person" name="email" label="Login" type="text"></v-text-field>
                <v-text-field v-on:change="controlPasswordFormat" v-model="password" prepend-icon="lock" name="plainPassword" label="Password" id="password" type="password"></v-text-field>
                <v-text-field v-on:keyup="controlPasswordEquals" v-model="passwordConfirm" prepend-icon="lock" name="passwordConfirm" label="paswordConfirm" id="passwordConfirm" type="password"></v-text-field>
            </v-form>
            <div v-if="hasError">
            <v-alert
                    :value="hasError"
                    type="error"
                    outline
                    v-for="error in errors"
                    :key="error.type"
            >
                {{error.data.message}}
            </v-alert>
            </div>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" v-on:click="disableSubmit">Register</v-btn>
        </v-card-actions>
    </div>
</template>

<script>

    import Alert from '../components/Alert';
    import SecurityAPI from '../api/security';

    export default {
        name: 'register',
        data () {
            return {
                login: '',
                password: '',
                passwordConfirm: '',
                errors: [],
            };
        },
        components:{
            Alert
        },
        methods: {
            hasError() {
                return this.errors.length !== 0;
            },
            controlPasswordEquals(){
                this.errors = this.errors.filter(error => error.type !== 'passwordEquals');
                this.password === this.passwordConfirm
                    ? this.errors = this.errors.filter(error => error.type !== 'passwordEquals')
                    : this.errors.push({type:'passwordEquals',data:{context:'alert-danger', message:'Password must matches'}})
            },
            controlPasswordFormat(){
                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                if(!strongRegex.test(this.password)) {
                    this.errors.push({type:'passwordFormat',data:{context:'alert-danger', message:'Password must be stronger'}})
                } else {
                    this.errors = this.errors.filter(error => error.type !== 'passwordFormat');
                }
            },
            controlEmailIsUnique(){
                this.errors = [];
                if (this.login.length > 4)
                    SecurityAPI.isUnique(this.login)
                        .then(res => {
                            if(res.data === false){
                                this.errors.push({type:'emailUnique',data:{context:'alert-danger', message:'Already an account ?'}})
                            } else {
                                this.errors = this.errors.filter(error => error.type !== 'emailUnique');
                            }
                        });
            },
            disableSubmit(){
                 return this.errors.length === 0 ? this.performRegister() : null;
            },
            performRegister(){
                let user = {email: this.login, plainPassword: this.password};
                this.$store.dispatch(
                    'security/registerUser',
                    user
                ).then(() => {
                    if (!this.$store.getters['security/hasError']) {
                        if (typeof redirect !== 'undefined') {
                            this.$router.push({path: redirect});
                        } else {
                            this.$router.push({path: '/home'});
                        }
                    }
                })
            }

        }

    }
</script>

<style scoped>

</style>

<template>
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input v-on:keyup="controlEmailIsUnique" v-model="login" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input v-on:blur="controlPasswordFormat" v-model="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputControlPassword" class="sr-only">Password</label>
        <input v-on:keyup="controlPasswordEquals" v-model="passwordConfirm" type="password" id="inputControlPassword" class="form-control" placeholder="Repeat Password" required>
        <div v-for="error in errors">
            <alert :context="error.data.context" :message="error.data.message"></alert>
        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <div v-on:click="disableSubmit()" class="btn btn-lg btn-primary btn-block" :class="{disabled :this.errors.length !== 0 }">Sign in</div>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    </form>
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
            controlPasswordEquals(){
                this.errors = this.errors.filter(error => error.type !== 'passwordEquals')
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


    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        border-radius: 0;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="password"]:last-of-type {
        margin-bottom: 10px;
        border-radius: 0;
    }

</style>

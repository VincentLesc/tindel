<template>
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input v-model="login" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input v-on:keyup="controlPasswordFormat" v-model="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputControlPassword" class="sr-only">Password</label>
        <input v-on:keyup="controlPasswordEquals" v-model="passwordConfirm" type="password" id="inputControlPassword" class="form-control" placeholder="Repeat Password" required>
        <div v-for="error in errors">
          <alert :context="error.context" :message="error.message"></alert>
        </div>
            <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button v-on:click="performRegister" :disabled="disableSubmit()" class="btn btn-lg btn-primary btn-block">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    </form>
</template>

<script>

    import Alert from '../components/Alert';

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
                this.errors = [];
                this.password === this.passwordConfirm
                    ? this.errors.length = 0
                    : this.errors.push({context:'alert-danger', message:'Passwords do not matches'});

            },
            controlPasswordFormat(){
                this.errors = [];
                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
                if(strongRegex.test(this.password)) {
                    this.errors.push({context:'alert-success', message:'Strong password'})
                } else if (mediumRegex.test(this.password)) {
                    this.errors.push({context:'alert-warning', message:'Password could be stronger'})
                } else {
                    this.errors.push({context:'alert-danger', message:'Password must be stronger'})
                }
            },
            disableSubmit(){
                return this.errors.length !== 0;
            },
            performRegister(){
                this.$store.dispatch(
                    'security/registerUser',
                    this.login,
                    this.password
                ).then(() => console.log('toto'))
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
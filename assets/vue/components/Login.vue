<template>
    <form class="form-signin w-100">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input v-model="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input v-model="plainPassword" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <div v-on:click="performLogin" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</div>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    </form>
</template>

<script>
    export default {
        name: 'login',
        data () {
            return {
                email : '',
                plainPassword: ''
            }
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

<style scoped>
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
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

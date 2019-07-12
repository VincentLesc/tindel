<template>
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputControlPassword" class="sr-only">Password</label>
        <input type="password" id="inputControlPassword" class="form-control" placeholder="Repeat Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    </form>
</template>

<script>
    export default {
        name: 'register'
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
<template>
    <div class="cover-container-fluid d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead">
            <div class="row">
                <div class="inner col-md-8 offset-md-2">
                    <h3 class="masthead-brand">Cover</h3>
                    <nav class="nav nav-masthead justify-content-center">
                        <router-link to="/home">
                            <a class="nav-link mr-2">Home</a>
                        </router-link>
                        <router-link to="/posts">
                            <a class="nav-link mr-2">Posts</a>
                        </router-link>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Contact</a>
                    </nav>
                </div>
            </div>
        </header>

        <main role="main" class="inner cover">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <router-view></router-view>
                </div>
            </div>
        </main>
        <div></div>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        name: 'app',
    }
</script>

<style>
    /*
     * Globals
     */

    /* Links */
    a,
    a:focus,
    a:hover {
        color: #fff;
    }

    /* Custom default button */
    .btn-secondary,
    .btn-secondary:hover,
    .btn-secondary:focus {
        color: #333;
        text-shadow: none; /* Prevent inheritance from `body` */
        background-color: #fff;
        border: .05rem solid #fff;
    }


    /*
     * Base structure
     */

    html,
    body {
        height: 100%;
        background-color: #333;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        color: #fff;
        text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
        box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
    }

    .cover-container {
        max-width: 42em;
    }

    h1{
        font-size: 1rem;
    }


    /*
     * Header
     */
    .masthead {
        margin-bottom: 2rem;
    }

    .masthead-brand {
        margin-bottom: 0;
    }

    .nav-masthead .nav-link {
        padding: .25rem 0;
        font-weight: 700;
        color: rgba(255, 255, 255, .5);
        background-color: transparent;
        border-bottom: .25rem solid transparent;
    }

    .nav-masthead .nav-link:hover,
    .nav-masthead .nav-link:focus {
        border-bottom-color: rgba(255, 255, 255, .25);
    }

    .nav-masthead .nav-link + .nav-link {
        margin-left: 1rem;
    }

    .nav-masthead .active {
        color: #fff;
        border-bottom-color: #fff;
    }

    @media (min-width: 48em) {
        .masthead-brand {
            float: left;
        }
        .nav-masthead {
            float: right;
        }
    }

    .cover {
        padding: 0 1.5rem;
    }
    .cover .btn-lg {
        padding: .75rem 1.25rem;
        font-weight: 700;
    }
    .mastfoot {
        color: rgba(255, 255, 255, .5);
    }
</style>

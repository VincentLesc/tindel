<template>
    <div class="alert" v-bind:class="[context]">{{message}}</div>
</template>

<script>
    export default {
        name: 'alert',
        props: [
            'context',
            'message'
        ]
    }
</script>

<style>
    .alert {
        color: black;
        border: none;
        text-shadow: none;
    }
</style>



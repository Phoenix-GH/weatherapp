<template>
    <h1 class="helloMessage">{{  message }}</h1>
</template>

<script>
    export default {
        props: {},

        data() {
            return {
                message: "Hello .vue component"
            }
        },

        ready() {}

    }
</script>
<style>
    .helloMessage {
        font-size: 32px;
        color: #ac050b;
        margin: 30px 0;
        text-align: center;
    }
</style>
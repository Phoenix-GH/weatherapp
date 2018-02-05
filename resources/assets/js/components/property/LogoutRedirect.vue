<template>
</template>
<script>
    export default {
        data() {
            return {
            }
        },
        created(){

        },
        mounted() {
            setTimeout(function() {
                location.href = '/logout?logout=true'; 
            },3000);
        }
    }
</script>
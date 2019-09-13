<template>
    <div>
         <navbar></navbar>
    </div>
</template>

<script>
   // import navbar from ('./components/navbar.vue').default;
    //Vue.component('navbar', require('./components/navbar.vue').default);


    export default {
        components:{
            navbar: navbar,
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

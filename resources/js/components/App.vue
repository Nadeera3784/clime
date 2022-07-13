<template>
   <div class="flex flex-col mx-auto w-full min-h-screen bg-gray-100">
        <Header></Header>
        <router-view></router-view>
        <Footer></Footer>
    </div>
</template>

<script>
    import Header from './Header/Header.vue';
    import Footer from './Footer/Footer.vue';
    export default {
        components: { 
            Header , 
            Footer
        },
        mounted() {
            console.log('App Component mounted.')
        }
    }
</script>

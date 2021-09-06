<template>
    <div>
        <Header/>
        <router-view></router-view>
    </div>
</template>

<script>
import Header from './components/Header.vue'
import Home from './pages/Home.vue'
export default {
  components: { 
        Home,
        Header 
    },
    name: 'App',
}
</script>

<style lang='scss'>
    @import '../sass/partials/general.scss';
</style>
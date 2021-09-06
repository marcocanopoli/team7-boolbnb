<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
import Home from './pages/Home.vue'
export default {
  components: { 
      Home 
    },
    name: 'App',
}
</script>

<style lang='scss' scoped>

</style>
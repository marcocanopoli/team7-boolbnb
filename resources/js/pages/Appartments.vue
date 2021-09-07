<template>
    <div class="container">
        ciao houses
        <ul>
            <li v-for="house in houses" :key="house.id">
                {{house.city}} 
            </li> 
        </ul> 
    </div>
</template>

<script>
export default {
    name: 'Appartments',
    props: {
        houses: Array
    }
}
</script>

<style>

</style>
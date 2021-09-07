<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul v-for="house in houses" :key="house.id">
                    <li>
                        {{house.title}} 
                    </li> 
                    <li>
                        {{house.city}} 
                    </li> 
                    <ul v-for='service, index in house.services' :key="index" >
                        <li>{{service.name}}</li> 
                    </ul> 
                </ul> 
            </div>

        </div>
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

<style lang='scss' scoped>
    .container {
        border: 1px solid #000;
        height: 100vh;
        padding-top: 90px;
    }
</style>
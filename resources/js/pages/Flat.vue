<template>
    <div>
        <div class="container-fluid top-distance">

            <div class="d-flex">
                <h1 class="h1">{{ houses[0].title }}</h1>
                <span class="bnb-btn bnb-btn-brand-2 align-self-center mx-4"> {{ getHouseType(houses[0].house_type_id) }}</span>
            </div>

            <div class="show-photos my-4">
                <div v-for="photo, index in houses[0].photos" :key="index">
                    <img :src="'storage/' + photo.path" :alt="'foto di ' + houses[0].title">
                </div> 
            </div>

    <div class="row">
        <div class="show-info col-md-6">
            <p><strong>Numero ospiti: </strong>{{houses[0].guests}}</p>
            <p><strong>Numero camere: </strong>{{houses[0].rooms}}</p>
            <p><strong>Numero letti: </strong>{{houses[0].beds}}</p>
            <p><strong>Numero bagni: </strong>{{houses[0].bathrooms}}</p>
            <p><strong>Mq: </strong>{{houses[0].square_meters}}</p>
            <strong class="my-2">Servizi inclusi:</strong>
            <ul class="list-unstyled flex-column flex-wrap">
                <li v-for="service, index in houses[0].services" :key="index">
                    <div class="service-svg mr-2">
                        <img :src="'images/services_icons/' + service.icon" :alt="service.name">
                    </div>
                    {{service.name}}
                </li>
            </ul>
            <strong class="my-2">Descrizione:</strong>
            <p>{{houses[0].description}}</p>
        </div> 
    </div> <!-- row -->

        <!-- <div class="show-details col-lg-6">
            <strong>Indirizzo: <span>{{houses.address}}, {{houses.zip_code}}, {{houses.city}}</span></strong>
            {{-- Mappa --}}
            <div id="map-div" class="pr-3 my-4"></div>
            {{-- /Mappa --}}
        </div> 
    </div>-->

    <div>
        <strong>Prezzo: <span>{{houses[0].price}} &euro;</span></strong>
        <strong class="color-brand">
            <p v-if="houses.visibile == 1" >Visibile</p>
            <p v-else>Attualmente non visibile</p>    
        </strong>
    </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'Flat',
    props: {
        houses : Array,
        houseTypes: Array,
    },
    data(){
        return{
           
        }
    },
    methods: {
        
        getHouseType(houseTypeId) {
            let houseType = '';
            this.houseTypes.forEach(element => {
                if(element.id == houseTypeId ) {
                    houseType = element.name;
                }
            });
            return houseType
        }
    }

}
</script>

<style lang="scss">
@import '../../sass/partials/variables.scss';

 .top-distance {
    padding-top: 90px;

 }

</style>
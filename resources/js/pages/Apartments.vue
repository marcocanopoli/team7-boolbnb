<template>
    <div class="container-fluid apartments mx-2">
        <h1 class="my-4">Strutture</h1>

        <div class="services">
            <div class="service-pill"
                v-for="service in allServices" :key="service.id"
                @click="checkService(service.id)" :id="'service-' + service.id">
                <div class="service-svg">
                    <img :src="'images/services_icons/'+ service.icon" alt="icon">
                </div>
                {{service.name}}
            </div>
        </div>

        <div>
            <div class="house-container row" v-for="house in houses" :key="house.id">
                <div class="col-12 col-md-8">
                    <!-- a = router-link -->
                    <router-link :to="{ name: 'flat', params: { house_id : house.id  } }" class="bnb-a">
                        <div class="row">
                            <div class="img-container col-12 col-md-4">
                                <img :src="'storage/' + house.photos[0].path" :alt="'Foto' + house.photos[0].id">
                            </div>
                            <div class="details-container col-12 col-md-8">
                                <p>{{ getHouseType(house.house_type_id) }} a {{house.city}}</p>
                                <h4>{{house.title}}</h4>
                                <p>
                                    {{house.guests}}
                                    <span v-if="house.guests < 2"> ospite </span>
                                    <span v-else> ospiti </span>
                                    &middot;

                                    {{house.rooms}}
                                    <span v-if="house.rooms < 2"> camera da letto </span>
                                    <span v-else> camere da letto </span> 
                                    &middot;

                                    {{house.beds}}
                                    <span v-if="house.beds < 2"> letto </span>
                                    <span v-else> letti </span>
                                    &middot;
                                    
                                    {{house.bathrooms}}
                                    <span v-if="house.bathrooms < 2"> bagno </span>
                                    <span v-else> bagni </span>
                                </p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VSearch from '../components/VSearch.vue';
export default {    
    name: 'Apartments',
    components: {
        VSearch
    },
    data() {
        return{
            filter: {
                inputSearch: '',
                rooms: '',
                beds: '',
                services: [],
                km: '20'
            },
            checkedServices: []
        }
    },
    props: {
        houses: Array,
        houseTypes: Array,
        lastSearch: Object,
        allServices: Array
        // searchCoordinates: Object,
    },
    methods: {        
        getHouseType(houseTypeId) {
            let name = '';
            this.houseTypes.forEach(element => {
                if(element.id == houseTypeId ) {
                    name = element.name;
                }
            });
            return name
        },
        checkService(service_id) {
            this.toggleService(service_id);
            if(this.checkedServices.includes(service_id)) {
                const index = this.checkedServices.indexOf(service_id);
                this.checkedServices.splice(index, 1);

            }else {
                this.checkedServices.push(service_id);
            }
            this.filter.services = this.checkedServices;
            this.$emit('search', this.filter);
        },
        toggleService(service_id) {
           const service = document.getElementById('service-' + service_id);
           if (service.classList.contains('pill-toggle')) {
               service.classList.remove("pill-toggle");
           }else {
               service.classList.add("pill-toggle");
           }
        }
        // getDistance(lat1, lon1, lat2, lon2) {
        //     var p = 0.017453292519943295;    // Math.PI / 180
        //     var c = Math.cos;
        //     var a = 0.5 - c((lat2 - lat1) * p)/2 + 
        //             c(lat1 * p) * c(lat2 * p) * 
        //             (1 - c((lon2 - lon1) * p))/2;

        //     return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
        // }
        // },
    },
    // computed: {
    //     filtered() {
    //         // filterArr = this.houses.filter( house => house.rooms >= this.filter.rooms );
    //         // filterArr = filterArr.filter( house => house.beds >= this.filter.beds );
    //         // filterArr = filterArr.filter( house => 
    //         //     this.getDistance(house.latitude, house.longitude, this.searchCoordinates.lat, this.searchCoordinates.lon <= this.filter.km));
    //         // return filterArr
    //     }
    // },
    mounted() {
        this.filter = this.lastSearch;
    }

}
</script>

<style lang='scss'>
    @import '../../sass/partials/variables.scss';

    .apartments {
        padding-top: 90px;

        h1 {
            font-size: 2.5rem;
        }

        .services {
            display: flex;
            flex-wrap: wrap;
            width: 50%;
            padding-right: 16px;

            .service-pill {
                margin: 8px 0;
                margin-right: 16px;   
                padding: 8px 16px;
                border-radius: 30px;
                border: 1px solid rgba($gray-1, 0.3);
                font-size: 14px;                
                background-color: $white;
                cursor: pointer;
                user-select: none;
            }
            
            .pill-toggle{
                background-color: $brand;
                border-color: $brand;
                color: $white;

                img {
                    filter: invert(1);
                }
            }
        }
    }

</style>
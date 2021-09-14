<template>
    <section class="apartments ">
        <div class="container-fluid">
            <div class="d-flex my-4 align-items-center">
                <h1>Strutture</h1>
                <button class="bnb-btn bnb-btn-brand ml-4" @click="toggleModal">Pi&ugrave; filtri</button>
            </div>
            <v-modal 
                v-show="visibleModal"            
                @close="toggleModal"
                @closeClear="closeClear">
                
                <div slot="header">
                    <h4>Servizi inclusi</h4>
                </div>

                <div slot="body">
                    <div class="services pt-2 pb-4">
                        <div class="service-pill"
                            v-for="service in allServices" :key="service.id"
                            @click="checkService(service.id)" :id="'service-' + service.id">
                            <div class="service-svg">
                                <img :src="'images/services_icons/'+ service.icon" alt="icon">

                            </div>
                            {{service.name}}
                        </div>
                    </div>
                </div>

                <div slot="footer"
                    class="text-right">
                    <strong class="color-brand ">
                        {{ houses.length }} 
                        <span v-if="houses.length == 1">risultato</span>                
                        <span v-else>risultati</span>
                    </strong>

                    <button
                        type="button"
                        class="bnb-btn bnb-btn-brand ml-2"
                        @click="clear">Deseleziona tutti             
                    </button>
                </div>
            </v-modal>
                <div class="col-md-6" v-if="houses.length == 0 && !loading">
                    <h2 class="no-results text-center">Nessun risultato da mostrare!</h2>
                </div>
                
                <div class="houses col-md-6 py-4" v-if="houses.length > 0 && !loading">                    
                    <router-link                         
                        v-for="house in houses" :key="house.id"
                        :to="{ name: 'flat', params: { house_slug : house.slug } }"
                        class="single-house bnb-a row">                    

                        <div class="img-container col-md-4">
                            <img :src="'storage/' + house.photos[0].path" :alt="'Foto' + house.photos[0].id">
                        </div>

                        <div class="details-container col-md-8">
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
                    </router-link>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div id="map-div" class="apartments-map col-md-10 offset-md-1"></div>
                    </div>
                </div>

            </div>

        </div>
        
    </section>
</template>

<script>
import FlatLoader from '../components/FlatLoader.vue';
import VSearch from '../components/VSearch.vue';
import VModal from '../components/VModal.vue';
export default {    
    name: 'Apartments',
    components: {
        VSearch,
        VModal,
        FlatLoader
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
            checkedServices: [],
            visibleModal: false,
            URLquery: {}
        }
    },
    props: {
        houses: Array,
        houseTypes: Array,
        currentSearch: Object,
        allServices: Array,
        loading: Boolean,
        searchCoordinates: Object
    },
    methods: {  
        // setLoading() {
        //     setTimeout(()=>{
        //         this.loading = false
        //     }, 1000);
        // },      
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
        },
        toggleModal() {
            this.visibleModal = !this.visibleModal;
        },
        clear() {
            this.filter.services = [];
            this.checkedServices = [];
            let activePills = document.querySelectorAll(".pill-toggle");

            activePills.forEach( pill => {
                pill.classList.remove("pill-toggle");
            });

            this.$emit('search', this.filter);
        },
        closeClear() {
            this.toggleModal();
        }, 
        getTomTomMap() {
            const API_KEY = 'MAy8CruNqMtQAbImXBd9FqGR76Ch0nGA'; 
            let coordinates; 

            if(this.houses.length > 0) {
                coordinates = {lat: this.houses[0].latitude, lon: this.houses[0].longitude};
            } else {
                coordinates =  this.searchCoordinates;
            }

            var map = tt.map({
                key: API_KEY,
                container: 'map-div',
                center: coordinates,
                zoom: 14
            });
            map.scrollZoom.disable();//disattiva scroll x zoom in/out usare bottoni
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());

            new tt.Marker().setLngLat(coordinates).addTo(map);

            if(this.houses.length > 0) {
                this.houses.forEach(house => {
                    let houseCoordinates = {lat: house.latitude, lon: house.longitude};
                    new tt.Marker().setLngLat(houseCoordinates).addTo(map);
                })
            }
        },
        searchURL() {
            this.URLquery = this.$route.query;
            if(this.URLquery.search) {
                this.URLquery.inputSearch = this.$route.query.search;
                this.$emit('search', this.URLquery);
            }
        }
    },
    computed: {
        // filtered() {
            // filterArr = this.houses.filter( house => house.rooms >= this.filter.rooms );
            // filterArr = filterArr.filter( house => house.beds >= this.filter.beds );
            // filterArr = filterArr.filter( house => 
            //     this.getDistance(house.latitude, house.longitude, this.searchCoordinates.lat, this.searchCoordinates.lon <= this.filter.km));
            // return filterArr
        // }
    },
    watch: {
        searchCoordinates: {
            deep: true,
            handler: function() {
                this.getTomTomMap();
            }
        }
    },
    mounted() {
        this.filter = this.currentSearch;

        this.searchURL();

        // this.loading = this.isLoading;
    }

}
</script>

<style lang='scss'>
    @import '../../sass/partials/variables.scss';

    .apartments {
        padding-top: 90px ;

        h1 {
            font-size: 2.5rem;
        }

        .no-results {
            padding-top: 170px;
        }

        .house-container {
            width: 50%;
        }

        .services {
            display: flex;
            flex-wrap: wrap;
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

        .houses {
            display: flex;
            flex-direction: column;

            .single-house {
                padding: 20px 0;

                &:not(:first-of-type) { 
                    border-top: 1px solid rgba($gray-1, 0.3);
                }

                .details-container {
                    p {
                        color: $gray-1;
                        font-size: 14px;
                    }
                }
            }
        }
    }

    #map-div.apartments-map {
        height: calc(100vh - 204px);
    }

</style>
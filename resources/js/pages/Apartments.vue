<template>
    <section class="apartments ">
        <div class="container-fluid apartments-content">
            <div class="d-flex align-items-center">
                <h1>Strutture</h1>
            </div>
            
            <div class="row">
                <div class="col-md-6" v-if="loading">
                    <FlatLoader/>
                </div>
                <div class="col-md-6" v-if="houses.length == 0 && !loading">
                    <h2 class="no-results text-center">Nessun risultato da mostrare!</h2>
                </div>
                
                <div class="houses col-md-6 py-4" v-if="houses.length > 0 && !loading">                    
                    <router-link                         
                        v-for="house in houses" :key="house.id"
                        :to="{ name: 'flat', query: { title : house.slug }}"
                        class="single-house bnb-a row">                    

                        <div class="img-container col-md-4">
                            <img :src="'storage/' + house.photos[0].path" :alt="'Foto' + house.photos[0].id">
                        </div>

                        <div class="details-container col-md-8">
                            <div class="d-flex">
                                <p>{{ house.house_type.name }} a {{house.city}}</p>
                                <i  v-if="isSponsored(house)"
                                    class="fas fa-gem show-sponsor-icon ml-3"></i>   
                            </div>
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
import VPagination from '../components/VPagination.vue';
import FlatLoader from '../components/FlatLoader.vue';
import VSearch from '../components/VSearchOLD.vue';
export default {    
    name: 'Apartments',
    components: {
        VSearch,
        FlatLoader,
        VPagination
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
            URLquery: {},                        
            current_page: 1,
            last_page: 1,
        }
    },
    props: {
        houses: Array,
        currentSearch: Object,
        loading: Boolean,
        searchCoordinates: Object
    },
    methods: {
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
        },
        isSponsored(house) {
            let sponsored =  false;
            const lastPromotion = house.promotions[house.promotions.length - 1];
            const now = new Date();
            if(lastPromotion) {
                const endDateString = lastPromotion.pivot.end_date;
                const endDate = new Date(endDateString);
                if(endDate > now) {
                    sponsored = true;
                }
            }
            return sponsored;
        }
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
        margin-top: 90px ;
        .apartments-content {
            padding-top: 36px;
            padding-bottom: 56px;

            h1 {
                font-size: 2.5rem;
            }
    
            .no-results {
                padding-top: 170px;
            }
    
            .house-container {
                width: 50%;
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

        .show-sponsor-icon {
            font-size: 16px;
        }
    }

    #map-div.apartments-map {
        height: calc(100vh - 204px);
    }

</style>
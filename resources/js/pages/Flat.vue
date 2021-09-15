<template>
    <div class="top-distance ">
        <!-- Mappa -->
        <div id="map-div" class=""></div>
        <!-- /Mappa  -->
        <div class="container flat-content px-4"
            v-if="!loading">

            <!-- titolo -->
            <div class="d-flex ">
                <h1 class="h1">{{ house.title }}</h1>
                <span class="bnb-btn bnb-btn-brand-2 align-self-center mx-4"> {{ house.house_type.name }} </span>
            </div>
            <!-- /titolo -->
            
            <p><strong>Indirizzo: </strong>{{house.address}}, {{house.zip_code}}, {{house.city}}</p>

            <div class="show-photos my-4 ">
                <div v-for="photo, index in house.photos" :key="index">
                    <img :src="'/storage/' + photo.path" :alt="'foto di ' + house.title">
                </div> 
            </div>

            <div class="row ">
                <div class="show-info col-12 col-md-6">
                    <p><strong>Numero ospiti: </strong>{{house.guests}}</p>
                    <p><strong>Numero camere: </strong>{{house.rooms}}</p>
                    <p><strong>Numero letti: </strong>{{house.beds}}</p>
                    <p><strong>Numero bagni: </strong>{{house.bathrooms}}</p>
                    <p><strong>Mq: </strong>{{house.square_meters}}</p>
                    <strong class="my-2">Servizi inclusi:</strong>
                    <ul class="list-unstyled flex-column flex-wrap">
                        <li v-for="service, index in house.services" :key="index">
                            <div class="service-svg mr-2">
                                <img :src="'/images/services_icons/' + service.icon" :alt="service.name">
                            </div>
                            {{service.name}}
                        </li>
                    </ul>
                    <div class="my-3">
                        <strong class="">Descrizione:</strong>
                        <p>{{house.description}}</p>
                        <strong>Prezzo: <span>{{house.price}} &euro;</span></strong>
                    </div>
                </div> 
    

                <div class="show-details col-12 col-md-6">
                    <!-- box form -->
                    <Message :house_id="house.id"/>
                    <!-- //box form -->
                </div> 
            </div>  <!-- /row -->

        </div> <!-- container fluid -->
    </div> <!-- main div -->
</template>

<script>
import Message from '../components/Message.vue';
export default {
    name: 'Flat',
    components: {
        Message
    },
    data(){
        return{
            house: {},
            loading: true
        }
    },
    mounted() {
        this.getFlat(this.$route.params.house_slug);
        
    },
    methods: {
        getTomTomMap() {
            const API_KEY = '9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx';   
            const coordinates =  {lat: this.house.latitude, lon: this.house.longitude};

            var map = tt.map({
                key: API_KEY,
                container: 'map-div',
                center: coordinates,
                zoom: 16
            });

            map.scrollZoom.disable();//disattiva scroll x zoom in/out usare bottoni
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
            new tt.Marker().setLngLat(coordinates).addTo(map);
        },
        getFlat(slug) {
            this.loading = true;
            axios.get(`http://127.0.0.1:8000/api/houses/${slug}`)
            .then(res => {
                this.house = res.data;
                this.loading = false;
                this.getTomTomMap();
            }).catch(err => {
                console.log(err);
            });
        }
    }
}


</script>

<style lang="scss">
@import '../../sass/partials/variables.scss';

 .top-distance {
    padding-top: 90px;

    .flat-content {
        padding: 36px 0 56px 0;
    }

    .show-details {
        width: 150px;
        border: 1px solid red($color: #000000);
    }

    #map-div {
        height: 400px;
        width: 100%;
    }
 }  

</style>
<template>
    <div>
         <div class="container-fluid">


        <div class="d-flex my-4">
            <h1>Strutture</h1> 
        </div>
        <div class="d-flex filters">
            <!-- @keyup.enter="$emit('search', searchData)" -->
            <div>
                <label for="rooms">Camere</label>
                <input type="number" min="1" name="rooms" id="rooms" v-model="filter.rooms" placeholder="Aggiungi camere"  >
            </div>
            <div>
                <label for="beds">Letti</label>
                <input type="number" min="1" name="beds" id="beds" v-model="filter.beds" placeholder="Aggiungi letti" >
            </div>
            <div>
                <label for="km">Km</label>
                <input class="multi-input align-self-center" type="number" min="0" name="km" id="km" v-model="filter.km" placeholder="Cerca nel raggio di km">
            </div>
        </div>
        <div>
            <div class="house-container row" v-for="house in filtered" :key="house.id">
                <div class="col-12 col-md-8">
                    <!-- a = router-link -->
                    <a href="#" class="bnb-a">
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
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    computed: {
        filtered() {
            let filterArr = this.houses.filter( house => house.rooms >= this.filter.rooms );
            filterArr = filterArr.filter( house => house.beds >= this.filter.beds );
            // filterArr = filterArr.filter( house => house.km <= this.filter.km );
            return filterArr
        }
    },
    name: 'Appartments',
    props: {
        houses: Array,
        houseTypes: Array,
        // search: String
    },
    methods: {

        getHouseType(housetypeid) {
            let name = '';
            this.houseTypes.forEach(element => {
                if(element.id == housetypeid ) {
                    name = element.name;
                }
            });
            return name
        },
        getDistance(lat1, lon1, lat2, lon2){
            var p = 0.017453292519943295;    // Math.PI / 180
            var c = Math.cos;
            var a = 0.5 - c((lat2 - lat1) * p)/2 + 
                    c(lat1 * p) * c(lat2 * p) * 
                    (1 - c((lon2 - lon1) * p))/2;

            return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
        }
    },
    data() {
        return{
            filter: {
                km: '',
                rooms: '',
                beds: '',
                services: ''
            }
        }
    }

}
</script>

<style lang='scss' scoped>
@import '../../sass/partials/variables.scss';
    .container-fluid {
        padding-top: 90px;
        h1 {
            font-size: 2.5rem;
        }
    }

    input {
        padding: 12px 16px;
        border: 1px solid rgba($gray-1, 0.2);
        border-radius: 45px;
        outline: none;

        &:hover {
        background-color: rgba($gray-1, 0.2);
        }
    }

    .filters{
        & > div {
            display: flex;
            flex-direction: column;
            padding-right: 16px;
        }
    }

</style>
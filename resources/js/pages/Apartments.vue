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
                <div class="position-relative km-box">
                    <input class=" align-self-center" type="number" min="0" name="km" id="km" v-model="filter.km" placeholder="Cerca nel raggio di km" @keyup.enter="$emit('search', filter)">
                    <button class="mybtn" @click="$emit('search', filter)"><i class="fas fa-arrow-right"></i></button>
                </div>

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
    name: 'Apartments',
    data() {
        return{
            filter: {
                inputSearch: '',
                km: '20',
                rooms: '',
                beds: '',
                services: ''
            }
        }
    },
    props: {
        houses: Array,
        houseTypes: Array,
        searchCoordinates: Object,
        lastInputSearch: String
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
        getDistance(lat1, lon1, lat2, lon2) {
            var p = 0.017453292519943295;    // Math.PI / 180
            var c = Math.cos;
            var a = 0.5 - c((lat2 - lat1) * p)/2 + 
                    c(lat1 * p) * c(lat2 * p) * 
                    (1 - c((lon2 - lon1) * p))/2;

            return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
        }
    },
    computed: {
        filtered() {
            let filterArr = this.houses.filter( house => house.rooms >= this.filter.rooms );
            filterArr = filterArr.filter( house => house.beds >= this.filter.beds );
            filterArr = filterArr.filter( house => 
                this.getDistance(house.latitude, house.longitude, this.searchCoordinates.lat, this.searchCoordinates.lon <= this.filter.km));
            return filterArr
        }
    },
    updated() {
        this.filter.inputSearch = this.lastInputSearch;
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

    .km-box {
        padding: 12px 16px;
        border: 1px solid rgba(113, 113, 113, 0.2);
        border-radius: 45px;
        outline: none;
        &:hover {
            background-color: rgba(113, 113, 113, 0.2);
        }

        &:hover #km {
            background-color: transparent
        }
    }

    #km {
        padding: 0;
        outline: none;
        border: transparent;
        width: calc(100% - 36px);
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

    .mybtn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 36px;
        height: 36px;
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translateY(-50%);
        background-color: $brand;
        color: $white;
        border-radius: 50%;
        cursor: pointer;
        
        i {
            font-size: 14px;
        }
    }

</style>
<template>
<div class="container mt-5">
    <input type="text" placeholder="cerca" v-model="searchCity" @keyup="getLocation" @keydown.down="setDownActive" @keydown.up="setUpActive">
    <ul v-if="cities.length > 0">
        <li v-for="(city, index) in cities" :key="city.id"
        :class="index == active ? 'active' : '' "
        v-show="city.address.municipality"
        @click="setLocation(city.address.freeformAddress,city.address.countrySubdivision,city.address.countryCode)">
            {{city.address.freeformAddress}}, {{city.address.countrySubdivision}}, {{city.address.countryCode}}
        </li>
    </ul>
</div>
</template>

<script>
export default {
    data() {
        return {
            searchCity: '',
            cities: [],
            active: 0
        }
    },
    methods: {
        getLocation() {
            const currentAxios = axios.create();
            currentAxios.defaults.headers.common = {};
            currentAxios.defaults.headers.common.accept = 'application/json';

            if (this.searchCity.length >= 2) {
                
                currentAxios.get(`https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IT&municipality=${this.searchCity}&language=it-IT&key=9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx`)
                
                .then(
                    res => {
                        this.cities = res.data.results
                    }
                )
            } else if (this.searchCity.length < 2) {
                this.cities = []
            }

        },
        setLocation(city,country,state) {
            this.searchCity = `${city}, ${country}, ${state}`;
            this.cities = []
        },
        setDownActive() {
            
            if (this.active == this.cities.length){
                this.active = this.cities.length - 1
            }else {
                this.active = this.active + 1
            }
        },
        setUpActive() {
            if (this.active == -1){
                this.active = 0
            } else {
                this.active = this.active - 1
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/partials/variables.scss';
    ul {
        width: 30%;
        list-style: none;
        padding: 0;
        border: 1px solid rgba($gray-1, 0.3);
        border-radius: 12px;
        overflow: hidden;

        li {
            padding: 5px 10px;
            cursor: pointer;

            &:hover,
            &.active {
                background-color: rgba($gray-1, 0.1);
            }
        }
    }
</style>
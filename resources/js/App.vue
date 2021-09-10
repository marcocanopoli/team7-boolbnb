<template>
    <div>
        <!-- <Header @search="performSearch"
            /> -->
            <!-- @autocomplete ="autocomplete" -->
        <router-view 
            :houses="houses" 
            :houseTypes="houseTypes" 
            :searchCoordinates="searchCoordinates"
            :lastInputSearch="lastSearch.inputSearch"
            @search="performSearch">
        </router-view>
    </div>
</template>

<script>
import Header from './components/Header.vue'
import Home from './pages/Home.vue'
import Apartments from './pages/Apartments.vue'

export default {
  components: { 
        Home,
        Header,
        Apartments
    },
    data(){
        return{
            houses: [],
            houseTypes: [],
            searchCoordinates: {},
            lastSearch: {
                inputSearch : "",
                km: '',
                rooms: '',
                beds: '',
                services: ''
            },
        }
    },
    name: 'App',
    created() {
        this.getHouseTypes();
        
    },
    methods: {
        getCoordinates(){
            const currentAxios = axios.create();
            currentAxios.defaults.headers.common = {};
            currentAxios.defaults.headers.common.accept = 'application/json';

            currentAxios.get(`https://api.tomtom.com/search/2/geocode/${this.lastSearch.inputSearch}.json`,
            {
                params: {
                    key : '9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx',
                    language: 'it-IT',
                    countrySet: 'IT',
                    limit: 10
                }
            }).then((res) => {
                this.searchCoordinates = res.data.results[0].position;
            }).catch((err) => {
                console.log(err);
            });
        },
        // autocomplete(inputSearch){
        //     this.lastSearch.inputSearch = inputSearch;

        //     const currentAxios = axios.create();
        //     currentAxios.defaults.headers.common = {};
        //     currentAxios.defaults.headers.common.accept = 'application/json';

        //     currentAxios.get(`https://api.tomtom.com/search/2/autocomplete/${this.lastSearch.inputSearch}.json`,
        //     {
        //         params: {
        //             key : '9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx',
        //             language: 'it-IT',
        //             // countrySet: 'IT',
        //             // limit: 10
        //         }
        //     }).then((res) => {
        //         // this.searchCoordinates = res.data.results[0].position;
        //         console.log(res);
        //     }).catch((err) => {
        //         console.log(err);
        //     });
        // },
        getHouseTypes(){
            axios.get('http://127.0.0.1:8000/api/housetypes')
            .then(res => {
                this.houseTypes = res.data;
            }).catch(err => {
                console.log('type', err)
            });
        },
        performSearch(searchData) {
            if( this.lastSearch.inputSearch == searchData.inputSearch 
                && this.lastSearch.km == searchData.km 
                && this.lastSearch.rooms == searchData.rooms 
                && this.lastSearch.services == searchData.services 
                || searchData.inputSearch == '') {
                return
            }
            axios.get('http://127.0.0.1:8000/api/search' , {
                params: {
                    query: searchData.inputSearch,
                    ...(searchData.km ? {km: searchData.km } : {} ),
                    ...(searchData.rooms ? {rooms: searchData.rooms } : {} ),
                    ...(searchData.beds ? {beds: searchData.beds } : {} ),
                    ...(searchData.services ? {services: searchData.services } : {} )
                }      
            }).then(res => {
                this.houses = res.data;
                this.lastSearch.inputSearch = searchData.inputSearch;
                this.lastSearch.km = searchData.km;
                this.lastSearch.rooms = searchData.rooms;
                this.lastSearch.beds = searchData.beds;
                this.lastSearch.services = searchData.services;
                this.$router.push('/apartments').catch(()=>{});
                this.getCoordinates();
                // console.log('res axios app', this.houses);

            })
            .catch(error => {
                console.log(error);
            });
        }
    }    
}

</script>

<style lang='scss'>
    @import '../sass/partials/general.scss';
</style>
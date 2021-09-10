<template>
    <div>

        <Header 
            @search="performSearch"/>
        <router-view
            @search="performSearch"
            :houses="houses" 
            :lastSearch="lastSearch"
            :houseTypes="houseTypes"
            :allServices="allServices">
        </router-view>
    </div>
</template>

<script>
import Header from './components/Header.vue'
import Home from './pages/Home.vue'
import Apartments from './pages/Apartments.vue'

export default {
  components: { 
        Header,
        Home,
        Apartments
    },
    data(){
        return{
            houses: [],
            houseTypes: [],
            allServices: [],
            // searchCoordinates: {},
            lastSearch: {
                inputSearch : "",
                rooms: '',
                beds: '',
                services: '',
                km: ''
            },
            user: ''
        }
    },
    name: 'App',
    created() {
        this.getHouseTypes();
        this.getServices();
    },
    methods: {
        // getUser() {
        //     axios.get('http://127.0.0.1:8000/api/user')
        //     .then(res => {
        //         this.user = res.data;
        //     })
        //     .catch(error => {
        //         if (error.response.status == 401) {
        //             this.user = '';
        //         }else {
        //             console.error('Error retrieving user:', error);
        //         }
        //     });
        // },
        // getCoordinates(){
        //     const currentAxios = axios.create();
        //     currentAxios.defaults.headers.common = {};
        //     currentAxios.defaults.headers.common.accept = 'application/json';

        //     currentAxios.get(`https://api.tomtom.com/search/2/geocode/${this.lastSearch.inputSearch}.json`,
        //     {
        //         params: {
        //             key : '9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx',
        //             language: 'it-IT',
        //             countrySet: 'IT',
        //             limit: 10
        //         }
        //     }).then((res) => {
        //         this.searchCoordinates = res.data.results[0].position;
        //     }).catch((err) => {
        //         console.log(err);
        //     });
        // },
        getHouseTypes(){
            axios.get('http://127.0.0.1:8000/api/housetypes')
            .then(res => {
                this.houseTypes = res.data;
            }).catch(err => {
                console.log('HouseType error: ', err)
            });
        },
        getServices(){
            axios.get('http://127.0.0.1:8000/api/services')
            .then(res => {
                this.allServices = res.data;
            }).catch(err => {
                console.log('Service error: ', err)
            });
        },
        performSearch(searchData) {

            // light search
            if(searchData.length == 1) { //if single search input
                searchData.inputSearch = searchData[0]; //assign to inputSearch
                searchData.km = '';
                searchData.rooms= '';
                searchData.services = '';
            }

            if( 
                // this.lastSearch.inputSearch == searchData.inputSearch 
                // && this.lastSearch.km == searchData.km 
                // && this.lastSearch.rooms == searchData.rooms 
                // && this.lastSearch.services == searchData.services
                JSON.stringify(this.lastSearch) === JSON.stringify(this.searchData)  
                || searchData.inputSearch == '') {
                return
            }

            axios.get('http://127.0.0.1:8000/api/search', {
                params: {
                    query: searchData.inputSearch,
                    ...(searchData.km ? {km: searchData.km } : {} ),
                    ...(searchData.rooms ? {rooms: searchData.rooms } : {} ),
                    ...(searchData.beds ? {beds: searchData.beds } : {} ),
                    ...(searchData.services ? {services: searchData.services } : {} )
                }      
            }).then(res => {
                // console.log('Chiamata API ricerca')
                this.houses = res.data;

                this.lastSearch.inputSearch = searchData.inputSearch;
                this.lastSearch.km = searchData.km;
                this.lastSearch.rooms = searchData.rooms;
                this.lastSearch.beds = searchData.beds;
                this.lastSearch.services = searchData.services;

                this.$router.push('/apartments').catch(()=>{});
                // this.getCoordinates();

            })
            .catch(error => {
                console.error('Errore:', error);
            });
        }
    },
    // mounted() {
    //     this.getUser();
    // }    
}
</script>

<style lang='scss'>

    @import '../sass/partials/general.scss';

</style>
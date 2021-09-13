<template>
    <div>

        <Header 
            @search="performSearch"
            :currentSearch="lastSearch"/>
        <router-view
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
    methods: {
        getUser() {
            axios.get('api/user')
            .then(res => {
                this.user = res.data;
            })
             .catch(error => {
                if (error.response) {
                    if(error.response.status == 401) {
                        console.log('Unauthorized user');
                    }else {
                        console.log(error.response);
                    }
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
            });  
        },
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
                console.log('Chiamata API ricerca', res)
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
        },
        created() {
            this.getUser();
            this.getHouseTypes();
            this.getServices();
        }
    }   
}
</script>

<style lang='scss'>

    @import '../sass/partials/general.scss';

</style>
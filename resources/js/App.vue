<template>
    <div>
        <Header @search="performSearch"/>
        <router-view :houses="houses" :houseTypes="houseTypes" :search="lastSearches.inputSearch"></router-view>
    </div>
</template>

<script>
import Header from './components/Header.vue'
import Home from './pages/Home.vue'
import Appartments from './pages/Appartments.vue'

export default {
  components: { 
        Home,
        Header,
        Appartments
    },
    data(){
        return{
            houses: [],
            lastSearches: {
                inputSearch : "",
                km: '',
                rooms: '',
                beds: '',
                services: ''
            },
            houseTypes: []
        }
    },
    name: 'App',
    created() {
        this.getHouseType();
        
    },
    methods: {
        getCoordinates(){
            axios.get('https://api.tomtom.com/search/2/geocode/' + this.lastSearches.inputSearch,
            {
                params: {
                    key : '9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx' 
                }
            }).then((result) => {
                console.log(result);
            }).catch((err) => {
                console.log(err);
            });
        },
        getHouseType(){
            axios.get('http://127.0.0.1:8000/api/housetypes')
            .then(res => {
                console.log(res.data);
                this.houseTypes = res.data;
            }).catch(err => {
                console.log('type', err)
            });
        },
        performSearch(searchData) {
            if(this.lastSearches.inputSearch == searchData.inputSearch && this.lastSearches.km == searchData.km && this.lastSearches.rooms == searchData.rooms && this.lastSearches.services == searchData.services || searchData.inputSearch == '') {
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
                this.lastSearches.inputSearch = searchData.inputSearch;
                this.lastSearches.km = searchData.km;
                this.lastSearches.rooms = searchData.rooms;
                this.lastSearches.beds = searchData.beds;
                this.lastSearches.services = searchData.services;
                this.$router.push('/appartments').catch(()=>{});
                this.getCoordinates();
                console.log('res axios app', this.houses);

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
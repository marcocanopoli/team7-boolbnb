<template>
    <div>
        <Header 
            @search="performSearch"
            @handleLogout="logout"
            :houses="houses"
            :currentSearch="currentSearch"
            :allServices="allServices"
            :user="user"/>
        <router-view class="main"
            @search="performSearch"
            @emptySearch="emptySearch"
            :user="user"
            :houses="houses"
            :currentSearch="currentSearch"
            :last_page="last_page"           
            :current_page="current_page"           
            :loading="loading"
            :searchCoordinates="searchCoordinates">
        </router-view>
        <Footer />
    </div>
</template>

<script>
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'
import Home from './pages/Home.vue'
import Apartments from './pages/Apartments.vue'

export default {
  components: { 
        Header,
        Footer,
        Home,
        Apartments
    },
    data(){
        return{
            houses: [],
            // sponsoredHouses: [],
            allServices: [],
            user: {},
            searchCoordinates: {},
            loading:  false,

            currentSearch: {
                inputSearch : "",
                rooms: 1,
                beds: 1,
                services: '',
                km: 20,
                page: '',
            },
            current_page: 1,
            last_page: 1,
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
                        // console.log('Unauthorized user');
                        this.user = null;     
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
        getServices() {
            axios.get('api/services')
            .then(res => {
                this.allServices = res.data;
            }).catch(err => {
                console.log('Service error: ', err)
            });
        },
        // splitMergeSponsored(array) {
        //     array.forEach((house, index) => {
        //         let lastPromotion = house.promotions[house.promotions.length - 1];
        //         let now = new Date();
        //         if(lastPromotion) {
        //             let endDateString = lastPromotion.pivot.end_date;
        //             let endDate = new Date(endDateString);
        //             if(endDate > now) {
        //                 this.sponsoredHouses.push(house);
        //                 this.houses.splice(index, 1);
        //             }
        //         }
        //     })
        //     this.houses = this.sponsoredHouses.concat(this.houses);
        //     this.sponsoredHouses = [];
        // },
        emptySearch() {
            this.currentSearch.inputSearch = '';
        },  
        performSearch(searchData) {

            this.loading = true;
            // light search
                      
            if(searchData.length == 1) {
                let inputSearch = searchData[0]
                searchData = {};  //if single search input
                searchData.inputSearch = inputSearch ; //assign to inputSearch
                searchData.km = 20;
                searchData.rooms = 1;
                searchData.beds = 1;
                searchData.services = '';
                searchData.page = 1;
            }

            if(searchData.inputSearch == '') {
                // JSON.stringify(this.currentSearch) === JSON.stringify(searchData)  
                // || searchData.inputSearch == '') {
                // console.log(JSON.stringify(this.currentSearch));
                // console.log(JSON.stringify(searchData));
                    // alert('Stai già visualizzando questa ricerca!');
                this.loading = false;
                return
            }

            let queryObj = {
                search: searchData.inputSearch,
                ...(searchData.km ? {km: searchData.km } : {} ),
                ...(searchData.rooms ? {rooms: searchData.rooms } : {} ),
                ...(searchData.beds ? {beds: searchData.beds } : {} ),
                ...(searchData.services ? {services: searchData.services } : {} ),
                ...(searchData.page ? {page: searchData.page } : {} )
            };

            axios.get('api/search', {
                params: queryObj
                // params: {
                //     search: searchData.inputSearch,
                //     ...(searchData.km ? {km: searchData.km } : {} ),
                //     ...(searchData.rooms ? {rooms: searchData.rooms } : {} ),
                //     ...(searchData.beds ? {beds: searchData.beds } : {} ),
                //     ...(searchData.services ? {services: searchData.services } : {} )
                // }      
            }).then(res => {
                console.log('Chiamata API ricerca', res)
                this.houses = res.data.data;
                // this.splitMergeSponsored(this.houses);

                this.currentSearch = searchData;
                this.current_page = res.data.current_page; 
                this.last_page = res.data.last_page;

                this.$router.push(
                    {
                        name: 'apartments',
                        query: queryObj
                    }
                    ).catch(()=>{});


                this.loading = false;
                this.getCoordinates();

            })
            .catch(error => {
                console.error('Errore:', error);
                this.loading = false;
            });
        },
        getCoordinates(){
            const currentAxios = axios.create();
            currentAxios.defaults.headers.common = {};
            currentAxios.defaults.headers.common.accept = 'application/json';

            currentAxios.get(`https://api.tomtom.com/search/2/geocode/${this.currentSearch.inputSearch}.json`,
            {
                params: {
                    key : 'MAy8CruNqMtQAbImXBd9FqGR76Ch0nGA',
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
        logout() {
            if(confirm('Sei sicuro di voler fare il logout?')) {
                axios.post('/logout')
                    .then(() => {
                        this.user = null;
                        alert('Logout effettuato, a presto!')
                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response);                        
                        } else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.log('Error', error.message);
                        }
                    });
            }
        }
    },
    created() {
        this.getUser();
        this.getServices();
    },
}
</script>

<style lang='scss'>

    @import '../sass/partials/general.scss';
    @import '../sass/partials/variables.scss';

    .main {
        min-height: calc(100vh - #{$footerHeight});
    }
</style>
<template>
    <section class="home">
        <div class="jbt">            
            <!-- <strong>Non sai dove andare? Nessun problema!</strong>
            <a class="bnb-a" href="">
                <span>Sono flessibile</span>
            </a> -->
            <v-light-search                
                :currentSearch="currentSearch"
                v-on="$listeners" 
                v-if="scrollZero"/>
        </div>
        <div class="home-content">
            <!-- sponsored -->
            <div class="container">                
                <h2 class="mb-4">In evidenza</h2>

                <div class="sponsored bnb-cards-container mb-4">
                    <flat-card 
                        v-for="house in houses" 
                        :key="house.id"
                        :house="house"/>
                </div>

                <v-pagination
                    @getSponsored="getSponsored"
                    :last_page="last_page"
                    :current_page="current_page"
                    />
            </div>
            <!-- /sponsored -->
        </div>
    </section>
</template>

<script>
import VPagination from '../components/VPagination.vue';
import VLightSearch from '../components/VLightSearch.vue';
import FlatCard from '../components/FlatCard.vue'
export default {
    name: 'Home',
    components: {
        FlatCard,
        VPagination,
        VLightSearch
    },
    data() {
        return {
            houses: '',            
            current_page: 1,
            last_page: 1,
            scrollZero: true
        }
    },
    props: {
        currentSearch: Object
    },
    methods: {        
        getSponsored(page = 1) {
            axios.get(`api/sponsored?page=${page}`)
            .then(res => {
                this.houses = res.data.data;
                this.current_page = res.data.current_page; 
                this.last_page = res.data.last_page;
            })
            .catch(error => {
                console.error('Errore:', error);
            });
        },
         setScroll () {
            if (window.scrollY > 0 ) {
                this.scrollZero = false
            } else if (window.scrollY == 0) {
                this.scrollZero = true
            }
        } 
    },
    created () {
        window.addEventListener('scroll', this.setScroll);
        this.getSponsored();
    },
    updated() {
        this.currentSearch = this.currentSearch;
    },
    destroyed () {
        window.removeEventListener('scroll', this.setScroll);
    } 
}
</script>

<style lang="scss"> 
    @import '../../sass/partials/variables.scss';

    .home {

        .jbt {
           display: flex;
           flex-direction: column;
           justify-content: center;
           align-items: center;
           width: 100%;
           height: 100vh;
           background-image: url('/images/bg-bool.png');
           background-size: cover;
           background-position:  0 60% ;

            strong {
                text-align: center;
            }
    
        //    a {
        //        margin: 10px 0;
        //        padding: 22px 56px;
        //        border-radius: 54px;
        //        background-color: $white;
        //        transition: 0.2s;
   
        //        &:hover {
        //            box-shadow: 0 0 5px 2px rgba($gray-1, 0.2);
        //        }
   
        //        span {
        //            font-weight: 700;
        //            background: $primary-h;
        //            background-clip: text;
        //            -webkit-background-clip: text;
        //            -webkit-text-fill-color: transparent;
        //        }
        //    }
        }
        .home-content {
            position: relative;
            padding: 36px 0 56px 0;

            &::before {
                content: ' ';
                display: block;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                opacity: 0.2;
                background-image: url('/images/bg-travels.jpg');
                background-size: 25%;
                background-color: rgba($white, .2);
            }

            h2 {
                font-size: 47px;
                text-align: center;
            }

            .container {
                position: relative;
            }
            .sponsored {
                grid-template-columns: repeat(1, 1fr);
                grid-template-rows: auto;
                gap: 60px;            
            }
        }
    }

    @media screen and (min-width: 768px) {

        .home .home-content {
            .sponsored{
                grid-template-columns: repeat(2, 1fr);
            }
        }
    }

    @media screen and (min-width: 992px) {

        .home .home-content {
            .sponsored{
                grid-template-columns: repeat(3, 1fr);
            }
        }
    }


</style>
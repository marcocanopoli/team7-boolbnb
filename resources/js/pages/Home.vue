<template>
    <section class="home">
        <div class="jbt">
            <strong>Non sai dove andare? Nessun problema!</strong>
            <a class="bnb-a" href="">
                <span>Sono flessibile</span>
            </a>
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
import FlatCard from '../components/FlatCard.vue'
export default {
    name: 'Home',
    components: {
        FlatCard,
        VPagination
    },
    data() {
        return {
            houses: '',            
            current_page: 1,
            last_page: 1,
        }
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
        }
    },
    created() {
        this.getSponsored();
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
           background-image: url(https://a0.muscache.com/im/pictures/57b9f708-bb12-498c-bc33-769f8fc43e63.jpg?im_w=960);
           background-size: cover;
           background-position:  0 60% ;
   
           a {
               margin: 10px 0;
               padding: 22px 56px;
               border-radius: 54px;
               background-color: $white;
               transition: 0.2s;
   
               &:hover {
                   box-shadow: 0 0 5px 2px rgba($gray-1, 0.2);
               }
   
               span {
                   font-weight: 700;
                   background: $primary-h;
                   background-clip: text;
                   -webkit-background-clip: text;
                   -webkit-text-fill-color: transparent;
               }
           }
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
            .container {
                position: relative;

                .sponsored {
                    grid-template-columns: repeat(3, 1fr);
                    grid-template-rows: auto;
                    gap: 60px;            
                }
            }
        }
    }


</style>
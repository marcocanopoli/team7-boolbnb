<template>
    <section class="home">
        <div class="jbt">
            <strong>Non sai dove andare? Nessun problema!</strong>
            <a class="bnb-a" href="">
                <span>Sono flessibile</span>
            </a>
        </div>
        <div class="w-75 m-auto py-4">
            <h2 class="mb-4">In evidenza</h2>
            <div class="sponsored bnb-cards-container">
                <!-- <flat-card :flat="house"/> -->
                <flat-card />
                <flat-card />
                <flat-card />
                <flat-card />
            </div>
        </div>
    </section>
</template>

<script>
import FlatCard from '../components/FlatCard.vue'
export default {
    name: 'Home',
    components: {
        FlatCard
    }
}
</script>

<style lang="scss" scoped> 
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

        .sponsored {
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto;
            gap: 30px;            
        }
    }


</style>
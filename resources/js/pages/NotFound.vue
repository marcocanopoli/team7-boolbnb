<template>
    <section class="d-flex justify-content-center align-items-center flex-column text-center">
        <h3>Ops . . .</h3>
        <img src="https://static.vecteezy.com/ti/vettori-gratis/p1/2377862-felice-vacanza-illustrazione-di-donna-che-prende-il-sole-sulla-spiaggia-con-ombrellone-ancora-facendo-il-lavoro-libero-professionista-vacanza-disegno-puo-essere-usato-per-poster-banner-annuncio-sito-web-web-mobile-vettoriale.jpg" alt="404">
        <h3>Non è questo il posto migliore per una vacanza . . .</h3>
        <span>404</span>
        <span>Not found</span>
    </section>
</template>

<script>
export default {
    name: 'NotFound'
}
</script>

<style lang="scss" scoped>
@import '../../sass/partials/variables.scss';

    section {
        color: $brand;
        height: 100%;
        padding-top: $headerHeight;

        img {
            width: 30%;
        }
    }
</style>
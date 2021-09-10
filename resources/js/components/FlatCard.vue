<template>
    <div class="flat-card bnb-card shadow">
        <img src="https://mammaioparto.com/wp-content/uploads/2020/04/mettere-il-soggetto-al-centro.jpg" alt="">
        <div class="flat-info">
            <h4>Titolo</h4>
            <h5>ospiti</h5>
            <h6>price</h6>
            <span>price</span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FlatCard'
}
</script>

<style lang="scss">

    .flat-card {
        height: 300px; //da togliere
        position: relative;
        overflow: hidden;

        &:hover {
        cursor: pointer;
        }

        img {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .flat-info {
            padding: 24px;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

    }

</style>
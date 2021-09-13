<template>
    <router-link 
        :to="{ name: 'flat', params: { house_id : house.id }}"
        class="flat-card bnb-card shadow">
        <div class="img-box mb-3">
            <img :src="'storage/' + house.photos[0].path" :alt="'Foto' + house.photos[0].id">
            <h5>{{ house.title }}</h5>
        </div>
        <div class="flat-info">
            <h6 class="color-brand">{{ house.city }}</h6>
            <h6>{{ house.guests }} ospiti</h6>
            <span>&euro;{{ house.price }} per notte</span>
        </div>
    </router-link>
</template>

<script>
export default {
    name: 'FlatCard',
    props: {
        house: Object
    }
}
</script>

<style lang="scss">
    @import '../../sass/partials/_variables.scss';
    
    .flat-card {
        position: relative;
        overflow: hidden;

        &:hover {
        cursor: pointer;
        }

        .img-box {
            position: relative;
            width: 100%;

            &:after {
                content: "";
                display: block;
                padding-bottom: 100%;
            }

            img {
                position: absolute;
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                border-radius: 4px;
            }

            h5 {
                position: absolute;
                margin-bottom: 0;
                bottom: 0;
                padding: 8px;
                background: rgba($white, 0.7);
            }
        }

        // .flat-info {
        //     padding: 24px;
        //     position: absolute;
        //     width: 100%;
        //     height: 100%;
        //     top: 0;
        //     left: 0;
        // }

    }

</style>
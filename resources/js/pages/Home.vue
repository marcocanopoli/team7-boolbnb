<template>
    <section>
        <div class="jbt">
            <strong>Non sai dove andare? Nessun problema!</strong>
            <a class="bnb-a" href="">
                <span>Sono flessibile</span>
            </a>
        </div>
        <div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, dolor corporis? Vero provident itaque labore voluptatem magnam quas repudiandae optio est, consectetur hic culpa amet debitis, perferendis earum velit laboriosam. Sed, provident. Officiis magnam itaque, consectetur aut quaerat quia architecto eveniet voluptates ad ducimus a minus reiciendis asperiores iusto perferendis? Quidem reprehenderit rerum distinctio culpa harum rem natus optio hic! Dolor cupiditate animi maiores minima ex molestiae alias voluptatum totam at, accusantium dolores. Itaque ad qui blanditiis, ducimus fugiat eum dolor totam neque error ratione excepturi porro, voluptatibus necessitatibus, non commodi mollitia doloribus. Voluptatum, ducimus quia. Recusandae temporibus maxime quaerat doloribus aspernatur impedit totam saepe ad doloremque, quo error exercitationem? Suscipit, quas fugit velit repudiandae corrupti blanditiis nam voluptates tenetur earum, nisi officiis, ea perspiciatis quaerat modi sit culpa cum nobis vel consequuntur asperiores vitae amet voluptatum. Minus, similique qui aliquid nemo, consectetur soluta unde nostrum recusandae praesentium molestias modi!
        </div>
    </section>
</template>

<script>
export default {
    name: 'Home',

}
</script>

<style lang="scss" scoped> 
    @import '../../sass/partials/variables.scss';
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


</style>
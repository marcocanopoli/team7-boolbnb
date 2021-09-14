<template>
    <footer class="bnb-footer">
        <div class="mt-2">&copy; 2021 Team 7</div>
        <ul>
            <li>
                <a href="https://github.com/marcocanopoli">Marco Canopoli</a>
            </li>
            <li>
                <a href="https://github.com/patriziosbr">Patrizio Sbrozzi</a>
            </li>
            <li>
                <a href="https://github.com/LucaQuacquarelli">Luca Quacquarelli</a>
            </li>
            <li>
                <a href="https://github.com/sbarbaroluca">Luca Sbarbaro</a>
            </li>
            <li>
                <a href="https://github.com/AleDesa98">Alessandro Desantis</a>
            </li>
        </ul>
    </footer>
</template>

<script>
export default {
    name: 'Footer'
}
</script>

<style lang="scss">
    @import '../../sass/partials/_variables.scss';

    .bnb-footer {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        height: $footerHeight;
        background-color: $white;
        box-shadow: 0 -4px 8px 4px rgba($black, 0.1);
        color: $gray-1;
        font-size: 14px;


        ul {
            display: flex;
            align-items: center;
            justify-content: center;
            list-style: none;

            li {
                &:not(:last-child)::after {
                    content: '\00B7';
                    padding: 0 8px;
                    font-weight: 700;
                }
                
                a {
                    text-decoration: none;
                    color: $gray-1;
                    transition: .2s;

                    &:hover {
                        color: $brand;
                        font-weight: 700;
                    }
                }
            }
        }
    }

</style>
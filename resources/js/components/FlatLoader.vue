<template>
    <div class="loader-container">
        <div class="loader d-flex justify-content-between">
            <div class="photo">
                <div class="slice"></div>
            </div>
            <div class="details">
                <div class="type">
                    <div class="slice"></div>
                </div>
                <div class="title">
                    <div class="slice"></div>
                </div>
                <div class="services">
                    <div class="slice"></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="loader d-flex justify-content-between">
            <div class="photo">
                <div class="slice"></div>
            </div>
            <div class="details">
                <div class="type">
                    <div class="slice"></div>
                </div>
                <div class="title">
                    <div class="slice"></div>
                </div>
                <div class="services">
                    <div class="slice"></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="loader d-flex justify-content-between">
            <div class="photo">
                <div class="slice"></div>
            </div>
            <div class="details">
                <div class="type">
                    <div class="slice"></div>
                </div>
                <div class="title">
                    <div class="slice"></div>
                </div>
                <div class="services"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FlatLoader'
}
</script>

<style lang="scss" scoped>
@import '../../sass/partials/variables.scss';
    .loader-container {
        width: 45%;
        padding: 50px;

        .loader {
            width: 100%;
            align-items: center;
            .photo {
                width: 40%;
                height: 150px;
                background-color: rgba($gray-1, 0.2);
                border-radius: 12px;
                overflow: hidden;
            }
            .slice {
                width: 5%;
                height: 135%;
                position: relative;
                top: -30px;
                box-shadow: 35px 0 15px 5px white;;
                transform: rotate(30deg);
                animation: bgchange 1s infinite;

            }
            @keyframes bgchange {
                0%   {left: 0;}
                100% {left: 100%;}
            }

            .details {
                width: 50%;

                .type,
                .title,
                .services {
                    margin: 30px 0;
                    height: 10px;
                    background-color: rgba($gray-1, 0.2);
                    border-radius: 12px;
                }

                .type {
                    width: 45%;
                }
                .services {
                    width: 60%;
                }
                
            }
        }
    }
</style>
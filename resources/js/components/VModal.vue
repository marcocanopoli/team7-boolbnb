<template>
    <transition name="modal-fade">
        <div class="bnb-modal-backdrop"
            @click.self="$emit('close')">
            <div class="bnb-modal shadow p-4">
                <button
                    type="button" 
                    class="btn-times mr-3" 
                    @click="$emit('close')">&times;
                </button>

                <slot name="header">
                </slot>

                <slot name="body">
                </slot>
                
                <slot name="footer">
                    
                </slot>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name : 'VModal'
}
</script>

<style lang="scss">

@import '../../sass/partials/_variables.scss';

.bnb-modal-backdrop {
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    inset: 0;
    background-color: rgba($black, 0.7);
    z-index: 99;  
    overflow-y: auto;  

    .bnb-modal {
        position: relative;
        width: 50vw;
        background-color: $white;
        transform: translateY(170px);
        border-radius: 30px;
        overflow-y: auto;  

        .btn-times {
            position: absolute;
            top: 0;
            right: 0;
            border: none;
            font-size: 36px;
            cursor: pointer;
            font-weight: 700;
            color: $brand;
        }
        
    }
}

    .modal-fade-enter,
    .modal-fade-leave-to {
        opacity: 0;
    }

    .modal-fade-enter-active,
    .modal-fade-leave-active {
        transition: opacity .5s ease;
    }

    @media screen and (max-width: 767px) {
        .bnb-modal-backdrop {
            padding: 16px 24px;
            .bnb-modal {
                width: 100%;
                transform: unset;
            }
        }
    }
    @media screen and (min-width: 768px) {
        .bnb-modal-backdrop {
            align-items: center;
            padding: 48px 48px;
            .bnb-modal {
                width: 100%;
                transform: unset;
            }
        }
    }

    @media screen and (min-width: 1200px) {
        .bnb-modal-backdrop {
            .bnb-modal {
                width: 50vw;
            }
        }
    }

</style>
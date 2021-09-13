<template>
    <transition name="modal-fade">
        <div class="bnb-modal-backdrop"
            @click.self="$emit('closeClear')">
            <div class="bnb-modal shadow p-4">
                <button
                    type="button" 
                    class="btn-times mr-3" 
                    @click="$emit('closeClear')">&times;
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

    .bnb-modal {
        width: 50vw;
        background-color: $white;
        transform: translateY(170px);
        border-radius: 30px;

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

</style>
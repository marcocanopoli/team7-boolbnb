<template>
    <section 
        v-if="last_page > 1"
        class="bnb-pagination">
        <button type="button" 
            class="pag-btn"
            :class="current_page == 1 ? 'disabled' : '' "
            :disabled="current_page == 1"
            @click="$emit('page', current_page - 1)">
            <span>
                <i class="fas fa-chevron-left"></i>
            </span>
        </button>
        <button type="button"
            v-for="n in last_page"
            :key="n" 
            class="pag-btn"
            :class="current_page == n ? 'active' : '' "
            @click="$emit('page', n )">
            {{ n }}
        </button>
        <button type="button" 
            class="pag-btn"
            :class="current_page == last_page ? 'disabled' : '' "
            :disabled="current_page == last_page"
            @click="$emit('page', current_page + 1 )">
            <span>
                <i class="fas fa-chevron-right"></i>
            </span>
        </button>
    </section>
</template>

<script>
export default {
    name: 'VPagination',
    props: {
        last_page: Number,
        current_page: Number
    }
}
</script>

<style lang="scss">
    // @import '../../sass/partials/_message.scss';
</style>
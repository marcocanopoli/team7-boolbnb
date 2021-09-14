<template>
    <section class="bnb-pagination">
        <button type="button" 
            class="bnb-btn bnb-btn-brand pag-btn"
            :class="current_page == 1 ? 'disabled-button' : '' "
            :disabled="current_page == 1"
            @click="$emit('getSponsored', current_page - 1)">Prev
        </button>
        <button type="button"
            v-for="n in last_page"
            :key="n" 
            class="bnb-btn bnb-btn-brand pag-btn"
            :class="current_page == n ? 'focus-button' : '' "
            @click="$emit('getSponsored', n )">{{ n }}
        </button>
        <button type="button" 
            class="bnb-btn bnb-btn-brand pag-btn"
            :class="current_page == last_page ? 'disabled-button' : '' "
            :disabled="current_page == last_page"
            @click="$emit('getSponsored', current_page + 1 )">Next
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
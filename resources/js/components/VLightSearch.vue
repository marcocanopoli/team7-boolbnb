<template>
    <section class="searchbar">
        <div class="search-element">
            <div class="d-flex flex-column">
                <span class="search-label">Dove</span>
                <input type="text" placeholder="Dove vuoi andare?"
                    v-model="searchData.inputSearch"
                    @keyup.enter="lightSearch">
            </div>
            <button class="search-btn" @click="$emit('search', lightSearch)"><i class="fas fa-search"></i></button>
        </div>  
    </section>
</template>

<script>
export default {
    name: 'VLightSearch',
    data() {
        return {
            searchData: {
                inputSearch: "",
                rooms: '',
                beds: '',
                services: '',
                km: ''
            }
        }
    },
    methods: {
        lightSearch() {
            this.$emit('search', [this.searchData.inputSearch]);
            for (let key in this.searchData) {
                this.searchData[key] = '';
            }
        },
    },
    props: {
        lastSearch: Object
    },
    mounted() {
        this.searchData = this.lastSearch;
    }
}
</script>

<style lang="scss" scoped>

    @import '../../sass/partials/_variables.scss';

    .search-element{
        &:hover {
            background-color: $white;
            input {
                background-color: $white;
            }
        }
    }


</style>
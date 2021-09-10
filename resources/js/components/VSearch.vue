<template>
        <section class="searchbar">

            <div class="search-element">
                <span class="search-label">Dove</span>
                <input type="text" placeholder="Dove vuoi andare?"
                    v-model="searchData.inputSearch"
                    @keyup.enter="$emit('search', searchData)">
            </div>

            <div class="search-element">
                <span class="search-label">Camere</span>
                <input type="number" min="1" name="rooms" placeholder="Quante camere?" 
                    v-model="searchData.rooms"
                    @keyup.enter="$emit('search', searchData)">
            </div>

            <div class="search-element">
                <span class="search-label">Letti</span>
                <input type="number" min="1" name="beds" placeholder="Quanti letti?" 
                    v-model="searchData.beds"
                    @keyup.enter="$emit('search', searchData)">
            </div>

            <div class="search-element">
                <div class="d-flex flex-column">
                    <span class="search-label">Km</span>
                    <input type="number" min="1" name="km" placeholder="Raggio?"
                        v-model="searchData.km"
                        @keyup.enter="$emit('search', searchData)">
                </div>
                <button class="search-btn" @click="$emit('search', searchData)"><i class="fas fa-search"></i></button>
            </div>

    </section>
</template>

<script>
export default {
    name: 'VSearch',
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
    }
}
</script>

<style lang="scss"> 
        
</style>
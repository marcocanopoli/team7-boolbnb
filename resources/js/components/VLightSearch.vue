<template>
<div class="position-relative">
    <section class="searchbar">
        <div class="search-element">
            <div class="d-flex flex-column">
                <span class="search-label">Dove</span>
                <input type="text" placeholder="Dove vuoi andare?"
                    v-model="searchData.inputSearch"
                    @keyup.enter="lightSearch"
                    @keyup="getLocation">
            </div>
            <button class="search-btn" @click="lightSearch"><i class="fas fa-search"></i></button>
        </div>  
    </section>
    <ul v-if="cities.length > 0" id="sizelist">
        <li v-for="(city, index) in cities" :key="city.id"
        :class="{'active': active === index}"
        v-show="city.address.municipality"
        @click="setLocation(city.address.freeformAddress,city.address.countrySubdivision,city.address.countryCode)">
            {{city.address.freeformAddress}}, {{city.address.countrySubdivision}}, {{city.address.countryCode}}
        </li>
    </ul>
</div>
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
            },
            cities: [],
            active: 0
        }
    },
    methods: {
        lightSearch() {
            this.$emit('search', [this.searchData.inputSearch]);
            for (let key in this.searchData) {
                this.searchData[key] = '';
            }
        },
        getLocation() {
            const currentAxios = axios.create();
            currentAxios.defaults.headers.common = {};
            currentAxios.defaults.headers.common.accept = 'application/json';

            if (this.searchData.inputSearch.length >= 2) {
                
                currentAxios.get(`https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IT&municipality=${this.searchData.inputSearch}&language=it-IT&key=9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx`)
                
                .then(
                    res => {
                        this.cities = res.data.results
                    }
                )
            } else if (this.searchData.inputSearch.length < 2) {
                this.cities = []
            }

        },
        setLocation(city,country,state) {
            this.searchData.inputSearch = `${city}, ${country}, ${state}`;
            this.cities = []
        },
        closeAutoComplete() {
            this.searchData.inputSearch = ''
            this.cities = []
        },
        nextItem () {
    	    if (event.keyCode == 38 && this.active > 0) {
      	        this.active--
            } else if (event.keyCode == 40 && this.active < this.cities.length -1) {
      	        this.active++
            }
        }
    },
    mounted () {
        document.addEventListener("keyup", this.nextItem);
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
    ul {
        position: absolute;
        top: 65px;
        left: 0;
        list-style: none;
        padding: 0;
        border: 1px solid rgba($gray-1, 0.3);
        border-radius: 12px;
        overflow: hidden;
        background-color: $white;

        li {
            padding: 5px 10px;
            cursor: pointer;

            &:hover,
            &.active {
                background-color: rgba($gray-1, 0.1);
            }
        }
    }

</style>
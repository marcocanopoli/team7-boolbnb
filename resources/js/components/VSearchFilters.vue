<template>
    <div class="position-relative">
        <section class="searchbar">

                <div class="search-element">
                    <div class="input">
                        <span class="search-label">Dove</span>
                        <input type="text" placeholder="Dove vuoi andare?"
                            v-model="searchData.inputSearch"
                            @keyup.enter="$emit('search', searchData)">
                    </div>
                    <button id="filters" @click="toggleModal"><i class="fas fa-sliders-h"></i></button>
                    <button class="search-btn" @click="$emit('search', searchData)"><i class="fas fa-search"></i></button>
                </div>

                <v-modal 
                v-show="visibleModal"            
                @close="toggleModal">
                
                    <div slot="header">
                        <h4 class="mb-3">Ricerca avanzata</h4>
                    </div>

                    <div slot="body">
                        <div class="filters-box">
                            <div class="modal-filter">
                                <span class="filter-title">Dove</span>
                                <div class="filter-counter">
                                    <input type="text" placeholder="Dove vuoi andare?"
                                        v-model="searchData.inputSearch"
                                        @keyup.enter="closeSearch">
                                </div>
                            </div>
                            <div class="modal-filter">
                                <span class="filter-title">Camere</span>
                                <div class="filter-counter">
                                    <span class="filter-btn"
                                        @click="searchData.rooms--">-</span>
                                    <span class="filter-value" @change="$emit('search', searchData)">{{searchData.rooms}}</span>
                                    <span class="filter-btn"
                                        @click="searchData.rooms++">+</span>
                                </div>
                            </div>

                            <div class="modal-filter">
                                <span class="filter-title">Letti</span>
                                <div class="filter-counter">                                
                                    <span class="filter-btn"
                                        @click="searchData.beds--">-</span>
                                    <span class="filter-value" @change="$emit('search', searchData)">{{searchData.beds}}</span>
                                    <span class="filter-btn"
                                        @click="searchData.beds++">+</span>
                                </div>
                            </div>
                            
                            <div class="modal-filter">
                                <span class="filter-title">Km</span>
                                <div class="filter-counter">
                                    <input type="text" placeholder="Raggio?"
                                        v-model="searchData.km"
                                        @keyup.enter="closeSearch">
                                </div>
                            </div>

                        </div>

                        <h4 class="my-3">Servizi inclusi</h4>

                        <div class="services pt-2 pb-4">
                            <div class="service-pill"
                                v-for="service in allServices" :key="service.id"
                                @click="checkService(service.id)" :id="'service-' + service.id">
                                <div class="service-svg">
                                    <img :src="'images/services_icons/'+ service.icon" alt="icon">

                                </div>
                                <span class="service-name">{{service.name}}</span>                            
                            </div>
                        </div>
                    </div>

                    <div slot="footer"
                        class="text-right">
                        <div class="modal-buttons">                            
                            <button class="bnb-btn bnb-btn-brand" 
                                @click="closeSearch">
                                Mostra risultati
                            </button>
                            <button
                                type="button"
                                class="bnb-btn bnb-btn-brand"
                                @click="clear">Deseleziona tutti             
                            </button>
                        </div>
                    </div>
                </v-modal>

        </section>
    </div>
</template>

<script>
import VModal from './VModal.vue'
export default {
    name: 'VSearchFilters',
    components: {
        VModal
    },
    data() {
        return {
            searchData: {
                inputSearch: "",
                rooms: 1,
                beds: 1,
                services: '',
                km: '',
                page: ''
            },
            cities: [],
            active: 0,            
            checkedServices: [],
            visibleModal: false,
        }
    },
    props: [ 'currentSearch', 'allServices', 'houses'],
    methods: {
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
        checkService(service_id) {
            this.toggleService(service_id);
            if(this.checkedServices.includes(service_id)) {
                const index = this.checkedServices.indexOf(service_id);
                this.checkedServices.splice(index, 1);

            }else {
                this.checkedServices.push(service_id);
            }
            this.searchData.services = this.checkedServices;
            this.$emit('search', this.searchData);
        },
        toggleService(service_id) {
           const service = document.getElementById('service-' + service_id);
           if (service.classList.contains('pill-toggle')) {
               service.classList.remove("pill-toggle");
           }else {
               service.classList.add("pill-toggle");
           }
        },
        toggleModal() {
            this.visibleModal = !this.visibleModal;

            if(this.visibleModal) {

                if(this.searchData.beds == '') {
                    this.searchData.beds = 1;
                }
                if(this.searchData.rooms == '') {
                    this.searchData.rooms = 1;
                }
            }
        },
        clear() {
            this.searchData.services = [];
            this.checkedServices = [];
            let activePills = document.querySelectorAll(".pill-toggle");

            activePills.forEach( pill => {
                pill.classList.remove("pill-toggle");
            });

            this.$emit('search', this.searchData);
        },
        closeSearch() {
            this.$emit('search', this.searchData);
            this.toggleModal();
        }, 
    },
    watch: {
        $route(to, from) {
            this.searchData = this.currentSearch;
        },
    },
    created () {
        document.addEventListener("keyup", this.nextItem);
        this.searchData = this.currentSearch;
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/partials/variables.scss';

    .search-element {
        flex-direction: row;
        align-items: center;
        padding-right: 8px;

        .input {
            display: flex;
            flex-direction: column;
        }
    }

    #filters {
        i {
            font-size: 18px;
            font-weight: 700;
            color: $brand;

            &:hover {
                color: $brand-end;
            }
        }
    }

    .filters-box {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;

        .modal-filter {
            display: flex;
            padding: 8px 0;

            .filter-counter {
                width: 50%;
                display: flex;
                font-size: 14px; 

                input {
                    padding: 4px 0;                    
                    padding-left: 16px;
                    width: 100%;
                    border-radius: 30px;
                    outline: none;
                    border: 1px solid $gray-1;
                    transition: .2s;

                    &:focus {
                        border-color: $brand;
                    }
                }
            }

            .filter-title {
                font-weight: 700;
                color: $brand;
                width: 50%;
            }
            .filter-value {
                display: inline-block;
                width: 36px;
                text-align: center;
            }
            .filter-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 8px;                
                width: 24px;
                height: 24px;
                border-radius: 50%;
                font-weight: 700;
                font-size: 24px;
                border: 1px solid $gray-1; 
                color: $gray-1;
                cursor: pointer;
                user-select: none;
                transition: .2s;
                
                &:hover {
                    border-color: $brand; 
                    color: $brand;
                }
            }
        }        
    }

    .modal-buttons {
        display: flex;
        justify-content: flex-end;

        button {
            &:first-child {
                margin-right: 8px;
            }
            font-size: 12px;
        }
    }

    h4 {
        font-size: 24px;
    }
    .services {
        display: flex;
        flex-wrap: wrap;

        .service-pill {
            margin: 4px 0;            
            border-radius: 30px;
            border: 1px solid rgba($gray-1, 0.3);
            font-size: 14px;                
            background-color: $white;
            cursor: pointer;
            user-select: none;            
        }
        
        .pill-toggle{
            background-color: $brand;
            border-color: $brand;
            color: $white;

            img {
                filter: invert(1);
            }
        }
    }


    @media screen and (max-width: 767px) {

        .services {
            .service-pill {
                display: flex;
                align-items: center;
                margin-right: 8px;
                width: calc(50% - 8px);   
                padding: 4px 8px;
                font-size: 12px;
                
                &:nth-child(2n) {
                    margin-right: 0;
                    width: 50% 
                }

                img {
                    height: 12px;
                }


                .service-name {
                    white-space:nowrap;
                    overflow:hidden;
                    text-overflow: ellipsis;
                }
            }
        
            .pill-toggle{
                background-color: $brand;
                border-color: $brand;
                color: $white;

                img {
                    filter: invert(1);
                }
            }
        }

    }

    @media screen and (min-width: 768px) {

        .services {
            .service-pill {
                margin-right: 8px;
                width: calc(33.33% - 8px);   
                padding: 4px 8px;
                font-size: 12px;
                
                &:nth-child(3n) {
                    margin-right: 0;
                    width: 33.33%;
                }
            }
        }

    }

    @media screen and (min-width: 992px) {

        .services {
            .service-pill {
                width: calc(25% - 8px); 
                font-size: 14px;
                
                &:nth-child(3n) {
                    margin-right: 8px;
                    width: calc(25% - 8px); 
                }

                &:nth-child(4n) {
                    margin-right: 0;
                    width: 25%;
                }
            }
        }
    }
    @media screen and (min-width: 1200px) {

        .services {
            .service-pill {
                margin-right: 16px;   
                padding: 8px 16px;
                width: calc(33.33% - 16px);

                &:nth-child(3n) {
                    margin-right: 0;
                    width: 33.33%;
                }

                &:nth-child(4n) {
                    margin-right: 16px;
                    width: calc(33.33% - 16px);
                }
            }
        }
    }
   
</style>
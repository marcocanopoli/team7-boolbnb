import Vue from "vue";
import VueRouter from "vue-router";

import Home from './pages/Home';
import Apartments from './pages/Apartments';
import Flat from './pages/Flat';
import NotFound from './pages/NotFound.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    // linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            alias: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/apartments?:query_string',
            name: 'apartments',
            component: Apartments
        },
        {
            path: '/flat/:house_id',
            name: 'flat',
            component: Flat
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFound
        }
        
    ]
});

export default router;
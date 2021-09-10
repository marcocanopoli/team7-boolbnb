import Vue from "vue";
import VueRouter from "vue-router";

import Home from './pages/Home';
import Apartments from './pages/Apartments';
import Auto from './pages/Auto';
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
            path: '/apartments',
            name: 'apartments',
            component: Apartments
        },
        {
            path: '/auto',
            name: 'auto',
            component: Auto
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFound
        }
        
    ]
});

export default router;
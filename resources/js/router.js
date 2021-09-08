import Vue from "vue";
import VueRouter from "vue-router";

import Home from './pages/Home';
import Apartments from './pages/Apartments';

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
        }
        
    ]
});

export default router;
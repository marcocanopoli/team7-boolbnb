import Vue from "vue";
import VueRouter from "vue-router";

import Home from './pages/Home';
import Appartments from './pages/Appartments';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    // linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            alias: '/home',
            name: 'Home',
            component: Home
        },
        {
            path: '/appartments',
            name: 'Appartments',
            component: Appartments
        }
        
    ]
});

export default router;
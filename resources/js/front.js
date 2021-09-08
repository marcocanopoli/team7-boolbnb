window.Vue = require('vue');
window.axios = require('axios');


window.axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
// window.axios.defaults.headers.get['header-name'] = 'value';
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import App from './App.vue';
import router from './router.js';

const app = new Vue(
    {
        el: '#root',
        render: h => h(App),
        router
    }
);

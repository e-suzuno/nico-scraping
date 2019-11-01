
require('./bootstrap');

require('select2');

window.Vue = require('vue');


import Vue from 'vue';
import router from './router';

import config from './config'
window.config = config;


import App from './components/App/App.vue'


new Vue({
    router, //追加
    render: h => h(App)
}).$mount('#app')


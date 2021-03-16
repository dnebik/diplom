require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'

Vue.config.devtools = false;
Vue.config.productionTip = false;

import router from "./routes";
const app = new Vue({
    el: '#app',
    router
});

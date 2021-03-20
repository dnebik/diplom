require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'

Vue.config.devtools = false;
Vue.config.productionTip = false;

Vue.component('top', require('./components/Header').default);

import router from "./routes";
const app = new Vue({
    el: '#app',
    data() {
        return {
            path: window.location.origin,
        }
    },
    router,
});

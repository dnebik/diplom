require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'


const DEFAULT_TITLE = 'Document Server';


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
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                console.log(to.matched);
                document.title = '';
                for (let i = 0; i < to.matched.length; i++)
                {
                    if (typeof to.matched[i]['meta']['title'] !== "undefined")
                        document.title = to.matched[i]['meta']['title'] + ' | ' + document.title;
                }
                if (document.title !== '') document.title = document.title + ' ' + DEFAULT_TITLE;
                else document.title = DEFAULT_TITLE;
            }
        },
    },
    router,
});

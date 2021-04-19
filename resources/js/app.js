require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'


const DEFAULT_TITLE = 'DocumentController Server';


Vue.config.devtools = false;
Vue.config.productionTip = false;


Vue.component('top', require('./components/Header').default);
Vue.component('navigate', require('./components/content/UI/Navigation').default);


import router from "./routes";

router.beforeEach(async (to, from, next) => {
    await Vue.nextTick();
    if (router.app.user === null)
    {
        await router.app.isAuthed()
            .then(value => {
                router.app.user = value;
            })
            .catch(reason => {
                router.app.user = null;
            })
    }

    if (router.app.user !== null)
    {
        if (to.name === 'auth')
        {
            if (from !== null) next(from);
            else next({name: 'docs'});
        }
        else next();
    }
    else if (to['meta']['guest']) next();
    else next({ name: 'auth' });
})

const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
            path: window.location.origin,
            user: null,
        }
    },
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
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
    methods: {
        isAuthed() {
            return new Promise((resolve, reject) => {
                axios.post('/user', {})
                    .then(value => {
                        if (value['data']['status']['code'] == 0) {
                            resolve(value['data']['user'])
                        } else {
                            reject(value['data']['status']['text'])
                        }
                    })
                    .catch(reason => {
                        reject(reason)
                    })
            })
        },
        logout() {
            let req = axios.post('/user/logout');
            req.then(value => {
                if (value['data']['status']['code'] == 0) {
                    app.user = null;
                    router.push({name: 'auth'});
                } else {
                    return(value['data']['status']['text']);
                }
            });
            req.catch(reason => {
                return(reason)
            });
        }
    },
});

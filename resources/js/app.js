require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'

import VCalendar from 'v-calendar';
Vue.use(VCalendar, {
    componentPrefix: 'v',
});
// Vue.use(dateformat);

const DEFAULT_TITLE = 'Document Server';


Vue.config.devtools = false;
Vue.config.productionTip = false;


Vue.component('top', require('./components/Header').default);
Vue.component('navigate', require('./components/content/UI/Navigation').default);
Vue.component('loading', require('./components/content/UI/Loading').default);
Vue.component('modal', require('./components/content/UI/Modal').default);


import router from "./routes";

router.beforeEach(async (to, from, next) => {
    await Vue.nextTick();
    if (router.app.user === null)
    {
        router.app.loaded = false;
        await router.app.isAuthed()
            .then(value => {
                router.app.user = value;
            })
            .catch(reason => {
                router.app.user = null;
            })
            .finally(() => {
                router.app.loaded = true;
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
    else {
        if (to !== null)
            next({ name: 'auth', params: {redirect: to} });
        else
            next({ name: 'auth' });
    }
})

const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
            path: window.location.origin,
            user: null,
            loaded: true,
            modal_opened: false,
            new_reviews: [],
            last_doc: null,
        }
    },
    watch: {
        user() {
            this.new_reviews = [];
        },
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
        watchReview() {
            clearTimeout(this.timer_review);
            let request = axios.post('/docs/new_review');

            request.then(value => {
                if (value['data']['reviews']) {

                    if (JSON.stringify(value['data']['reviews']) !== JSON.stringify(this.new_reviews))
                        this.new_reviews = value['data']['reviews'];
                }
                else this.new_reviews = [];
            });

            request.catch(reason => {console.log(reason)});

            request.finally(() => {
                this.timer_review = setTimeout(() => {
                    this.watchReview();
                }, 20 * 1000)
            });
        },
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

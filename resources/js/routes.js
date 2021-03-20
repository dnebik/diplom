import vueRouter from 'vue-router';
import Vue from "vue";

Vue.use(vueRouter);
import example from "./components/example";

import Documents from "./components/content/Documents";
import MyDocuments from "./components/content/Documents/MyDocuments";
import Requests from "./components/content/Documents/Requests";
import History from "./components/content/Documents/History";
import Search from "./components/content/Documents/Search";


const routes = [
    {
        path: '/documents',
        name: 'docs',
        component: Documents,
        meta: {title: 'Документы'},
        children: [
            { path: '/', redirect: 'my_docs' },
            { path: 'my_docs', name: 'my_docs', component: MyDocuments },
            { path: 'requests', name: 'requests', component: Requests },
            { path: 'history', name: 'history', component: History },
            { path: 'search', name: 'search', component: Search },
        ]
    },

    { path: '/non-existing', component: example },
    { path: '*', redirect: '/non-existing'},
]

export default new vueRouter({
    mode: "history",
    routes
});

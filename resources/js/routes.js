import vueRouter from 'vue-router';
import Vue from "vue";

Vue.use(vueRouter);
import Auth from "./components/content/Auth";

import Documents from "./components/content/Documents";
import MyDocuments from "./components/content/Documents/MyDocuments";
import Requests from "./components/content/Documents/Requests";
import History from "./components/content/Documents/History";
import Search from "./components/content/Documents/Search";
import NonExisting from "./components/content/NonExisting";

import Audio from "./components/content/Audio";

import Monitoring from "./components/content/Monitoring";

const routes = [
    {
        path: '/documents',
        name: 'docs',
        component: Documents,
        meta: {title: 'Документы'},
        children: [
            { path: '/', redirect: 'my_docs' },
            { path: 'my_docs', name: 'my_docs', meta: {title: 'Мои Документы'}, component: MyDocuments },
            { path: 'requests', name: 'requests', meta: {title: 'Запросы'},component: Requests },
            { path: 'history', name: 'history', meta: {title: 'История'},component: History },
            { path: 'search', name: 'search', meta: {title: 'Поиск'},component: Search },
        ]
    },

    {
        path: '/auth',
        name: 'auth',
        component: Auth,
        meta: {title: 'Вход'},
    },

    {
        path: '/audio',
        name: 'audio',
        component: Audio,
        meta: {title: 'Аудио'},
    },

    {
        path: '/monitoring',
        name: 'monitoring',
        component: Monitoring,
        meta: {title: 'Мониторинг'},
    },

    { path: '/non-existing', component: NonExisting },
    { path: '*', redirect: '/non-existing'},
]

export default new vueRouter({
    mode: "history",
    routes
});

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
import LoadDocument from "./components/content/Documents/LoadDocument";

import Audio from "./components/content/Audio";

import Monitoring from "./components/content/Monitoring";

const routes = [
    {
        path: '',
        redirect: {name: 'docs'}
    },

    {
        path: '/documents',
        component: Documents,
        meta: {title: 'Документы', guest: false},
        children: [
            { path: '', redirect: {name: 'docs'} },
            { path: 'my_docs', name: 'docs', component: MyDocuments },
            { path: 'requests', name: 'requests', meta: {title: 'Запросы'},component: Requests },
            { path: 'history', name: 'history', meta: {title: 'История'},component: History },
            { path: 'search', name: 'search', meta: {title: 'Поиск'},component: Search },
            { path: 'load', name: 'load', meta: {title: 'Загрузка'},component: LoadDocument },
        ]
    },

    {
        path: '/auth',
        name: 'auth',
        component: Auth,
        meta: {title: 'Вход', guest: true},
    },

    {
        path: '/audio',
        name: 'audio',
        component: Audio,
        meta: {title: 'Аудио', guest: false},
    },

    {
        path: '/monitoring',
        name: 'monitoring',
        component: Monitoring,
        meta: {title: 'Мониторинг', guest: false},
    },

    { path: '/non-existing', component: NonExisting, meta: {title: '404', guest: false} },
    { path: '*', redirect: '/non-existing', meta: {guest: false}},
]

export default new vueRouter({
    mode: "history",
    routes
});

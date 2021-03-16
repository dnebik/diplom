import vueRouter from 'vue-router';
import Vue from "vue";

Vue.use(vueRouter);
import example from "./components/example";

const routes = [
    { path: '/non-existing', component: example },
    { path: '*', redirect: '/non-existing'},
]

export default new vueRouter({
    mode: "history",
    routes
});

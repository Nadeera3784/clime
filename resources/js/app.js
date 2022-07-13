import Vue from 'vue';
import VueRouter from 'vue-router'

import AppComponent from './components/App.vue';
import Dashboard from './components/Dashboard/Dashboard.vue';
import Appconfig from './config';

Vue.use(VueRouter, {linkActiveClass: "active"});

Vue.prototype.$base_url = Appconfig.base_url;

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
          path: '/',
          redirect: '/home'
        },
        {
            path: '/home',
            name: 'home',
            component: Dashboard
        }        
    ],
}) 

new Vue({
    router,
    render: root => root(AppComponent),
}).$mount('#app');

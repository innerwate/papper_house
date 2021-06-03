/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import Vue from 'vue';
import auth from '@websanova/vue-auth/dist/v2/vue-auth.esm.js';
import driverAuthBearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
import driverOAuth2Google from '@websanova/vue-auth/dist/drivers/oauth2/google.esm.js';
import driverOAuth2Facebook from '@websanova/vue-auth/dist/drivers/oauth2/facebook.esm.js';
import VueRouter from 'vue-router';
import routes from './router/routes.js'
import JwPagination from 'jw-vue-pagination';
import axios from "axios";
import VueAxios from 'vue-axios'
import store from "./store/store.js";
import { MdButton, MdContent, MdTabs, MdProgress, MdIcon } from 'vue-material/dist/components'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(MdButton)
Vue.use(MdContent)
Vue.use(MdTabs)
Vue.use(MdProgress)
Vue.use(MdIcon)
//import config from "./config";
//import header from './components/header.vue';
Vue.component('jw-pagination', JwPagination);
Vue.component('example-component2', require('./components/navigation/MainNav.vue').default);
//Vue.component('custom-header', require('./components/header.vue').default);
Vue.use(VueRouter);
Vue.use(VueAxios, axios)
const router = new VueRouter({
    mode: 'history',
    routes // сокращённая запись для `routes: routes`
})
Vue.router = router
driverOAuth2Google.params.client_id = '547886745924-4vrbhl09fr3t771drtupacct6f788566.apps.googleusercontent.com';
driverOAuth2Facebook.params.client_id = '196729390739201';

Vue.use(auth, {
    plugins: {
        http: Vue.axios, // Axios
        // http: Vue.http, // Vue Resource
        router: Vue.router,
    },
    drivers: {
        auth: driverAuthBearer,
        http: driverHttpAxios,
        router: driverRouterVueRouter,
        oauth2: {
            google: driverOAuth2Google,
            facebook: driverOAuth2Facebook,
        }
    },
    options: {
        rolesKey: 'type',
        notFoundRedirect: { name: 'user-account' },
        registerData: { url: '/api/auth/signup', method: 'POST', redirect: '/sign-in' },
        loginData: { url: '/api/auth/signin', method: 'POST', redirect: '/poems' },
        logoutData: { url: '/api/auth/logout', method: 'POST', redirect: '/sign-in'},
        fetchData: { url: '/api/auth/user', method: 'GET' },
    }
});
const ex = new Vue({
    el: '#example',
    store,
    router: router,
    //config: config
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//Vue.component('example-component2', require('./components/CustomAuth.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

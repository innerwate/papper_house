/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import Vue from 'vue';
import router from './routes.js'
import JwPagination from 'jw-vue-pagination';
import axios from "axios";
import header from './components/header.vue';


Vue.component('jw-pagination', JwPagination);
import Vuex from 'vuex';
Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        step: 0,
        count: 0,
        poems: [],
        currentPoem: '',
        token: localStorage.getItem('token') || '',
        status: '',
        userId: localStorage.getItem('user_id') || '',
        poemId: null,
        currentRating: null,
        avgRating: null
    },
    getters: {
        isAuthenticated: state => !!state.token,
        authStatus: state => state.status,
        userId: state => state.userId,
        poemId: state => state.poemId,
        currentRating: state => state.currentRating,
        avgRating: state => state.avgRating
    },
    computed: {
        poems() {
            return this.$store.state.poems;
        }
    },
    mutations: {
        AUTH_SUCCESS(state, token) {
            state.status = 'success';
            state.token = token;
        },
        AUTH_ERROR(state) {
            state.status = 'error';
        },
        AUTH_REQUEST(state) {
            state.status = 'loading';
        },
        SET_USER_ID(state, id) {
            state.userId = id;
        },
        SET_RATING(state, rating, getters) {
            state.currentRating = rating;

        },
        SET_AVG_RATING(state, avgRating) {
            state.avgRating = avgRating;
        },
        UNSET_AVG_RATING(state) {
            state.avgRating = null;
        },
        UNSET_CURRENT_RATING(state) {
            state.currentRating = null;
        },
        RESET_RATING(state) {
            state.currentRating = null;
        },
        LOGGOUT(state) {
            state.status = '';
            state.token = "";
            state.userId = "";
        },
        SET_POEMS(state, poems) {
            state.poems = poems;
        },
        SET_POEM(state, currentPoem) {
            state.currentPoem = currentPoem;
        },
        SET_POEM_ID(state, id) {
            console.log('log in mutation id=' + id)
            state.poemId = id;
        },

        DELETE_POEM(state, poems, id) {

        },
        next(state) {
            state.step = state.step + 1;
        },
        prev(state) {
            state.step = state.step - 1;
        }

    },
    actions: {

        getPoems(context) {
            axios.get("/api/poems").then(response => {

                context.commit('SET_POEMS', response.data)
            });
        },
        GET_SINGLE_POEM(context, id) {
            console.log(id);
            return new Promise((resolve, reject) => {
                axios.get("/api/poems/" + id).then(response => {
                    this.loading = false;
                    this.poem = response.data;
                    console.log('bellow response.data');
                    console.log(response.data[0]);
                    context.commit('SET_POEM', this.poem)

                    context.commit('SET_POEM_ID', this.poem[0].id)
                    resolve(response);
                });
            });
        },
        DELETE_POEM(context, id) {
            return new Promise((resolve, reject) => {

                axios.delete("/api/poems/" + id + "/delete").then(response => {
                    this.loading = false;
                    console.log("deleted");

                });
            })
        },
        GET_RATING(context, rateObj) {
            return new Promise((resolve, reject) => {
                axios({
                    url: '/api/poems/' + rateObj.poem_id + '/user/' + rateObj.user_id + '/get_rate',
                    data: rateObj,
                    method: 'GET'
                }).then(resp => {
                    console.log('here is resp.data in GET_RATING action')
                    if (resp.data.rating) {

                        context.commit('SET_RATING', resp.data.rating);

                    } else {
                        context.commit('UNSET_CURRENT_RATING');
                    }

                    resolve(resp);
                });
            });
        },
        GET_AVG_RATING(context, poem_id) {
            return new Promise((resolve, reject) => {
                context.commit('UNSET_AVG_RATING');
                axios({
                    url: '/api/poems/' + poem_id + '/get_avg_rate',
                    data: poem_id,
                    method: 'GET'
                }).then(resp => {
                    context.commit('SET_AVG_RATING', resp.data)
                    resolve(resp);
                });
            })
        },
        RESET_RATING(context, rateObj) {
            return new Promise((resolve, reject) => {


                axios({
                    url: '/api/poems/' + rateObj.poem_id + '/user/' + rateObj.user_id + '/reset_rate',
                    data: rateObj,
                    method: 'POST'
                }).then(resp => {

                    context.commit('RESET_RATING');



                    resolve(resp);
                });
            });
        },
        RATE_POEM(context, rateObj) {
            return new Promise((resolve, reject) => {


                axios({
                    url: '/api/poems/' + rateObj.poem_id + '/rate',
                    data: rateObj,
                    method: 'POST'
                }).then(resp => {
                    console.log(resp)
                    context.commit('SET_RATING', resp.data.rating)
                    resolve(resp);
                });
            });

        },
        AUTH_REQUEST(context, user) {
            console.log(user);
            return new Promise((resolve, reject) => { // The Promise used for router redirect in login
                context.commit('AUTH_REQUEST');
                axios({
                        url: '/api/log-in',
                        data: user,
                        method: 'POST'
                    })
                    .then(resp => {
                        const token = resp.data.token;
                        localStorage.setItem('token', token) // store the token in localstorage
                        let id = resp.data.id;
                        localStorage.setItem('user_id', id);

                        context.commit('AUTH_SUCCESS', token)
                        context.commit('SET_USER_ID', id)
                        // you have your token, now log in your user :)
                        //context.dispatch('USER_REQUEST')
                        resolve(resp)
                    })
                    .catch(err => {
                        context.commit('AUTH_ERROR', err)
                        localStorage.removeItem('token') // if the request fails, remove any possible user token if possible
                        reject(err)
                    });
            });
        },
        LOGGOUT(context) {
            return new Promise((resolve, reject) => {
                context.commit('LOGGOUT');

                localStorage.removeItem('token') // clear your user's token from localstorage
                localStorage.removeItem('user_id') // clear your user's token from localstorage

                resolve()
            })

        }

    }
})
Vue.component('example-component2', require('./components/CustomAuth.vue').default);
Vue.component('custom-header', require('./components/header.vue').default);
const ex = new Vue({
    el: '#example',
    store,
    router: router,
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

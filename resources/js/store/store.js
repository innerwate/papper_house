import Vuex from 'vuex';
import Vue from 'vue';
import poem from './poem';
import rating from './rating';
Vue.use(Vuex);
const store = new Vuex.Store({
    modules:{
        poem,
        rating
    },
    state: {
        
    },
    getters: {
        
    },
    mutations: {
       

    },
    actions: {        
        
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

        },
        TEST(context){
            axios({
                url: '/api/closed',
                method: 'GET'
            })
        }

    }
})
export default store;
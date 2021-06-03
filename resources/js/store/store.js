import Vuex from 'vuex';
import Vue from 'vue';
import poem from './poem';
import rating from './rating';
import categories from './category';
import duel from './duel';
import historyPeople from './historyPeople';
import users from './user';

Vue.use(Vuex);
const store = new Vuex.Store({
    modules:{
        poem,
        rating,
        categories,
        duel,
        historyPeople,
        users
    },
    state: {  
    },
    getters: {
    },
    mutations: {
    },
    actions: {        
    }
})
export default store;
import Vue from 'vue';
import CustomLogin from './components/CustomLogin.vue';
import CustomRegister from './components/CustomRegister.vue';
import CustomAuth from './components/CustomAuth.vue';
import poems from './components/poems.vue';
import poem from './components/poem.vue';
import create_poem from './components/create_poem.vue';
import editPoem from './components/edit_poem.vue';
import recomendations1 from './components/recomendations1.vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
const routes = [{
        path: '/registration',
        component: CustomRegister,
        name: 'registration',

    },
    {
        path: '/log-in',
        component: CustomLogin,
        name: 'log-in'
    },
    {
        path: '/auth',
        component: CustomAuth,
        name: 'auth'
    },
    {
        path: '/poems',
        component: poems,
        name: 'poems',

    },
    {
        path: '/poems/:id',
        component: poem,
        name: 'poem'
    },
    {
        path: '/create_poem',
        // redirect: '/poems',
        component: create_poem,
        name: 'create_poem'
    },
    {
        path: '/poems/:id/edit',
        component: editPoem,
        name: 'editPoem'
    },

    {
        path: '/recomendations',
        component: recomendations1,
        name: 'recomendations1'
    }

]
const router = new VueRouter({
    mode: 'history',
    routes // сокращённая запись для `routes: routes`
})
export default router;

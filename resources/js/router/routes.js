import Vue from 'vue';
import SignIn from '../components/user/SignIn.vue';
import SignUp from '../components/user/SignUp.vue';
import PoemsAll from '../components/poem/PoemsAll.vue';
import PoemItem from '../components/poem/PoemItem.vue';
import CreatePoem from '../components/poem/CreatePoem.vue';
import EditPoem from '../components/poem/EditPoem.vue';
import CreateDuel from '../components/duel/CreateDuel.vue';
import EditDuel from '../components/duel/EditDuel.vue';
import ShowDuel from '../components/duel/ShowDuel.vue';
import ListDuels from '../components/duel/ListDuels.vue'; 
import Office from '../components/user/Office.vue';
import PoemsAllUsers from '../components/poem/PoemsAllUsers';
import MyPoems from '../components/poem/MyPoems.vue';

const routes = [{
        path: '/sign-up',
        component: SignUp,
        name: 'sign-up',

    },
    {
        path: '/sign-in',
        component: SignIn,
        name: 'sign-in'
    },
    {
        path: '/poems',
        component: PoemsAll,
        name: 'poems',

    },
    {
        path: '/users-poems',
        component: PoemsAllUsers,
        name: 'users-poems'
    },
    {
        path: '/my-poems',
        component: MyPoems,
        name: 'my-poems'
    },
    {
        path: '/poems/:id',
        component: PoemItem,
        name: 'poem'
    },
    {
        path: '/create-poem',
        // redirect: '/poems',
        component: CreatePoem,
        name: 'create-poem'
    },
    {
        path: '/poems/:id/edit',
        component: EditPoem,
        name: 'edit-poem'
    },
    {
        path: '/duel/:id/show',
        component: ShowDuel,
        name: 'show-duel'
    },
    {
        path: '/create-duel',
        component: CreateDuel,
        name: 'create-duel'
    },
    {
        path: '/duels/:id/edit',
        component: EditDuel,
        name: 'edit-duel'
    },
    {
        path: '/duels',
        component: ListDuels,
        name: 'duels'
    },
    {
        path: '/office',
        component: Office,
        name: 'office'
    }
]

export default routes;

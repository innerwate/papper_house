import Vue from 'vue';
import SignIn from '../components/user/SignIn.vue';
import SignUp from '../components/user/SignUp.vue';
import PoemsAll from '../components/poem/PoemsAll.vue';
import PoemItem from '../components/poem/PoemItem.vue';
import CreatePoem from '../components/poem/CreatePoem.vue';
import EditPoem from '../components/poem/EditPoem.vue';


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
    }
]

export default routes;

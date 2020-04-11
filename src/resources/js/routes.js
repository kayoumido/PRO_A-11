import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import Authentication from './components/Authentication';
import AccountEdition from './components/AccountEdition';

Vue.use(VueRouter);

export const router = new VueRouter({
  mode: 'history',
    routes: [{
        path: '/hello',
        name: 'Hello',
        component: Hello
    },
    {
        path: '/authentication',
        name: 'Authentication',
        component: Authentication
    },
    {
        path: '/AccountEdition',
        name: 'AccountEdition',
        component: AccountEdition
    }


],
});
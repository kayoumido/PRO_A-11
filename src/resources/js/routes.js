import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';

Vue.use(VueRouter);

export const router = new VueRouter({
  mode: 'history',
    routes: [{
        path: '/hello',
        name: 'Hello',
        component: Hello
    }],
});
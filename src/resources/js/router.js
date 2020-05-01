import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import AccountEdition from './components/AccountEdit';
import Presentation from './components/Presentation';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello,
    },
    {
      path: '/presentation',
      name: 'presentation',
      component: Presentation,
    },
    {
      path: '/mon-compte/modifier/',
      name: 'Edition de compte',
      component: AccountEdition,
    },
  ],
});

export default router;

import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import AccountEdition from './components/AccountEdit';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Hello',
      icon: 'mdi-help-box',
      component: Hello,
    },
    {
      path: '/test',
      name: 'Test',
      icon: 'mdi-help-box',
      component: Hello,
    },
    {
      path: '/userEdit',
      name: 'AccountEdition',
      component: AccountEdition,
    },
  ],
});

export default router;

import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import Authentication from './components/Authentication';

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
      path: '/login',
      name: 'Authentication',
      icon: 'mdi-help-box',
      component: Authentication,
    }],
});

export default router;

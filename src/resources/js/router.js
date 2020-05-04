import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import Reset from './components/Reset';
import ResetPassword from './components/ResetPassword';

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
      path: '/reset',
      name: 'Reset',
      icon: 'mdi-help-box',
      component: Reset,
    },
    {
      path: '/reset-password:token',
      name: 'ResetPassword',
      icon: 'mdi-help-box',
      component: ResetPassword,
    }],
});

export default router;

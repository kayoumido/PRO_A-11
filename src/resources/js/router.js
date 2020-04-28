import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';

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
      path: '/presentation',
      name: 'presentation',
      icon: 'mdi-help-box',
      component: Presentation,
    },
  ],
});

export default router;

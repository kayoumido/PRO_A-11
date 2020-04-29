import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import newPresentation from './components/CreatePresentation';

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
      // path: '/presentation/creer' comment du to issue #128,
      path: '/presentation-creer',
      name: 'newPresentation',
      icon: 'mdi-help-box',
      component: newPresentation,
    },
  ],
});

export default router;

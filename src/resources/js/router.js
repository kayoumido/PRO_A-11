import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import Authentication from './components/Authentication';
import Presentation from './components/Presentation';

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
    },
    {
      path: '/presentation',
      /**
       * leading to 404 error when accessing directly with browser
       * path: 'presentation/:idPresentation',
       */
      name: 'presentation',
      icon: 'mdi-help-box',
      component: Presentation,
    },
  ],
});

export default router;

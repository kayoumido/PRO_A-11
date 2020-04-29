import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import ListPresentations from './components/ListPresentations';
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
      path: '/presentations',
      name: 'Lister les Presentation',
      icon: 'mdi-help-box',
      component: ListPresentations,
    },
    {
      path: 'presentation/:idPresentation',
      name: 'presentation',
      icon: 'mdi-help-box',
      component: Presentation,
    },
  ],
});

export default router;

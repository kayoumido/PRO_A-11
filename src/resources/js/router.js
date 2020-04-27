import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import listPresentations from './components/ListPresentations';

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
      path: '/listPresentation',
      name: 'Lister les Presentation',
      icon: 'mdi-help-box',
      component: listPresentations,
    },
  ],
});

export default router;

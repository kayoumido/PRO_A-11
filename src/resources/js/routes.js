import Vue from 'vue';
import VueRouter from 'vue-router';

import presentations from './components/ListPresentations';

Vue.use(VueRouter);

export const router = new VueRouter({
  mode: 'history',
  routes: [{
    path: '/user/presentations',
    name: 'presentation',
    component: presentations,
  }],
});

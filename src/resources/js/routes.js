import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import Presentation from './components/Presentation';

Vue.use(VueRouter);

export const router = new VueRouter({
  mode: 'history',
    routes: [{
        path: '/hello',
        name: 'Hello',
        component: Hello
    },
    {
      path: '/presentation',
      name: 'presentation',
      component: Presentation,
      // enable props in router link
      props : true 
    }
  ],
});
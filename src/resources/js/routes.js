import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import Authentication from './components/Authentication';
import ExampleComponent from './components/ExampleComponent';

Vue.use(VueRouter);

export default new VueRouter({

  routes: [{
      path: '/',
      name: 'ExampleComponent',
      component: ExampleComponent
  }],
  mode: 'history'
});
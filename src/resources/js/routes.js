import Vue from 'vue';
import VueRouter from 'vue-router';

import Hello from './components/Hello';
import Authentication from './components/Authentication';
import ExampleComponent from './components/ExampleComponent';
import App from './App';

Vue.use(VueRouter);

export default new VueRouter({

  routes: [{
      path: '/',
      name: 'App',
      component: App
  },
  {
    path: '/Authentication',
    name: 'Authentication',
    component : Authentication
  },
  {
    path: '/hello',
    name: 'hello',
    component : Hello
  }

],
  mode: 'history'
});
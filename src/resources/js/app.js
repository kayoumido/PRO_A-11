require('./bootstrap');

import Vue from 'vue';

import {router} from './routes';
import App from './App.vue';

import makeServer from './api';

if (process.env.NODE_ENV === "development") {
  makeServer();
}

new Vue({
  el: '#app',
  router,
  components: { App },
  render: h => h(App),
});
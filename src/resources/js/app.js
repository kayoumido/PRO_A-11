require('./bootstrap');

import Vue from 'vue';

import {router} from './routes'
import App from './App.vue';


new Vue({
  el: '#app',
  router,
  components: { App },
  render: h => h(App),
});
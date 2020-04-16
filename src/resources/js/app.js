require('./bootstrap');

window.Vue = require('vue');

import {router} from './router'
import App from './components/layout/App';
import vuetify from './vuetify'

import makeServer from './api';

if (process.env.NODE_ENV === "development") {
  makeServer();
}


const app = new Vue({
  el: '#app',
  router,
  vuetify,
  components: { App },
  render: h => h(App),
});

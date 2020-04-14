require('./bootstrap');

window.Vue = require('vue');

import {router} from './routes'
import App from './App';
import vuetify from './vuetify'


const app = new Vue({
  el: '#app',
  router,
  vuetify,
  components: { App },
  render: h => h(App),
});

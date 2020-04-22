import Vue from 'vue';
import makeServer from './api';
import router from './router';
import vuetify from './vuetify';
import App from './components/layout/App';

require('./bootstrap');


if (process.env.NODE_ENV === 'development') {
  makeServer();
}

export default new Vue({
  el: '#app',
  router,
  vuetify,
  components: { App },
  render: (h) => h(App),
});

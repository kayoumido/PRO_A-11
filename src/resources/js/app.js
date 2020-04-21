import Vue from 'vue';
import makeServer from './api';
import router from './routes';
import App from './App';

require('./bootstrap');

if (process.env.NODE_ENV === 'development') {
  makeServer();
}

Vue({
  el: '#app',
  router,
  components: { App },
  render: (h) => h(App),
});

import Vue from 'vue';
import DatetimePicker from 'vuetify-datetime-picker';
import makeServer from './api';
import router from './router';
import vuetify from './vuetify';
import store from './store';
import App from './components/layout/App';

require('./bootstrap');

Vue.use(DatetimePicker);

store.dispatch('auth/attempt', localStorage.getItem('token'));

if (process.env.NODE_ENV === 'development') {
  makeServer();
}

export default new Vue({
  el: '#app',
  router,
  vuetify,
  store,
  components: { App },
  render: (h) => h(App),
});

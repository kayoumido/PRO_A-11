import Vue from 'vue';
import DatetimePicker from 'vuetify-datetime-picker';
import makeServer from './api';
import router from './router';
import vuetify from './vuetify';
import store from './store';
import App from './components/layout/App';

require('./bootstrap');

Vue.use(DatetimePicker);


if (process.env.NODE_ENV === 'development') {
  makeServer();
}

store.dispatch('auth/attempt', localStorage.getItem('token'))
  .then(() => {
    // make sure that the user is set before loading application
    // eslint-disable-next-line no-new
    new Vue({
      el: '#app',
      router,
      vuetify,
      store,
      components: { App },
      render: (h) => h(App),
    });
  });

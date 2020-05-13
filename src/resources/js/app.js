import Vue from 'vue';
import DatetimePicker from 'vuetify-datetime-picker';
import makeServer from './api';
import router from './router';
import vuetify from './vuetify';
import App from './components/layout/App';

require('./bootstrap');

Vue.use(DatetimePicker);

Vue.mixin({
  data() {
    return {
      loggedUser: {},
      isLogged: false,
    };
  },
  methods: {
    setLoggedUser() {
      // get logged user
      return window.axios.get('/me')
        .then((response) => {
          this.loggedUser = response.data;
          this.isLogged = true;
          // eslint-disable-next-line no-console
          console.log('set logged success');
        })
        .catch(() => {
          this.loggedUser = {};
          this.isLogged = false;
          // eslint-disable-next-line no-console
          console.log('set logged failed');
        });
    },
  },
});

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

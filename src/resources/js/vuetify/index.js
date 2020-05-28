import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
    light: true,
    themes: {
      light: {
        primary: '#5BDC8E',
        secondary: '#3FA7D6',
        success: '#0ACF83',
        error: '#ee6352',
      },
    },
  },
});

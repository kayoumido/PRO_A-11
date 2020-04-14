import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

export default new Vuetify({
    theme: {
        light: true,
        themes: {
            light: {
                primary: '#3f51b5',
                secondary: '#9c27b0',
                accent: '#03a9f4',
                error: '#f44336',
                warning: '#ffc107',
                info: '#607d8b',
                success: '#4caf50'
            }
        }
    }
})

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import customTheme from './theme'

Vue.use(Vuetify)
const ops = {
    theme: {
        themes: {customTheme}
    }
}

export default new Vuetify(ops)

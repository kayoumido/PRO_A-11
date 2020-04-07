/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import router from './routes'


// Import VueJS Component
import App from './App'
import Authentication from './components/Authentication'
import Hello from './components/Hello'


require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import {router} from './routes';
import App from './App.vue';

import makeServer from './api';

if (process.env.NODE_ENV === "development") {
  makeServer();
}



const app = new Vue({
    el: '#app',
    components: {
        App,
        Authentication,
        Hello
    },
    router
});

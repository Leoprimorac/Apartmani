/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import VueRouter from 'vue-router' // router
import VueAxios from 'vue-axios';
import axios from 'axios';
import router from './router';
import store from './store';

Vue.use(VueRouter) //router
Vue.use(VueAxios, axios);
Vue.use(BootstrapVue)

// Axios
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';


// CRSF Token for axios requests
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Use Vue cookie to store Bearer
var VueCookie = require('vue-cookie');
Vue.use(VueCookie);

// API
import * as api from './api.js'
window.api = api;

window.swatApi = axios.create({
    baseURL: api.apiDomain,
    timeout: 5000,
});

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Navbar from './components/Navbar'

import lightbox from 'vlightbox'
Vue.component('lightbox', lightbox)




const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        Navbar
    },

    data() {
        return {
            isGuest: true,

           }
    },
    methods: {
        setBearer() {
            let bearer = this.$cookie.get('api_token');
            if (bearer != null) {
                swatApi.defaults.headers.common['Authorization'] = 'Bearer ' + bearer;
                this.isGuest = false;
                if (this.isApp || this.isAuth) {
                    store.dispatch('getUser');
                }
            } else {
                if (this.isApp) {
                    store.dispatch('getUser');
                }
            }
        }
    },
    computed: {
        isApp () {
            return this.$route.path.match('app')
        },
        isAuth () {
            return this.$route.path.match('auth')
        },
        user: function () {
            return this.$store.getters.loggedUser;
        }
    },
    mounted() {
        this.setBearer();
    },
    updated() {
        this.setBearer();
    },
    created() {
        // Set interceptor for 401
        let self = this;
        swatApi.interceptors.response.use(
            function (response) {
                return response;
            },
            function (error) {
                if (error.response.status === 401) {
                    self.isGuest = true;
                    self.$cookie.delete('api_token');
                    self.$router.push('/auth/login');
                }
                console.log("An error ocurred -> " + error);
                return Promise.reject(error);
            });
    }

}); // do ovde router

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




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



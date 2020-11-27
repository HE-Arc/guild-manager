/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Import and install the VueRouter, Vuex and Vuetify plugins
 */

import VueRouter from 'vue-router'
import 'es6-promise/auto'
import Vuex from 'vuex'
import Vuetify from '../plugins/vuetify'

Vue.use(VueRouter)
Vue.use(Vuex)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Import Vue components
 */

import App from '../views/App'
import EventPrep from '../views/EventPrep'
import Home from '../views/Home'

/**
 * Construct a new VueRouter instance that takes a configuration object
 */

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/event/prep',
            name: 'event-prep',
            component: EventPrep,
        },
    ],
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    components: { App },
    router,
    getGmUsers: function getGmUsers(){
        var _this = this;
        axios.get('/getGmUsers').then(function(response){
            _this.gm_users = response.data;
        }).catch(error=>{
            console.log("Get All: "+error);
        });
    },
    getServers: function getServers(){
        var _this = this;
        axios.get('/getServers').then(function(response){
            _this.servers = response.data;
        }).catch(error=>{
            console.log("Get All: "+error);
        });
    },
});

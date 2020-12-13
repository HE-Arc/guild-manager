/**
 * Load the core and Vue module
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Load the axios HTTP library
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = localStorage.getItem('token')
if (token)
    axios.defaults.headers.common['Authorization'] = token

/**
 * Import and use the VueRouter, Vuex and Vuetify plugins
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

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/* The old way
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('event-info-component', require('./components/EventInfoComponent.vue').default);
Vue.component('event-role-component', require('./components/EventRoleComponent.vue').default);
Vue.component('event-action-component', require('./components/EventActionComponent.vue').default);
*/

/**
 * Import Vue components
 */

import App from '../views/App'
import Home from '../views/Home'
import Login from '../views/Login'
import Register from '../views/Register'
import Events from '../views/Events'
import EventNew from '../views/EventNew'
import EventPrep from '../views/EventPrep'
import EventResult from '../views/EventResult'

/**
 * Construct a new Store instance
 */

const store = new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user: {}
    },
    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        auth_success(state, { token, user }) {
            state.status = 'success'
            state.token = token
            state.user = user
        },
        auth_error(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = ''
            state.token = ''
        },
    },
    actions: {
        login({ commit }, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({ url: '/api/login', data: user, method: 'POST' })
                    .then(resp => {
                        const token = resp.data.token
                        const user = resp.data.user
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = token
                        commit('auth_success', { token, user })
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error')
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },
        register({ commit }, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({ url: '/api/register', data: user, method: 'POST' })
                    .then(resp => {
                        const token = resp.data.token
                        const user = resp.data.user
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = token
                        commit('auth_success', token, user)
                        resolve(resp)
                    })
                    .catch(err => {
                        commit('auth_error', err)
                        localStorage.removeItem('token')
                        reject(err)
                    })
            })
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('token')
                delete axios.defaults.headers.common['Authorization']
                resolve()
            })
        },
    },
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
    }
})

/**
 * Construct a new VueRouter instance
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
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/events',
            name: 'events',
            component: Events,
            meta: { requiresAuth: true }
        },
        {
            path: '/event/new',
            name: 'event-new',
            component: EventNew,
            meta: { requiresAuth: true }
        },
        {
            path: '/event/:id',
            name: 'event-prep',
            component: EventPrep,
            meta: { requiresAuth: true }
        },
        {
            path: '/event/:eventId/result',
            props: true,
            name: 'event-result',
            component: EventResult,
            meta: { requiresAuth: true }
        }
    ],
});

/**
 * Construct the Route meta fields
 */

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters.isLoggedIn) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else
            next()
    } else
        next() // make sure to always call next()!
})

/**
 * Create the Vue application instance and attach it to the page
 */

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    components: { App },
    router,
    store
});
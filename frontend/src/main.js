/*
TODO 0.2

Reliez l'app Vue au div avec l'id sur index.html

(Indice 1 : Tout en bas de ce fichier)
*/

/*
TODO 0.3

Ajoutez le router et le store
*/

import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'
import routes from './routes'
import store from './store'
import vuetify from './plugins/vuetify';

Vue.config.productionTip = false
Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!store.getters.loggedIn) {
      next({
        name: 'login',
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    // this route requires visitor (not auth), check if NOT logged in
    // if logged in, redirect to counter page.
    if (store.getters.loggedIn) {
      next({
        name: 'counter',
      })
    } else {
      next()
    }
  } else {
    next() // make sure to always call next()!
  }
})

new Vue({
  el: "#app",
  router,
  store,
  vuetify,
  render: h => h(App)
})

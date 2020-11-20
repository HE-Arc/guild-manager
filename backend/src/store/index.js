
/*
TODO 3.1

Créez un getter nommé loggedIn (le nom est important !) permettant de savoir si l'utilisateur est connecté.

(Indice 1 : basez-vous sur l'état du token dans le state)
*/

/*
TODO 6.1

Ajoutez un nouveau state nommé coffee_counter (le nom est important !) permettant de connaitre le nombre de
cafés actuellement bu.
*/

/*
TODO 6.2

Ajoutez une mutation nommé updateCoffeeCounter permettant de modifier le nombre de café actuel

(Indice 1 : Inspirez-vous des autres mutations)
*/

import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)
axios.defaults.baseURL = "http://workshop-vuejs.test/api"

export default new Vuex.Store({
  state: {
    token: localStorage.getItem('access_token') || null,
    authUser: null,
    users: [],
    coffee_counter: 0,
  },
  getters: {
    orderedUsers(state) {
      return state.users.sort((a, b) => (a.coffee_counter < b.coffee_counter) ? 1 : -1)
    },
    loggedIn(state) {
      return state.token != null
    }
  },
  mutations: {
    retrieveToken(state, token) {
      state.token = token
    },
    destroyToken(state) {
      state.token = null
    },
    updateUsers(state, users) {
      state.users = users
    },
    updateAuthUser(state, authUser) {
      state.authUser = authUser
    },
    updateCoffeeCounter(state, number) {
      state.coffee_counter = number
    }
  },
  actions: {
    fetchAuthUser(context) {

      axios.defaults.headers.common["Authorization"] = "Bearer " + context.state.token

      return new Promise((resolve, reject) => {
        axios.get("/user")
          .then(response => {
            context.commit("updateAuthUser", response.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    fetchAllUsers(context) {

      axios.defaults.headers.common["Authorization"] = "Bearer " + context.state.token

      return new Promise((resolve, reject) => {
        axios.get("/user/all")
          .then(response => {
            context.commit("updateUsers", response.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    fetchCoffeeCounter(context) {

      axios.defaults.headers.common["Authorization"] = "Bearer " + context.state.token

      return new Promise((resolve, reject) => {
        axios.get("/coffee")
          .then(response => {
            context.commit("updateCoffeeCounter", response.data.coffee_counter)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    decreaseCoffeeCounter(context, number) {

      axios.defaults.headers.common["Authorization"] = "Bearer " + context.state.token

      return new Promise((resolve, reject) => {
        axios.post("/coffee/dec", {
          dec_number: number,
        })
          .then(response => {
            context.commit("updateCoffeeCounter", response.data.new_coffee_counter)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    increaseCoffeeCounter(context, number) {

      axios.defaults.headers.common["Authorization"] = "Bearer " + context.state.token

      return new Promise((resolve, reject) => {
        axios.post("/coffee/inc", {
          inc_number: number,
        })
          .then(response => {
            context.commit("updateCoffeeCounter", response.data.new_coffee_counter)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    register(context, data) {

      return new Promise((resolve, reject) => {
        axios.post("/register", {
          name: data.name,
          email: data.email,
          password: data.password,
          password_confirmation: data.password_confirmation,
        })
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    },
    destroyToken(context) {

      axios.defaults.headers.common["Authorization"] = "Bearer " + context.state.token

      if (context.getters.loggedIn) {
        return new Promise((resolve, reject) => {
          axios.post("/logout")
            .then(response => {
              localStorage.removeItem("access_token")
              context.commit("destroyToken")
              resolve(response)
            })
            .catch(error => {
              localStorage.removeItem("access_token")
              context.commit("destroyToken")
              reject(error)
            })
        })
      }
    },
    retrieveToken(context, credentials) {

      return new Promise((resolve, reject) => {
        axios.post("/login", {
          username: credentials.username,
          password: credentials.password,
        })
          .then(response => {
            const token = response.data.access_token
            
            localStorage.setItem("access_token", token)
            context.commit("retrieveToken", token)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      })
    }
  },
  modules: {
  }
})

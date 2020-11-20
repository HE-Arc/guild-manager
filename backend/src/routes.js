
/*
TODO 2

Rendre la page de Login accessible au moyen d'une route

(Indice 1 : Inspirez-vous de la route register)
*/

import Home from './views/Home.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import Logout from './views/Logout.vue'
import Counter from './views/Counter.vue'
import Scoreboard from './views/Scoreboard.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      requiresVisitor: true, // Only accessible by unlogged users
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      requiresVisitor: true, // Only accessible by unlogged users
    }
  },
  {
    path: '/logout',
    name: 'logout',
    component: Logout,
    meta: {
      requiresAuth: true, // Only accessible by logged in users
    }
  },
  {
    path: '/counter',
    name: 'counter',
    component: Counter,
    meta: {
      requiresAuth: true,
    }
  },
  {
    path: '/scoreboard',
    name: 'scoreboard',
    component: Scoreboard,
    meta: {
      requiresAuth: true,
    }
  }
]

export default routes

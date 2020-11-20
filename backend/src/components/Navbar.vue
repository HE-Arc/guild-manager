
<!--
TODO 5

Afficher les boutons Scoreboard, Counter et Logout uniquement quand l'utilisateur est loggedIn
Et afficher les boutons Register et Login unquement dans l'utilisateur n'est PAS loggedIn

(Indice 1 : v-if, computed)
(Indice 2 : this.$store permet d'accéder au store depuis n'importe qu'elle page)
-->

<!--
TODO 10.2

Importez le nouveau composant que vous venez de créer et remplacer le code du bouton concerné sur cette page par le composant
-->

<!--
TODO 11.2

Envoyez les bonnes données au nouveau permettant d'afficher le bouton Counter sur la navbar

(Indice 1 : Inspirez-vous de l'utilisation du composant CoffeeButton, dans le composant Counter)
-->

<!--
TODO 12

Utilisez ce nouveau composant pour modifier tous les boutons de la navbar : Scoreboard, Logout, Register et Login

(Indice 1 : Inspirez-vous de l'utilisation du composant CoffeeButton, dans le composant Counter)
-->

<template>
  <v-app-bar
    app
    dark
  >
    <h2>
      <router-link class="white--text" style="text-decoration: none" :to="{ name: 'home' }">
        <v-icon>mdi-coffee</v-icon>
        Coffee Counter
      </router-link>
    </h2>

    <v-spacer></v-spacer>

    <div v-if="loggedIn">
      <NavButton :color="'green'" :link="'scoreboard'" :text="'Scoreboard'" :icon="'earth'"></NavButton>

      <NavButton :color="'blue'" :link="'counter'" :text="'Counter'" :icon="'coffee'" :subIcon="'unfold-more-horizontal'"></NavButton>
      
      <NavButton :color="'red'" :link="'logout'" :text="'Logout'" :icon="'logout'"></NavButton>
    </div>
    <div v-else>
      <NavButton :color="'grey'" :link="'register'" :text="'Register'" :icon="'account-plus'"></NavButton>

      <NavButton :color="'indigo'" :link="'login'" :text="'Login'" :icon="'login'"></NavButton>
    </div>
  </v-app-bar>
</template>

<script>
import NavButton from './NavButton.vue'

export default {
  components: {
    NavButton,
  },
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn
    }
  }
}
</script>

<style>

</style>
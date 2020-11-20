
<!--
TODO 8

Ajoutez un composant permettant de décrémenter le nombre de cafés.
Pour l'instant le bouton affichera simplement un message dans la console au clic.

Le bouton doit être rouge et avoir l'icon "minus" venant de https://materialdesignicons.com/ fournit avec Vuetify

(Indice 1 : Inspirez-vous du bouton permettant d'incrémenter)
-->

<!--
TODO 9

Le bouton décrémenter doit décrémenter le compteur dans la DB.

(Indice 1 : Inspirez-vous du bouton permettant d'incrémenter)
(Indice 2 : L'action existe déjà dans le store, il faut simplement l'appeler correctement)
-->

<template>
  <v-row class="text-center">
    <v-col
      cols=12>
      <h2>Welcome <span class="blue--text" v-if="authUser">{{ authUser.name }}</span></h2>
      <p>
        Here's the number of coffees you've already drunk!
      </p>
    </v-col>

    <v-col
      cols=12>
      <CoffeeButton :action="increase" :color="'blue'" :icon="'plus'" class="mr-5"></CoffeeButton>
      
      <span class="coffee-counter">{{ coffee_counter }}</span>

      <!-- Ajoutez le composant ici -->
      <CoffeeButton :action="decrease" :color="'red'" :icon="'minus'" class="ml-5"></CoffeeButton>
    </v-col>
  </v-row>
</template>

<script>
import CoffeeButton from '../components/CoffeeButton.vue'

export default {
  components: {
    CoffeeButton,
  },
  mounted() {
    this.getCurrentCoffee();
  },
  methods: {
    increase() {
      this.$store.dispatch("increaseCoffeeCounter", 1)
    },
    decrease() {
      this.$store.dispatch("decreaseCoffeeCounter", 1)
    },
    getCurrentCoffee() {
      this.$store.dispatch("fetchCoffeeCounter")
    },
  },
  computed: {
    coffee_counter() {
      return this.$store.state.coffee_counter
    },
    authUser() {
      return this.$store.state.authUser
    }
  },
}
</script>

<style scoped>
  .coffee-counter {
    font-weight: bold;
    font-size: 1.5em;
  }
</style>
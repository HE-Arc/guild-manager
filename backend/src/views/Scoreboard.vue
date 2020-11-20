<!--
TODO 13

Modifiez v-col pour afficher tous les utilisateurs.

(Indice 1 : v-for, key)
(Indice 2 : Attention appliquez les changements sur v-col et pas v-card)
-->

<!--
TODO 14

Mettez le texte du nom, de l'email et du coffee_counter en rouge si l'utilisateur actuellement parcouru
dans l'itération est l'utilisateur connecté et mettez en bleu sinon.
Utilisez les classes de vuetify "red--text" et "blue--text" pour changer la couleur du texte.

(Indice 1 : class)
(Indice 2 : == ? :)
-->

<template>
  <v-row v-if="authUser">
    <v-col
      cols=12
      v-for="user in users" :key="user.id">
      <v-card
        class="mx-auto"
      >
        <v-card-title :class="user.id == authUser.id ? 'red--text' : 'blue--text'" style="justify-content: center;">
          {{ user.name }}
          -
          ({{ user.email }})
          <v-spacer></v-spacer>
          {{ user.coffee_counter }}
        </v-card-title>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  mounted() {
    this.fetchAllUsers();
  },
  methods: {
    fetchAllUsers() {
      this.$store.dispatch("fetchAllUsers")
    },
  },
  computed: {
    users() {
      return this.$store.getters.orderedUsers
    },
    authUser() {
      return this.$store.state.authUser
    }
  },
}
</script>

<style>

</style>
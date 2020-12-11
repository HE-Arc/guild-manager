<template>
  <v-app>
    <h1>Accueil</h1>
    <p>Bienvenue sur <i>Guild Manager</i>.</p>
    <v-alert type="success">Success</v-alert>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: false,
    group: null,
  }),
};
</script>
<template>
  <v-app>
    <p>salut</p>
    <p>This is the homepage</p>
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
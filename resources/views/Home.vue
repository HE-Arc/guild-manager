<template>
  <v-app>
    <div v-if="isLoggedIn">
      <v-card class="mx-auto" max-width="500" tile>
        <v-list rounded>
          <v-subheader>Navigation</v-subheader>
          <v-list-item-group color="primary">
            <v-list-item
              v-for="(item, i) in items"
              :key="i"
              @click="$router.push({ path: item.link })"
            >
              <v-list-item-icon>
                <v-icon v-text="item.icon"></v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title v-text="item.text"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-card>
    </div>
    <div v-else>
      <v-card class="mx-auto" max-width="500" elevation="2">
        <v-list-item three-line>
          <v-list-item-content>
            <div class="overline">Bienvenue sur <i>Guild Manager</i></div>
            <v-btn
              color="primary"
              dark
              class="mb-2"
              @click="$router.push({ name: 'login' })"
            >
              S'identifier
            </v-btn>
            <v-btn
              color="secondary"
              dark
              class="mb-2"
              @click="$router.push({ name: 'register' })"
            >
              S'inscrire
            </v-btn>
          </v-list-item-content>
        </v-list-item>
      </v-card>
    </div>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: false,
    group: null,
    items: [
      { text: "Mes évênements", icon: "mdi-calendar", link: "events" },
      {
        text: "Mes personnages",
        icon: "mdi-account-group",
        link: "characters",
      },
      { text: "Mes guildes", icon: "mdi-sword-cross", link: "guilds" },
    ],
  }),
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    },
  },
};
</script>
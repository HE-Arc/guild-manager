<template>
  <!-- App.vue -->
  <v-app>
    <v-navigation-drawer app v-model="drawer" sticky temporary>
      <v-list nav>
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
          <v-list-item @click="$router.push({ name: 'home' }).catch(() => {})">
            <v-list-item-icon>
              <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Accueil</v-list-item-title>
          </v-list-item>
          <v-list-item
            @click="$router.push({ name: 'events' }).catch(() => {})"
          >
            <v-list-item-icon>
              <v-icon>mdi-calendar</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Évênements</v-list-item-title>
          </v-list-item>
          <v-list-item
            @click="$router.push({ name: 'characters' }).catch(() => {})"
          >
            <v-list-item-icon>
              <v-icon>mdi-account-group</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Personnages</v-list-item-title>
          </v-list-item>
          <v-list-item
            @click="$router.push({ name: 'guilds' }).catch(() => {})"
          >
            <v-list-item-icon>
              <v-icon>mdi-sword-cross</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Guildes</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app sticky color="gray" elevate-on-scroll>
      <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

      <v-toolbar-title>Guild Manager</v-toolbar-title>

      <v-spacer></v-spacer>

      <div v-if="isLoggedIn">
        <v-btn icon @click="$router.push({ name: 'login' }).catch(() => {})">
          <v-icon>mdi-account-circle</v-icon>
        </v-btn>

        <v-btn icon @click="$router.push({ name: 'login' }).catch(() => {})">
          <v-icon>mdi-logout</v-icon>
        </v-btn>
      </div>
      <div v-else>
        <v-btn icon @click="$router.push({ name: 'register' }).catch(() => {})">
          <v-icon>mdi-account-plus</v-icon>
        </v-btn>

        <v-btn icon @click="$router.push({ name: 'login' }).catch(() => {})">
          <v-icon>mdi-login</v-icon>
        </v-btn>
      </div>
    </v-app-bar>

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container fluid>
        <!-- For vue-router -->
        <router-view></router-view>
      </v-container>
    </v-main>

    <v-footer app>
      <!-- -->
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: false,
    group: null,
  }),
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    },
  },
  created: function () {
    // Handling expired token cases
    let _this = this;
    axios.interceptors.response.use(undefined, function (err) {
      return new Promise(function (resolve, reject) {
        if (
          err.response &&
          err.response.status === 401 &&
          err.config &&
          !err.config.__isRetryRequest
        ) {
          _this.$store.dispatch("logout");
          _this.$router.push({ name: "login" }).catch(() => {});
        }
        throw err;
      });
    });
  },
};
</script>
<template>
  <!-- App.vue -->
  <v-app>
    <v-navigation-drawer app>
      <!-- -->
    </v-navigation-drawer>

    <v-app-bar
      app
      sticky
      color="#6A76AB"
      dark
      shrink-on-scroll
      prominent
      src="https://picsum.photos/1920/1080?random"
      fade-img-on-scroll
    >
      <template v-slot:img="{ props }">
        <v-img
          v-bind="props"
          gradient="to top right, rgba(100,115,201,.7), rgba(25,32,72,.7)"
        ></v-img>
      </template>

      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Guild Manager</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>

      <template v-slot:extension>
        <v-tabs align-with-title>
          <v-tab>
            <router-link :to="{ name: 'home' }" style="color: white">
              Home
            </router-link>
          </v-tab>
          <v-tab>
            <router-link :to="{ name: 'hello' }" style="color: white">
              Hello World
            </router-link>
          </v-tab>
        </v-tabs>
      </template>
    </v-app-bar>

    <!-- Sizes your content based upon application components -->
    <v-app>
      <v-content>
        <!-- Provides the application the proper gutter -->
        <v-container fluid>
          <!-- For vue-router -->
          <router-view></router-view>
        </v-container>
      </v-content>
    </v-app>

    <v-footer app>
      <!-- -->
    </v-footer>
  </v-app>
</template>
<script>
export default {};
</script>
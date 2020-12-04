<template>
  <v-app>
    <h1>Login</h1>

    <v-container fluid>
      <v-row>
        <v-col class="col-sm-12 col-md-6">
          <p v-if="!isLoggedIn">
            <v-btn @click="login"> LOGIN </v-btn>
            <v-btn v-if="!isLoggedIn" @click="login2"> LOGIN wrong pwd </v-btn>
          </p>
          <p v-else>
            <v-btn @click="logout"> LOGOUT </v-btn>
          </p>
        </v-col>

        <v-col class="col-sm-12 col-md-6">
          <p>Status: {{ this.$store.state.status }}</p>
          <p>Token: {{ this.$store.state.token }}</p>
          <p>User: {{ this.$store.state.user }}</p>
          <p>isLoggedIn: {{ this.$store.getters.isLoggedIn }}</p>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    name: "jean",
    password: "1234",
    wrongPassword: "123",
  }),
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    },
  },
  methods: {
    login: function () {
      let name = this.name;
      let password = this.password;

      this.$store
        .dispatch("login", { name, password })
        .then(() => this.$router.push('/'))
        .catch((err) => console.log(err));
    },
    login2: function () {
      let name = this.name;
      let password = this.wrongPassword;

      this.$store
        .dispatch("login", { name, password })
        .then(() => this.$router.push('/'))
        .catch((err) => console.log(err));
    },
    logout: function () {
      this.$store
        .dispatch("logout")
        .then(() => this.$router.push('/'))
        .catch((err) => console.log(err));
    },
  },
};
</script>
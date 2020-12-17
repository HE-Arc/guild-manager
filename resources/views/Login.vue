<template>
  <v-app>
    <v-container>
      <v-form ref="form" v-model="valid" v-if="!isLoggedIn">
        <v-row>
          <v-col>
            <h1>Identification</h1>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="name"
              :rules="[rules.required, rules.max]"
              :counter="64"
              label="Nom"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="password"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required, rules.max]"
              :type="showPassword ? 'text' : 'password'"
              name="input-10-1"
              label="Mot de passe"
              hint="Au moins 8 charactères"
              counter
              @click:append="showPassword = !showPassword"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-btn
              :disabled="!valid"
              color="success"
              class="mr-4"
              @click="login"
            >
              S'identifier
            </v-btn>
          </v-col>
        </v-row>
      </v-form>
      <div v-else>
        <v-row>
          <v-col>
            <h1>Déconnexion</h1>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-btn color="error" class="mr-4" @click="logout">
              Se déconnecter
            </v-btn>
          </v-col>
        </v-row>
      </div>
    </v-container>

    <!--
    <v-container fluid>
      <v-row>
        <v-col class="col-sm-12 col-md-6">
          <p>Status: {{ this.$store.state.status }}</p>
          <p>Token: {{ this.$store.state.token }}</p>
          <p>User: {{ this.$store.state.user }}</p>
          <p>isLoggedIn: {{ this.$store.getters.isLoggedIn }}</p>
        </v-col>
      </v-row>
    </v-container>
    -->
  </v-app>
</template>

<script>
export default {
  data: () => ({
    valid: false,
    rules: {
      required: (value) => !!value || "Ce champs est requis",
      min: (v) => v.length >= 8 || "Au moins 8 charactères",
      max: (v) => v.length <= 64 || "Au maximum de 64 lettres",
    },
    name: "Jean",
    password: "1234",
    showPassword: false,
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
        .then(() => this.$router.push("/"))
        .catch((err) => console.log(err));
    },
    logout: function () {
      this.$store
        .dispatch("logout")
        .then(() => this.$router.push("/"))
        .catch((err) => console.log(err));
    },
  },
};
</script>
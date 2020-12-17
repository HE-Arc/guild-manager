<template>
  <v-app>
    <v-form ref="form" v-model="valid">
      <v-container fluid>
        <v-row>
          <v-col>
            <h1>Créer un compte</h1>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="user.name"
              :rules="[rules.required, rules.min, rules.max]"
              :counter="64"
              label="Nom"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="user.email"
              :rules="[rules.required, rules.min, rules.max]"
              :counter="64"
              label="Email"
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="user.password"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required, rules.min, rules.max]"
              :type="showPassword ? 'text' : 'password'"
              name="input-10-1"
              label="Mot de passe"
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
              @click="register"
            >
              Créer le compte
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-alert v-model="formError" dismissible type="error">
              Erreur lors de la création du compte (adresse email peut-être déjà utilisée)
            </v-alert>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-app>
</template>

<script>
export default {
  props: ["characterId"],
  data: () => ({
    valid: false,
    rules: {
      required: (value) => !!value || "Ce champs est requis",
      min: (v) => v.length >= 4 || "Au moins 4 charactères",
      max: (v) => v.length <= 64 || "Au maximum de 64 lettres",
    },
    user: {
      name: "",
      email: "",
      password: "",
    },
    showPassword: false,
    formSuccess: false,
    formError: false,
  }),
  methods: {
    register() {
      let _this = this;
      this.formSuccess = false;
      this.formError = false;

      axios
        .post("/api/register", {
          name: this.user.name,
          email: this.user.email,
          password: this.user.password,
        })
        .then(function (response) {
          _this.$router.push({ name: "login" });
        })
        .catch(function (error) {
          console.log(error);
          _this.formError = true;
        });
    },
  },
};
</script>
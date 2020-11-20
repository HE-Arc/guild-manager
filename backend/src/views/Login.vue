
<!--
TODO 3.2

Faire fonctionner le formulaire Login

(Indice 1 : v-model, v-on)
(Indice 2 : methods)
-->

<template>
  <div>
    <v-col
      sm=6
      offset-sm=3>
      <v-form
        v-model="valid"
        lazy-validation
        @submit.prevent="login"
      >
        <v-text-field
          v-model="username"
          label="E-mail"
          type="email"
          required
        ></v-text-field>

        <v-text-field
          v-model="password"
          label="Password"
          type="password"
          required
        ></v-text-field>

        <v-btn
          :disabled="!valid"
          color="success"
          class="mr-4"
          type="submit"
        >
          Login
        </v-btn>
      </v-form>
    </v-col>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      username: "",
      password: "",
      valid: true,
    }
  },
  methods: {
    login() {
      this.$store.dispatch("retrieveToken", {
        username: this.username,
        password: this.password,
      })
        .then(() => {
          this.$router.push({ name: "counter" })
          this.$store.dispatch("fetchAuthUser")
        })
    },
  },
}
</script>

<style>

</style>

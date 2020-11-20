
<!--
TODO 1

Faire fonctionner le formulaire Register et créez un compte

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
        @submit.prevent="register"
      >
        <v-text-field
          v-model="name"
          label="Name"
          type="text"
          required
        ></v-text-field>

        <v-text-field
          v-model="email"
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

        <v-text-field
          v-model="password_confirmation"
          label="Password Confirmation"
          type="password"
          required
        ></v-text-field>

        <v-btn
          :disabled="!valid"
          color="success"
          class="mr-4"
          type="submit"
        >
          Register
        </v-btn>
      </v-form>
    </v-col>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      valid: true,
    }
  },
  methods: {
    register() {
      this.$store.dispatch("register", {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
      })
        .then(() => {
          this.$router.push({ name: "login" })
        })
    },
  }
}
</script>

<style>

</style>
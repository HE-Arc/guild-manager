
<!--
TODO 7.1

Rediriger les utilisateurs sur la home page lorsqu'ils appuyent sur "Home page" dans le texte de cette page.
Vous ne devez pas utilisez la balise <a href=""></a>

(Indice 1 : Inspirez-vous du logo sur la navbar)
-->

<!--
TODO 7.2

Rediriger les utilisateurs déconnectés sur la home page.

(Indice 1 : Inspirez-vous des autres pages qui possèdes des redirections)
-->

<template>
  <div>
    <h2>You are on the logout page. There is nothing to do here!</h2>
    <p>Return on the <router-link :to="{ name: 'home' }">Home page</router-link></p>
  </div>
</template>

<script>
export default {
  created() {
    this.$store.dispatch("destroyToken")
      .then(() => {
        this.$router.push({ name: "home" })
      })
  }
}
</script>

<style>

</style>
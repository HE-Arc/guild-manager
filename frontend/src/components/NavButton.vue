
<!--
TODO 10.1

Créer un nouveau composant ici, il doit contenir le code du bouton Counter de la navbar.

(Indice 1 : Inspirez-vous des autres composants)

> TIP 1 : Dans VSCode vous pouvez écrire <vue> et appuyer sur enter pour générer le template Vue de base.
-->

<!--
TODO 11.1

Utilisez les props pour abstraire un maximum d'éléments de ce composant.

(Indice 1 : Inspirez-vous du composant CoffeeButton)
(Indice 2 : Les éléments que vous devez abtraire sont : couleur, lien, texte, icon, sub icon)
-->

<template>
    <v-btn :class="color" class="darken-3 mr-3" :to="{ name: link }">
        <span class="mr-2">{{text}}</span>
        <v-icon>mdi-{{icon}}</v-icon>
        <v-icon>mdi-{{subIcon}}</v-icon>
    </v-btn>
</template>

<script>
export default {
  props: {
    color: {
      type: String,
      required: true
    },
    icon: {
      type: String,
      required: true
    },
    subIcon: {
      type: String,
      required: false
    },
    link: {
      type: String,
      required: true
    },
    text: {
      type: String,
      required: true
    },
  }
}
</script>

<style>

</style>

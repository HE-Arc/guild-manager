<template>
  <v-btn @click="action" :class="color" class="darken-2">
    <v-icon class="white--text">
      mdi-{{icon}}
    </v-icon>
  </v-btn>
</template>

<script>
export default {
  props: {
    action: {
      type: Function,
      required: true
    },
    color: {
      type: String,
      required: true
    },
    icon: {
      type: String,
      required: true
    },
  }
}
</script>

<style>

</style>
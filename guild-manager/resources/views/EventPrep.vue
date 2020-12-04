<template>
  <v-app>
    <event-info-component></event-info-component>
    <event-role-component title="Inscrits" makeButton="true" buttonLabel="Bench"></event-role-component>
    <event-role-component title="Benchs" makeButton="true" buttonLabel="Unbench"></event-role-component>
    <event-role-component title="Absents" makeButton="false"></event-role-component>
  </v-app>
</template>

<script>
import EventInfoComponent from '../js/components/EventInfoComponent.vue';
export default {
  components: { EventInfoComponent },};
</script>
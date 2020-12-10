<template>
  <v-app>
    <event-info-component></event-info-component>
    <v-container class="grey lighten-5" fluid>
      <v-row dense>
        <v-col cols="3">
          <p style="font-size:30px">Tank</p>
          <event-role-component title="Inscrits" makeButton="true" buttonLabel="Bench"></event-role-component>
          <event-role-component title="Benchs" makeButton="true" buttonLabel="Unbench"></event-role-component>
          <event-role-component title="Absents" makeButton="false" buttonLabel="Yo"></event-role-component>
        </v-col>
        <v-col cols="3">
          <p style="font-size:30px">Heal</p>
          <event-role-component title="Inscrits" makeButton="true" buttonLabel="Bench"></event-role-component>
          <event-role-component title="Benchs" makeButton="true" buttonLabel="Unbench"></event-role-component>
          <event-role-component title="Absents" makeButton="false" buttonLabel="Yo"></event-role-component>
        </v-col>
        <v-col cols="3">
          <p style="font-size:30px">DPS</p>
          <event-role-component title="Inscrits" makeButton="true" buttonLabel="Bench"></event-role-component>
          <event-role-component title="Benchs" makeButton="true" buttonLabel="Unbench"></event-role-component>
          <event-role-component title="Absents" makeButton="false" buttonLabel="Yo"></event-role-component>
        </v-col>
        <v-col cols="3">
          <p style="font-size:30px">Actions</p>
          <event-action-component></event-action-component>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import EventInfoComponent from '../js/components/EventInfoComponent.vue';
export default {
  components: { EventInfoComponent },};
</script>
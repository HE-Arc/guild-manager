<template>
  <v-app>
    <event-info-component></event-info-component>
    <v-container class="grey lighten-5" fluid>
      <v-row dense>
        <v-col cols="12" md="6" lg="4">
          <p style="font-size: 2em">Tank</p>
          <event-role-component
            title="Inscrits"
            makeButton="true"
            buttonLabel="Bench"
          ></event-role-component>
          <event-role-component
            title="Benchs"
            makeButton="true"
            buttonLabel="Unbench"
          ></event-role-component>
          <event-role-component
            title="Absents"
            makeButton="false"
            buttonLabel="Yo"
          ></event-role-component>
        </v-col>
        <v-col cols="12" md="6" lg="4">
          <p style="font-size: 2em">Heal</p>
          <event-role-component
            title="Inscrits"
            makeButton="true"
            buttonLabel="Bench"
          ></event-role-component>
          <event-role-component
            title="Benchs"
            makeButton="true"
            buttonLabel="Unbench"
          ></event-role-component>
          <event-role-component
            title="Absents"
            makeButton="false"
            buttonLabel="Yo"
          ></event-role-component>
        </v-col>
        <v-col cols="12" md="6" lg="4">
          <p style="font-size: 2em">DPS</p>
          <event-role-component
            title="Inscrits"
            makeButton="true"
            buttonLabel="Bench"
          ></event-role-component>
          <event-role-component
            title="Benchs"
            makeButton="true"
            buttonLabel="Unbench"
          ></event-role-component>
          <event-role-component
            title="Absents"
            makeButton="false"
            buttonLabel="Yo"
          ></event-role-component>
        </v-col>
      </v-row>
    </v-container>
    <v-speed-dial v-model="fab" fab fixed bottom right>
      <template v-slot:activator>
        <v-btn v-model="fab" color="blue darken-2" dark fab>
          <v-icon v-if="fab"> X </v-icon>
          <v-icon v-else> + </v-icon>
        </v-btn>
      </template>
      <v-btn fab dark small color="green">
        <v-icon>s</v-icon>
      </v-btn>
      <v-btn fab dark small color="indigo">
        <v-icon>m</v-icon>
      </v-btn>
      <v-btn fab dark small color="red">
        <v-icon>d</v-icon>
      </v-btn>
    </v-speed-dial>
  </v-app>
</template>

<script>
import EventInfoComponent from "../js/components/EventInfoComponent.vue";
export default {
  components: { EventInfoComponent },
};
</script>

<template>
  <v-container fluid>
    <v-row>
      <v-col cols="4">
        <h1 v-if="event">{{ event.name }}</h1>
        <h1 v-else>Raid</h1>
      </v-col>
      <v-col cols="8">
        <v-row no-gutters>
          <v-col>
            <v-card class="pa-2" outlined tile>
              <h3 v-if="event">{{ event.location }}</h3>
              <h3 v-else>Lieu</h3>
            </v-card>
          </v-col>
          <v-col>
            <v-card class="pa-2" outlined tile>
              <h3 v-if="event">{{ event.date }}</h3>
              <h3 v-else>Date</h3>
            </v-card>
          </v-col>
        </v-row>
        <v-row no-gutters>
          <v-col>
            <v-card class="pa-2" outlined tile>
              <h3 v-if="event">{{ event.nbSubscribed }}/{{ event.maxSubscribed }}</h3>
              <h3 v-else>Nombre de participants</h3>
            </v-card>
          </v-col>
          <v-col>
            <v-card class="pa-2" outlined tile>
              <h3 v-if="event">{{ event.deadline }}</h3>
              <h3 v-else>Deadline</h3>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  props: ["eventId"],
  data() {
    return {
      event,
    };
  },
  methods: {
    loadEvent() {
      let _this = this;

      // Get event
      axios
        .get("/api/event/" + this.eventId)
        .then(function (response) {
          _this.event = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created: function () {
    this.loadEvent();
  },
};
</script>

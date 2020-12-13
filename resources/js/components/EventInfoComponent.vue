<template>
  <v-container v-if="event" fluid>
    <v-row>
      <v-col cols="4">
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <div v-bind="attrs" v-on="on">
              <h1>{{ event.name }}</h1>
            </div>
          </template>
          <span>Nom du raid</span>
        </v-tooltip>
      </v-col>
      <v-col cols="8">
        <v-row no-gutters>
          <v-col>
            <v-card class="pa-2" outlined tile>
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <div v-bind="attrs" v-on="on">
                    <h3>{{ event.location }}</h3>
                  </div>
                </template>
                <span>Lieu</span>
              </v-tooltip>
            </v-card>
          </v-col>
          <v-col>
            <v-card class="pa-2" outlined tile>
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <div v-bind="attrs" v-on="on">
                    <h3>{{ event.date }}</h3>
                  </div>
                </template>
                <span>Date</span>
              </v-tooltip>
            </v-card>
          </v-col>
        </v-row>
        <v-row no-gutters>
          <v-col>
            <v-card class="pa-2" outlined tile>
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <div v-bind="attrs" v-on="on">
                    <h3>{{ event.nbSubscribed }}/{{ event.maxSubscribed }}</h3>
                  </div>
                </template>
                <span>Nombre de participants</span>
              </v-tooltip>
            </v-card>
          </v-col>
          <v-col>
            <v-card class="pa-2" outlined tile>
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <div v-bind="attrs" v-on="on">
                    <h3>{{ event.deadline }}</h3>
                  </div>
                </template>
                <span>Date limite pour l'inscription</span>
              </v-tooltip>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
  <v-container v-else fill-height fluid>
    <v-row align="center" justify="center">
      <v-col style="text-align: center">
        <v-progress-circular
          indeterminate
          color="primary"
          :size="70"
        ></v-progress-circular>
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

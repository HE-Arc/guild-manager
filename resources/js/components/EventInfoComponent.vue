<!--TODO display with vuetify list-->
<template>
  <v-container fluid>
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
                    <h3>{{ event.location.name }}</h3>
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
                    <h3>{{ event.formated_date }}</h3>
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
                    <h3>
                      {{ event.subscription_count }}/{{ event.player_count }}
                    </h3>
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
                    <h3>{{ event.formated_subscription_delay }}</h3>
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
</template>

<script>
export default {
  props: ["event"],
  data: () => ({
  }),
  methods: {    
  },
  created: function () {
  },
};
</script>

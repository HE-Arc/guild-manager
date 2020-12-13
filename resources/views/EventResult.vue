<template>
  <v-app>
    <v-container v-if="event != null" fluid>
      <v-row>
        <v-col class="col-sm-12 col-md-6">
          <h1>{{ event.name }}</h1>
        </v-col>
        <v-col class="col-sm-12 col-md-6">
          <v-list dense>
            <v-list-item-group color="primary">
              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-clock</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>
                    {{ event.formated_date }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item>
                <v-list-item-icon>
                  <v-icon>mdi-flag</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>
                    {{ event.location.name }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-col>
      </v-row>
      <v-row>
        <v-col class="col-sm-12 col-md-8">
          <v-data-table
            :headers="lootHistoryHeaders"
            :items="lootHistory"
            sort-by="date"
            class="elevation-1"
            :loading="loadingLootHistory ? 'loading' : 'done'"
            :loading-text="
              loadingLootHistory ? 'Chargement en cours...' : 'Aucune donnée'
            "
            hide-default-footer
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title>Historique des loots</v-toolbar-title>
              </v-toolbar>
            </template>
            <template v-slot:[`item.character`]="{ item }">
              <router-link :to="'/character/' + item.character.id">
                {{ item.character.name }}
              </router-link>
            </template>
          </v-data-table>
        </v-col>
        <v-col class="col-sm-12 col-md-4">
          <v-data-table
            :headers="subscriptionsHeaders"
            :items="subscriptions"
            sort-by="date"
            class="elevation-1"
            :loading="loadingSubscriptions ? 'loading' : 'done'"
            :loading-text="
              loadingSubscriptions ? 'Chargement en cours...' : 'Aucune donnée'
            "
            hide-default-footer
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title>
                  Participants [{{ event.subscription_count }}/{{
                    event.player_count
                  }}]
                </v-toolbar-title>
              </v-toolbar>
            </template>
          </v-data-table>
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
  </v-app>
</template>

<script>
export default {
  props: ["eventId"],
  data: () => ({
    event: null,
    lootHistory: [],
    subscriptions: [],
    loadingLootHistory: true,
    loadingSubscriptions: true,
    lootHistoryHeaders: [
      { text: "Pièce", value: "item.name" },
      { text: "Rareté", value: "item.rarity" },
      { text: "Personnage", value: "character" },
    ],
    subscriptionsHeaders: [
      { text: "Nom", value: "name" },
      { text: "Role", value: "role.name" },
    ],
  }),
  methods: {
    loadLootHistory() {
      let _this = this;

      // Get loot history
      this.lootHistory = [];
      this.loadingLootHistory = true;
      
      axios
        .get("/api/event/" + this.event.id + "/histories")
        .then(function (response) {
          _this.lootHistory = response.data;
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function (response) {
          _this.loadingLootHistory = false;
        });
    },
    loadSubscriptions() {
      let _this = this;

      // Get subscriptions
      this.subscriptions = [];
      this.loadingSubscriptions = true;
      axios
        .get("/api/event/" + this.event.id + "/subscriptions")
        .then(function (response) {
          _this.subscriptions = response.data.roster;
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function (response) {
          _this.loadingSubscriptions = false;
        });
    },
  },
  created: function () {
    let _this = this;

    // Get the event
    axios
      .get("/api/event/" + this.eventId)
      .then(function (response) {
        _this.event = response.data;
        _this.loadSubscriptions();
        _this.loadLootHistory();
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>
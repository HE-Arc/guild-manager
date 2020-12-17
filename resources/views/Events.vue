<template>
  <v-app>
    <v-container fluid>
      <v-row>
        <v-col class="col-sm-12 col-md-auto">
          <h1>Mes évênements</h1>
        </v-col>
        <v-col class="col-sm-12 col-md-4 mr-auto">
          <v-select
            @change="onChangeCharacter($event)"
            v-model="selectedCharacter"
            :items="characters"
            item-text="name"
            item-value="id"
            label="Personnage"
            style="text-overflow: ellipsis"
            solo
          ></v-select>
        </v-col>
        <v-col class="col-sm-12 col-md-auto" style="text-align: right">
          <v-btn
            color="primary"
            dark
            class="mb-2"
            @click="$router.push({ name: 'event-new' })"
          >
            <v-icon left>mdi-plus</v-icon>
            Nouvel évênement
          </v-btn>
        </v-col>
      </v-row>

      <div style="margin: 0 0 20px 0">
        <v-alert v-model="eventDeleted" type="success" dismissible>
          {{ eventDeletedLabel }}
        </v-alert>
      </div>

      <div v-if="selectedCharacter != null">
        <v-data-table
          :headers="ongoingEventsHeaders"
          :items="ongoingEvents"
          sort-by="date"
          class="elevation-1"
          :loading="loadingEvents ? 'loading' : 'done'"
          :loading-text="
            loadingEvents ? 'Chargement en cours...' : 'Aucune donnée'
          "
        >
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Prochains évênements</v-toolbar-title>
            </v-toolbar>
          </template>
          <template v-slot:[`item.name`]="{ item }">
            <router-link :to="'/event/' + item.id">
              {{ item.name }}
            </router-link>
          </template>
          <template v-slot:[`item.location`]="{ item }">
            {{ item.location.name }}
          </template>
          <template v-slot:[`item.playerCount`]="{ item }">
            {{ item.subscription_count }} / {{ item.player_count }}
          </template>
          <template v-slot:[`item.status`]="{ item }">
            <v-chip
              :color="item.boss_id != null ? 'green' : 'red'"
              small
              dark
            ></v-chip>
          </template>
          <template v-slot:[`item.state`]="{ item }">
            <v-chip
              :color="getEventStatusColor(item.subscribed, item.skipped)"
              small
              dark
            >
              {{ getEventStatusLabel(item.subscribed, item.skipped) }}
            </v-chip>
          </template>
          <template v-slot:[`item.actions`]="{ item }">
            <div v-if="item.subscribed">
              <v-btn
                v-if="item.skipped"
                color="green"
                small
                dark
                @click="subscribe(item)"
              >
                Rejoindre
              </v-btn>
              <v-btn v-else color="orange" small dark @click="skip(item)">
                Passer
              </v-btn>
            </div>
            <div v-else>
              <v-btn color="green" small dark @click="subscribe(item)">
                Joindre
              </v-btn>
              <v-btn color="orange" small dark @click="skip(item)">
                Passer
              </v-btn>
            </div>
          </template>
        </v-data-table>
        <v-data-table
          :headers="finishedEventsHeaders"
          :items="finishedEvents"
          sort-by="date"
          class="elevation-1"
          :loading="loadingEvents ? 'loading' : 'done'"
          :loading-text="
            loadingEvents ? 'Chargement en cours...' : 'Aucune donnée'
          "
        >
          <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Terminés</v-toolbar-title>
            </v-toolbar>
          </template>
          <template v-slot:[`item.name`]="{ item }">
            <!-- TODO $router.push('/event/{id}') -->
            <v-btn small @click="$router.push('/event/prep')">
              {{ item.name }}
              <v-icon right>mdi-arrow-right</v-icon>
            </v-btn>
          </template>
          <template v-slot:[`item.location`]="{ item }">
            {{ item.location.name }}
          </template>
          <template v-slot:[`item.state`]="{ item }">
            <v-chip
              :color="getEventStatusColor(item.subscribed, item.skipped)"
              small
              dark
            >
              {{ getEventStatusLabel(item.subscribed, item.skipped) }}
            </v-chip>
          </template>
        </v-data-table>
      </div>
      <div v-else>
        <v-alert type="info">Veuillez sélectionner un personnage.</v-alert>
      </div>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      ongoingEventsHeaders: [
        { text: "Nom", value: "name" },
        { text: "Lieu", value: "location" },
        { text: "Date", value: "formated_date" },
        { text: "Délais", value: "formated_subscription_delay" },
        { text: "Inscrits", value: "playerCount" },
        { text: "En cours", value: "status" },
        { text: "État", value: "state" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      ongoingEvents: [],
      finishedEventsHeaders: [
        { text: "Nom", value: "name" },
        { text: "Lieu", value: "location" },
        { text: "Date", value: "formated_date" },
        { text: "Participation", value: "state" },
      ],
      finishedEvents: [],
      loadingEvents: false,
      characters: [],
      selectedCharacter: null,
      eventDeleted: this.$route.params.deleted ? true : false,
      eventDeletedLabel:
        "Événement " + this.$route.params.deleted + " supprimé.",
    };
  },
  methods: {
    clickItem(item) {
      console.log(item);
    },
    subscribe(event) {
      let _this = this;

      axios
        .post(
          "/api/character/" +
            this.selectedCharacter +
            "/event/" +
            event.id +
            "/subscribe"
        )
        .then(function (response) {
          _this.loadEvents();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    skip(event) {
      let _this = this;

      axios
        .post(
          "/api/character/" +
            this.selectedCharacter +
            "/event/" +
            event.id +
            "/skip"
        )
        .then(function (response) {
          _this.loadEvents();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getEventStatusColor(subscribed, skipped) {
      return subscribed ? (skipped ? "orange" : "green") : "gray";
    },
    getEventStatusLabel(subscribed, skipped) {
      return subscribed ? (skipped ? "absent" : "inscrit") : "non-inscrit";
    },
    onChangeCharacter(event) {
      this.loadEvents();
    },
    loadEvents() {
      let characterId = this.selectedCharacter;
      let _this = this;

      // Get my events
      this.events = [];
      this.loadingEvents = true;
      axios
        .get("/api/character/" + characterId + "/events")
        .then(function (response) {
          _this.ongoingEvents = response.data.filter(
            (event) => !event.finished
          );
          _this.finishedEvents = response.data.filter(
            (event) => event.finished
          );
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function (response) {
          _this.loadingEvents = false;
        });
    },
  },
  created: function () {
    let _this = this;

    // Get my characters
    axios
      .get("/api/characters")
      .then(function (response) {
        _this.characters = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>

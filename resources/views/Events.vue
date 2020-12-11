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

      <div v-if="selectedCharacter != null">
        <v-data-table
          :headers="headers"
          :items="events"
          sort-by="date"
          class="elevation-1"
          :loading="loadingEvents ? 'loading' : 'done'"
        >
          <template v-slot:[`item.name`]="{ item }">
            <!-- TODO $router.push('/event/{id}') -->
            <v-btn small @click="$router.push('/event/' + item.id)">
              {{ item.name }}
              <v-icon right>mdi-arrow-right</v-icon>
            </v-btn>
          </template>
          <template v-slot:[`item.location`]="{ item }">
            {{ item.location.name }}
          </template>
          <template v-slot:[`item.status`]="{ item }">
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
      headers: [
        { text: "Nom", value: "name" },
        { text: "Lieu", value: "location" },
        { text: "Date", value: "date" },
        //{ text: "Délais", value: "delay" },
        //{ text: "Inscrits", value: "subscribed" },
        //{ text: "Total", value: "total" },
        { text: "État", value: "status" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      events: [],
      loadingEvents: false,
      characters: [],
      selectedCharacter: null,
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
      return subscribed ? (skipped ? "absent" : "inscrit") : "indécis";
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
          _this.events = response.data;
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
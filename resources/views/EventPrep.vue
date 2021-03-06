<template>
  <v-app>
    <div v-if="event && eventCharacters">
      <event-info-component v-bind:event="event"></event-info-component>
      <v-container fluid>
        <v-row dense>
          <v-col cols="12" md="6" lg="4">
            <template>
              <v-card>
                <v-card-title>
                  <h3>Roster</h3>
                  <v-spacer></v-spacer>
                  <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                  ></v-text-field>
                </v-card-title>
                <v-data-table
                  dense
                  :headers="computedHeaders"
                  :items="rosterCharacters"
                  sort-by="name"
                  group-by="role"
                  class="elevation-1"
                  show-group-by
                  :search="search"
                  :loading="loadingEventCharacters ? 'loading' : 'done'"
                  :loading-text="
                    loadingEventCharacters ? 'Chargement en cours...' : 'Aucune donnée'
                  "
                >
                  <template v-slot:[`item.name`]="{ item }">
                    {{ item.name }}
                  </template>
                  <template
                    v-slot:[`item.class_id`]="{ item }"
                    v-if="!$vuetify.breakpoint.xsAndDown"
                  >
                    {{ item.class_id }}
                  </template>
                  <template
                    v-slot:[`item.role_id`]="{ item }"
                    v-if="!$vuetify.breakpoint.xsAndDown"
                  >
                    {{ item.role_id }}
                  </template>
                  <template v-slot:[`item.action`]="{ item }">
                    <v-btn
                      v-if="isOrganiser()"
                      color="orange"
                      small
                      dark
                      @click="bench(item)"
                    >
                      Bench
                    </v-btn>
                  </template>
                </v-data-table>
              </v-card>
            </template>
          </v-col>
          <v-col cols="12" md="6" lg="4">
            <template>
              <v-card>
                <v-card-title>
                  <h3>Bench</h3>
                  <v-spacer></v-spacer>
                  <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                  ></v-text-field>
                </v-card-title>
                <v-data-table
                  dense
                  :headers="computedHeaders"
                  :items="benchCharacters"
                  sort-by="name"
                  group-by="role"
                  class="elevation-1"
                  show-group-by
                  :search="search"
                  :loading="loadingEventCharacters ? 'loading' : 'done'"
                  :loading-text="
                    loadingEventCharacters ? 'Chargement en cours...' : 'Aucune donnée'
                  "
                >
                  <template v-slot:[`item.name`]="{ item }">
                    {{ item.name }}
                  </template>
                  <template
                    v-slot:[`item.class_id`]="{ item }"
                    v-if="!$vuetify.breakpoint.xsAndDown"
                  >
                    {{ item.class_id }}
                  </template>
                  <template
                    v-slot:[`item.role_id`]="{ item }"
                    v-if="!$vuetify.breakpoint.xsAndDown"
                  >
                    {{ item.role_id }}
                  </template>
                  <template v-slot:[`item.action`]="{ item }">
                    <v-btn
                      v-if="isOrganiser()"
                      color="green"
                      small
                      dark
                      @click="unbench(item)"
                    >
                      Unbench
                    </v-btn>
                  </template>
                </v-data-table>
              </v-card>
            </template>
          </v-col>
          <v-col cols="12" md="6" lg="4">
            <template>
              <v-card>
                <v-card-title>
                  <h3>Absent</h3>
                  <v-spacer></v-spacer>
                  <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                  ></v-text-field>
                </v-card-title>
                <v-data-table
                  dense
                  :headers="computedHeaders"
                  :items="absentCharacters"
                  sort-by="name"
                  group-by="role"
                  class="elevation-1"
                  show-group-by
                  :search="search"
                  :loading="loadingEventCharacters ? 'loading' : 'done'"
                  :loading-text="
                    loadingEventCharacters ? 'Chargement en cours...' : 'Aucune donnée'
                  "
                >
                  <template v-slot:[`item.name`]="{ item }">
                    {{ item.name }}
                  </template>
                  <template
                    v-slot:[`item.class_id`]="{ item }"
                    v-if="!$vuetify.breakpoint.xsAndDown"
                  >
                    {{ item.class_id }}
                  </template>
                  <template
                    v-slot:[`item.role_id`]="{ item }"
                    v-if="!$vuetify.breakpoint.xsAndDown"
                  >
                    {{ item.role_id }}
                  </template>
                </v-data-table>
              </v-card>
            </template>
          </v-col>
        </v-row>
      </v-container>
      <div v-if="isOrganiser()">
        <v-speed-dial v-if="event.boss_id" v-model="fab" fixed bottom right>
          <template v-slot:activator>
            <v-tooltip left>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on">
                  <v-btn fab dark color="green" @click="playEvent()">
                    <v-icon>mdi-play</v-icon>
                  </v-btn>
                </div>
              </template>
              <span>Continuer</span>
            </v-tooltip>
          </template>
        </v-speed-dial>
        <v-speed-dial v-else v-model="fab" fixed bottom right>
          <template v-slot:activator>
            <v-tooltip left>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on">
                  <v-btn fab color="blue darken-2" dark>
                    <v-icon v-if="fab"> x </v-icon>
                    <v-icon v-else> + </v-icon>
                  </v-btn>
                </div>
              </template>
              <span>Actions</span>
            </v-tooltip>
          </template>
          <v-tooltip left>
            <template v-slot:activator="{ on, attrs }">
              <div v-bind="attrs" v-on="on">
                <v-btn fab dark color="green" @click="playEvent()">
                  <v-icon>mdi-play</v-icon>
                </v-btn>
              </div>
            </template>
            <span>Lancer l'événement</span>
          </v-tooltip>
          <v-tooltip left>
            <template v-slot:activator="{ on, attrs }">
              <div v-bind="attrs" v-on="on">
                <v-btn fab dark color="indigo" @click="modifyEvent()">
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </div>
            </template>
            <span>Modifier l'événement</span>
          </v-tooltip>
          <v-tooltip left>
            <template v-slot:activator="{ on, attrs }">
              <div v-bind="attrs" v-on="on">
                <v-btn fab dark color="red" @click="deleteEvent()">
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
              </div>
            </template>
            <span>Supprimer l'événement</span>
          </v-tooltip>
        </v-speed-dial>
      </div>
    </div>
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
import EventInfoComponent from "../js/components/EventInfoComponent.vue";
export default {
  components: { EventInfoComponent },
  computed: {
    computedHeaders() {
      return this.headers.filter((h) => !h.hide || !this.$vuetify.breakpoint[h.hide]);
    },
  },
  data() {
    return {
      search: "",
      headers: [
        { text: "Nom", value: "name", groupable: false },
        { text: "Classe", value: "class", hide: "xs" },
        { text: "Rôle", value: "role", hide: "xs" },
        { text: "Action", value: "action", sortable: false, groupable: false },
      ],
      loadingEventCharacters: false,
      eventCharacters: [],
      rosterCharacters: [],
      benchCharacters: [],
      absentCharacters: [],
      eventId: this.$route.params["id"],
      event: null,
    };
  },
  methods: {
    clickItem(item) {
      console.log(item);
    },
    isOrganiser() {
      return this.event.gm_user_id == this.$store.state.token ? true : false;
    },
    bench(character) {
      let _this = this;

      axios
        .post("/api/character/" + character.id + "/event/" + this.eventId + "/bench")
        .then(function (response) {
          _this.loadEventCharacters();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    unbench(character) {
      let _this = this;

      axios
        .post("/api/character/" + character.id + "/event/" + this.eventId + "/unbench")
        .then(function (response) {
          _this.loadEventCharacters();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadEvent() {
      let _this = this;

      console.log(this.eventId);
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
    loadEventCharacters() {
      let _this = this;

      // Get event
      this.eventCharacters = [];
      this.loadingEventCharacters = true;
      axios
        .get("/api/eventCharacters/" + this.eventId)
        .then(function (response) {
          _this.eventCharacters = response.data;
          _this.rosterCharacters = _this.eventCharacters["roster"];
          _this.benchCharacters = _this.eventCharacters["bench"];
          _this.absentCharacters = _this.eventCharacters["absent"];
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function (response) {
          _this.loadingEventCharacters = false;
        });
    },
    modifyEvent() {
      this.$router.push({
        path: "/event/" + this.eventId + "/update",
      });
    },
    playEvent() {
      let _this = this;

      axios
        .post("/api/event/" + this.eventId + "/run/" + this.event.location_id)
        .then(function (response) {
          _this.$router.push({
            name: "event-running",
            params: { eventId: _this.eventId },
          });
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteEvent() {
      let _this = this;

      axios
        .post("/api/event/" + this.eventId + "/delete")
        .then(function (response) {
          _this.$router.push({
            name: "events",
            params: { deleted: response.data },
          });
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created: function () {
    this.loadEvent();
    this.loadEventCharacters();
  },
};
</script>

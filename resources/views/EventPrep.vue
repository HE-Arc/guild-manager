<template>
  <v-app>
    <event-info-component></event-info-component>
    <v-container class="grey lighten-5" fluid>
      <v-row dense>
        <v-col cols="12" md="6" lg="4">
          <template>
            <v-card>
              <v-card-title>
                <h2>Roster</h2>
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
                hide-default-footer
                :headers="computedHeaders"
                :items="rosterCharacters"
                sort-by="name"
                group-by="role"
                class="elevation-1"
                show-group-by
                :search="search"
                :loading="loadingEventCharacters ? 'loading' : 'done'"
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
                  <v-btn color="orange" small dark @click="bench(item)"> Bench </v-btn>
                </template>
              </v-data-table>
            </v-card>
          </template>
        </v-col>
        <v-col cols="12" md="6" lg="4">
          <template>
            <v-card>
              <v-card-title>
                <h2>Bench</h2>
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
                hide-default-footer
                :headers="computedHeaders"
                :items="benchCharacters"
                sort-by="name"
                group-by="role"
                class="elevation-1"
                show-group-by
                :search="search"
                :loading="loadingEventCharacters ? 'loading' : 'done'"
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
                  <v-btn color="green" small dark @click="unbench(item)"> Unbench </v-btn>
                </template>
              </v-data-table>
            </v-card>
          </template>
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
    <!-- <v-speed-dial v-model="fab" fab fixed bottom right>
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
    </v-speed-dial> -->
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
    };
  },
  methods: {
    clickItem(item) {
      console.log(item);
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
    loadEventCharacters() {
      let _this = this;

      // Get event
      this.eventCharacters = [];
      this.loadingEventCharacters = true;
      axios
        .get("/api/event/" + this.eventId)
        .then(function (response) {
          _this.eventCharacters = response.data;
          _this.rosterCharacters = _this.eventCharacters['roster'];
          _this.benchCharacters = _this.eventCharacters['bench'];
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function (response) {
          _this.loadingEventCharacters = false;
        });
    },
  },
  created: function () {
    this.loadEventCharacters();
  },
};
</script>

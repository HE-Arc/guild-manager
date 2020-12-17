<template>
  <v-app>
    <v-container fluid>
      <v-row>
        <v-col class="col-auto mr-auto">
          <h1>{{ event.name }}</h1>
        </v-col>
        <v-col class="col-auto" style="text-align: bottom">
          <v-btn
            color="primary"
            small
            dark
            class="mb-2"
            @click="
              $router.push({ name: 'event-prep', params: { eventId: this.eventId } })
            "
          >
            <v-icon left>mdi-pen</v-icon>
            Gérer les participants
          </v-btn>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-select
            v-model="bosses"
            :items="bosses"
            item-text="name"
            item-value="id"
            :label="currentBoss.name"
          ></v-select>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-btn color="primary" dark class="mb-2" @click="nextBoss()">            
            Boss suivant
            <v-icon right>mdi-arrow-right</v-icon>
          </v-btn>
        </v-col>
      </v-row>
      <v-row dense>
        <v-col cols="12" md="6">
          <template>
            <v-card>
              <v-card-title>
                <h3>{{ currentBoss.name }}</h3>
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
                :headers="itemHeaders"
                :items="bossItems"
                sort-by="name"
                class="elevation-1"
                :search="search"
                :loading="loadingBossItems ? 'loading' : 'done'"
                :loading-text="
                  loadingBossItems ? 'Chargement en cours...' : 'Aucune donnée'
                "
              >
                <template v-slot:[`item.name`]="{ item }">
                  {{ item.name }}
                </template>
                <template
                  v-slot:[`item.rarity`]="{ item }"
                  v-if="!$vuetify.breakpoint.xsAndDown"
                >
                  {{ item.rarity }}
                </template>
                <template
                  v-slot:[`item.type`]="{ item }"
                  v-if="!$vuetify.breakpoint.xsAndDown"
                >
                  {{ item.type }}
                </template>
                <template v-slot:[`item.action`]="{ item }">
                  <v-select
                    v-model="rosterCharacters"
                    :items="characters"
                    item-text="name"
                    item-value="id"
                    label="Assigner à..."
                  ></v-select>
                </template>
              </v-data-table>
            </v-card>
          </template>
        </v-col>
        <v-col cols="12" md="6">
          <v-card-title>
            <h3>Pièces attribuées</h3>
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
            :headers="lootHistoryHeaders"
            :items="lootHistory"
            sort-by="date"
            class="elevation-1"
            :search="search"
            :loading="loadingLootHistory ? 'loading' : 'done'"
            :loading-text="
              loadingLootHistory ? 'Chargement en cours...' : 'Aucune donnée'
            "
            hide-default-footer
          >
            <template v-slot:[`item.itemName`]="{ item }">
              {{ item.itemName }}
            </template>
            <template v-slot:[`item.recipient`]="{ item }">
              {{ item.recipient }}
            </template>
            <template
              v-slot:[`item.type`]="{ item }"
              v-if="!$vuetify.breakpoint.xsAndDown"
            >
              {{ item.type }}
            </template>
            <template v-slot:[`item.action`]="{ item }">
              <v-btn dark color="orange" @click="unassign(item)">
                Désattribuer ></v-btn
              >
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
export default {
  computed: {
    computedHeaders() {
      return this.headers.filter((h) => !h.hide || !this.$vuetify.breakpoint[h.hide]);
    },
  },
  data() {
    // TODO : edit
    return {
      search: "",
      itemHeaders: [
        { text: "Nom", value: "name" },
        { text: "Rareté", value: "rarity", hide: "xs" },
        { text: "Type", value: "type", hide: "xs" },
        { text: "Action", value: "action", sortable: false },
      ],
      lootHistoryHeaders: [
        { text: "Nom", value: "name" },
      ],
      event: null,
      bossItems: null,
      bosses: null,
      bossId: null,
      currentBoss: null,
      lootHistory: null,
      loadingBossItems: false,
      loadingLootHistory: false,
      eventId: this.$route.params["id"],
    };
  },
  methods: {
    clickItem(item) {
      console.log(item);
    },
    loadEvent() {
      let _this = this;
      
      console.log(this.eventId);
      // Get event
      axios
        .get("/api/event/" + this.eventId)
        .then(function (response) {
          _this.event = response.data;
          _this.loadBosses();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadBosses() {
      let _this = this;

      console.log(this.event);
      console.log(this.event.location_id);
      // Get bosses for this location
      axios
        .get("/api/locationBosses/" + this.event.location_id)
        .then(function (response) {
          _this.bosses = response.data;
          //console.log(_this.bosses[0]);
          _this.bossId = _this.bosses[0].id;        
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadBoss() {
      let _this = this;

      // Get current boss
      axios
        .get("/api/boss/" + this.bossId)
        .then(function (response) {
          _this.currentBoss = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadBossItems() {
      let _this = this;

      // Get bosses for this location
      axios
        .get("/api/bossItems/" + this.bossId)
        .then(function (response) {
          _this.items = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    unassign(assignament) {
      console.log("unnasigning" + assignament);
    }
  },
  created: function () {
    this.loadEvent();
    
    this.loadBoss();
    this.loadBossItems();
  },
};
</script>

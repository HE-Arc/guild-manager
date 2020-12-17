<template>
  <v-app>
    <v-container v-if="event && bosses && bossItems" fluid>
      <v-row>
        <v-col class="col-auto mr-auto">
          <h1>{{ event.name }}</h1>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-btn
            color="primary"
            small
            dark
            class="mb-2"
            @click="$router.push({ name: 'event-prep', params: { eventId: eventId } })"
          >
            <v-icon left>mdi-pen</v-icon>
            Gérer les participants
          </v-btn>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-select
            @change="updateBoss()"
            v-model="bossId"
            :items="bosses"
            item-text="name"
            item-value="id"
            label="Changer de boss"
          ></v-select>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-btn large color="primary" dark class="mb-2" @click="nextBoss()">
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
                :headers="computedItemsHeaders"
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
                    @change="assign(item.id)"
                    v-model="selectedCharacter"
                    :items="subscriptions"
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
          <template>
            <v-card>
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
                class="elevation-1"
                :search="search"
                :loading="loadingLootHistory ? 'loading' : 'done'"
                :loading-text="
                  loadingLootHistory ? 'Chargement en cours...' : 'Aucune donnée'
                "
                hide-default-footer
              >
                <template v-slot:[`item.item.name`]="{ item }">
                  {{ item.item.name }}
                </template>
                <template v-slot:[`item.character.name`]="{ item }">
                  {{ item.character.name }}
                </template>
                <template v-slot:[`item.action`]="{ item }">
                  <v-btn dark color="orange" @click="unassign(item)"> Désattribuer</v-btn>
                </template>
              </v-data-table>
            </v-card>
          </template>
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
  computed: {
    computedItemsHeaders() {
      return this.itemsHeaders.filter(
        (h) => !h.hide || !this.$vuetify.breakpoint[h.hide]
      );
    },
  },
  data() {
    // TODO : edit
    return {
      search: "",
      itemsHeaders: [
        { text: "Pièce", value: "name" },
        { text: "Rareté", value: "rarity", hide: "xs" },
        { text: "Type", value: "type", hide: "xs" },
        { text: "Action", value: "action", sortable: false },
      ],
      lootHistoryHeaders: [
        { text: "Pièce", value: "item.name" },
        { text: "Personnage", value: "character.name" },
        { text: "Action", value: "action", sortable: false },
      ],
      event: null,
      bosses: null,
      bossId: null,
      index: 0,
      currentBoss: null,
      bossItems: null,
      subscriptions: null,
      selectedCharacter: null,
      lootHistory: null,
      loadingBossItems: false,
      loadingLootHistory: false,
      loadingSubscriptions: false,
      eventId: this.$route.params["id"],
    };
  },
  methods: {
    clickItem(item) {
      console.log(item);
    },
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
        })
        .then(function () {
          //console.log(_this.event);
          _this.loadBosses();
          _this.loadLootHistory();
          _this.loadSubscriptions();
        });
    },
    loadBosses() {
      let _this = this;

      // Get bosses for this location
      axios
        .get("/api/locationBosses/" + this.event.location_id)
        .then(function (response) {
          _this.bosses = response.data;
          _this.bossId = _this.event.boss_id;
          _this.updateBoss();
          //console.log(_this.bossId);
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function () {
          //console.log(_this.bosses);
          _this.loadBossItems();
        });
    },
    loadBossItems() {
      let _this = this;

      // Get bosses for this location
      this.loadingBossItems = true;
      axios
        .get("/api/bossItems/" + this.bossId)
        .then(function (response) {
          _this.bossItems = response.data;
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function () {
          _this.loadingBossItems = false;
          //console.log(_this.bossItems);
        });
    },
    loadLootHistory() {
      let _this = this;

      // Get loot history
      this.loadingLootHistory = true;

      console.log(this.event.id);

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
          console.log(_this.lootHistory[0].character.name);
        });
    },
    loadSubscriptions() {
      let _this = this;

      // Get subscriptions
      this.loadingSubscriptions = true;
      axios
        .get("/api/eventCharacters/" + this.eventId)
        .then(function (response) {
          _this.subscriptions = response.data.roster;
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function (response) {
          _this.loadingSubscriptions = false;
          console.log(_this.subscriptions);
        });
    },
    updateBoss() {
      this.currentBoss = this.bosses.find((boss) => boss.id === this.bossId);
      this.index = this.bosses.indexOf(this.currentBoss);
      this.loadBossItems();
    },
    nextBoss() {
      this.index++;
      if (this.index >= this.bosses.length)
        this.$router.push({
          name: "event-result",
          params: { eventId: this.eventId },
        });
      else {
        this.currentBoss = this.bosses[this.index];
        this.loadBossItems();
      }
    },
    assign(itemId) {
      let _this = this;

      console.log("check");
      console.log(this.eventId);
      console.log(itemId);
      console.log(this.selectedCharacter);

      axios
        .post("/api/history/create", {
          event_id: this.eventId,
          item_id: itemId,
          character_id: this.selectedCharacter,
        })
        .then(function (response) {
          _this.loadLootHistory();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    unassign(lootHistory) {
      let _this = this;

      axios
        .post("/api/history/" + lootHistory.id + "/delete")
        .then(function (response) {
          _this.loadLootHistory();
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

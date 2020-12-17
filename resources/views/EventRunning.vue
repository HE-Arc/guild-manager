<template>
  <v-app>
    <v-container fluid>
      <v-row>
        <v-col class="col-auto mr-auto">
          <h1>{{ event.name }}</h1>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-btn
            color="primary"
            dark
            class="mb-2"
            @click="
              $router.push({ name: 'event-prep', params: { bossId: currentBoss.id } })
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
            label="Aller au boss..."
          ></v-select>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-btn color="primary" dark class="mb-2" @click="nextBoss()">
            <v-icon left>mdi-arrow</v-icon>
            Boss suivant
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
            :loading="loadingLootHistory ? 'loading' : 'done'"
            :search="search"
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
              <v-btn dark color="orange" @click="unassign(item.id)">
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
      modifying: false,
    };
  },
  methods: {
    clickItem(item) {
      console.log(item);
    },
  },
  created: function () {
    //TODO
  },
};
</script>

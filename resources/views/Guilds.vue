<template>
  <v-app>
    <v-container fluid>
      <v-row>
        <v-col class="col-auto mr-auto">
          <h1>Mes guildes</h1>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-btn
            color="primary"
            dark
            class="mb-2"
            @click="$router.push({ name: 'guild-new' })"
          >
            <v-icon left>mdi-plus</v-icon>
            Nouvelle guilde
          </v-btn>
        </v-col>
      </v-row>

      <div style="margin: 0 0 20px 0">
        <v-alert v-model="guildDeleted" type="success" dismissible>
          {{ guildDeletedLabel }}
        </v-alert>
      </div>

      <v-data-table
        :headers="guildsHeaders"
        :items="guilds"
        sort-by="name"
        class="elevation-1"
        :loading="loadingGuilds ? 'loading' : 'done'"
        :loading-text="
          loadingGuilds ? 'Chargement en cours...' : 'Aucune donnée'
        "
      >
        <template v-slot:[`item.name`]="{ item }">
          <router-link :to="'/guild/' + item.id">
            {{ item.name }}
          </router-link>
        </template>
        <template v-slot:[`item.faction`]="{ item }">
          <v-chip :color="getFactionColor(item.faction.name)" small dark>
            {{ item.faction.name }}
          </v-chip>
        </template>
      </v-data-table>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      guildsHeaders: [
        { text: "Nom", value: "name" },
        { text: "Membres", value: "player_count" },
        { text: "Faction", value: "faction" },
        { text: "Serveur", value: "server.name" },
      ],
      guilds: [],
      loadingGuilds: true,
      guildDeleted: this.$route.params.deleted ? true : false,
      guildDeletedLabel: "Guilde " + this.$route.params.deleted + " supprimée.",
    };
  },
  methods: {
    getFactionColor(faction) {
      return faction == "Alliance" ? "blue darken-4" : "red darken-4";
    },
  },
  created: function () {
    let _this = this;

    // Get my guilds
    this.guilds = [];
    this.loadingGuilds = true;
    axios
      .get("/api/guilds")
      .then(function (response) {
        _this.guilds = response.data;
      })
      .catch(function (error) {
        console.log(error);
      })
      .then(function (response) {
        _this.loadingGuilds = false;
      });
  },
};
</script>

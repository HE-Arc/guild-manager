<template>
  <v-app>
    <v-container v-if="character != null" fluid>
      <v-row>
        <v-col>
          <h1>{{ character.name }}</h1>
          <h3>
            Utilisateur: <b>{{ character.user.name }}</b>
          </h3>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-data-table
            :headers="characterHeaders"
            :items="[character]"
            class="elevation-1"
            hide-default-footer
          >
            <template v-slot:[`item.role`]="{ item }">
              <v-chip :color="getRoleColor(item.role.name)" small dark>
                {{ item.role.name }}
              </v-chip>
            </template>
            <template v-slot:[`item.guild`]="{ item }">
              <div v-if="item.guild">
                <router-link :to="'/guild/' + item.guild.id">
                  {{ item.guild.name }}
                </router-link>
              </div>
              <div v-else>-</div>
            </template>
            <template v-slot:[`item.faction`]="{ item }">
              <v-chip :color="getFactionColor(item.faction.name)" small dark>
                {{ item.faction.name }}
              </v-chip>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-data-table
            :headers="lootHistoryHeaders"
            :items="lootHistory"
            sort-by="event.formated_date"
            class="elevation-1"
            :loading="loadingLootHistory ? 'loading' : 'done'"
            :loading-text="
              loadingLootHistory ? 'Chargement en cours...' : 'Aucune donnée'
            "
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title>Historique des loots</v-toolbar-title>
              </v-toolbar>
            </template>
            <template v-slot:[`item.event`]="{ item }">
              <router-link :to="'/event/' + item.event.id">
                {{ item.event.name }}
              </router-link>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
      <v-row v-if="this.$store.state.token == character.user.id">
        <v-col>
          <h3>Modération</h3>
          <v-btn color="red" dark class="mb-2" @click="deleteCharacter()">
            Supprimer le personnage
          </v-btn>
          <v-btn
            color="primary"
            dark
            class="mb-2"
            @click="$router.push('/character/' + character.id + '/update')"
          >
            Modifier le personnage
          </v-btn>
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
  props: ["characterId"],
  data: () => ({
    character: null,
    characterHeaders: [
      { text: "Role", value: "role" },
      { text: "Classe", value: "character_class.name" },
      { text: "Guilde", value: "guild" },
      { text: "Faction", value: "faction" },
      { text: "Serveur", value: "server.name" },
    ],
    lootHistory: [],
    loadingLootHistory: true,
    lootHistoryHeaders: [
      { text: "Pièce", value: "item.name" },
      { text: "Rareté", value: "item.rarity" },
      { text: "Évênement", value: "event" },
      { text: "Date", value: "event.formated_date" },
    ],
  }),
  methods: {
    getRoleColor(role) {
      if (role == "Healer") return "green";
      else if (role == "Dps") return "red";
      else return "blue";
    },
    getFactionColor(faction) {
      return faction == "Alliance" ? "blue darken-4" : "red darken-4";
    },
    loadLootHistory() {
      let _this = this;

      // Get loot history
      this.lootHistory = [];
      this.loadingLootHistory = true;

      axios
        .get("/api/character/" + this.character.id + "/histories")
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
    deleteCharacter() {
      let _this = this;

      axios
        .post("/api/character/" + _this.character.id + "/delete")
        .then(function (response) {
          _this.$router.push({
            name: "characters",
            params: { deleted: response.data },
          });
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created: function () {
    let _this = this;

    // Get character
    axios
      .get("/api/character/" + this.characterId)
      .then(function (response) {
        _this.character = response.data;
        _this.loadLootHistory();
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>

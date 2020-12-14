<template>
  <v-app>
    <v-container fluid>
      <v-row>
        <v-col class="col-auto mr-auto">
          <h1>Mes personnages</h1>
        </v-col>
        <v-col class="col-auto" style="text-align: right">
          <v-btn
            color="primary"
            dark
            class="mb-2"
            @click="$router.push({ name: 'character-new' })"
          >
            <v-icon left>mdi-plus</v-icon>
            Nouveau personnage
          </v-btn>
        </v-col>
      </v-row>

      <div style="margin: 0 0 20px 0">
        <v-alert v-model="characterDeleted" type="success" dismissible>
          {{ characterDeletedLabel }}
        </v-alert>
      </div>

      <v-data-table
        :headers="charactersHeaders"
        :items="characters"
        sort-by="name"
        class="elevation-1"
        :loading="loadingCharacters ? 'loading' : 'done'"
        :loading-text="
          loadingCharacters ? 'Chargement en cours...' : 'Aucune donnée'
        "
        hide-default-footer
      >
        <template v-slot:[`item.name`]="{ item }">
          <router-link :to="'/character/' + item.id">
            {{ item.name }}
          </router-link>
        </template>
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
    </v-container>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      charactersHeaders: [
        { text: "Nom", value: "name" },
        { text: "Role", value: "role" },
        { text: "Classe", value: "character_class.name" },
        { text: "Guilde", value: "guild" },
        { text: "Faction", value: "faction" },
        { text: "Serveur", value: "server.name" },
      ],
      characters: [],
      loadingCharacters: true,
      characterDeleted: this.$route.params.deleted ? true : false,
      characterDeletedLabel:
        "Personnage " + this.$route.params.deleted + " supprimé.",
    };
  },
  methods: {
    getRoleColor(role) {
      if (role == "Healer") return "green";
      else if (role == "Dps") return "red";
      else return "blue";
    },
    getFactionColor(faction) {
      return faction == "Alliance" ? "blue darken-4" : "red darken-4";
    },
  },
  created: function () {
    let _this = this;

    // Get my characters
    this.characters = [];
    this.loadingCharacters = true;
    axios
      .get("/api/characters")
      .then(function (response) {
        _this.characters = response.data;
      })
      .catch(function (error) {
        console.log(error);
      })
      .then(function (response) {
        _this.loadingCharacters = false;
      });
  },
};
</script>

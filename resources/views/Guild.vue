<template>
  <v-app>
    <v-container v-if="guild != null" fluid>
      <v-row>
        <v-col>
          <h1>
            {{ guild.name }}
            <v-chip :color="getFactionColor(guild.faction.name)" small dark>
              {{ guild.faction.name }}
            </v-chip>
          </h1>
          <h3>
            Serveur: <b>{{ guild.server.name }}</b>
          </h3>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-data-table
            :headers="membersHeaders"
            :items="members"
            sort-by="guild_role_id"
            class="elevation-1"
            :loading="loadingMembers ? 'loading' : 'done'"
            :loading-text="
              loadingMembers ? 'Chargement en cours...' : 'Aucune donnée'
            "
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title>
                  Membres [{{ guild.player_count }}]
                </v-toolbar-title>
              </v-toolbar>
            </template>
            <template v-slot:[`item.role`]="{ item }">
              <v-chip :color="getRoleColor(item.role.name)" small dark>
                {{ item.role.name }}
              </v-chip>
            </template>
            <template v-slot:[`item.name`]="{ item }">
              <router-link :to="'/character/' + item.id">
                {{ item.name }}
              </router-link>
            </template>
          </v-data-table>
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
  props: ["guildId"],
  data: () => ({
    guild: null,
    members: [],
    loadingMembers: true,
    membersHeaders: [
      { text: "Role", value: "role" },
      { text: "Nom", value: "name" },
      { text: "Status", value: "guild_role.name" },
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
    loadMembers() {
      let _this = this;

      // Get members
      this.members = [];
      this.loadingMembers = true;

      axios
        .get("/api/guild/" + this.guild.id + "/characters")
        .then(function (response) {
          _this.members = response.data;
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function (response) {
          _this.loadingMembers = false;
        });
    },
    deleteGuild() {
      let _this = this;

      axios
        .post("/api/guild/" + _this.guild.id + "/delete")
        .then(function (response) {
          _this.$router.push({
            name: "guilds",
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

    // Get guild
    axios
      .get("/api/guild/" + this.guildId)
      .then(function (response) {
        _this.guild = response.data;
        _this.loadMembers();
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>

<template>
  <v-app>
    <v-container v-if="guild != null" fluid>
      <v-row>
        <v-col class="col-sm-12 col-md-auto">
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
        <v-col class="col-sm-12 col-md-4 mr-auto">
          <v-select
            @change="onChangeCharacter($event)"
            v-model="selectedCharacterId"
            :items="myCharacters"
            item-text="name"
            item-value="id"
            label="Personnage"
            style="text-overflow: ellipsis"
            solo
          ></v-select>
        </v-col>
        <v-col class="col-sm-12 col-md-auto" style="text-align: right">
          <div v-if="selectedCharacterId == null">
            <v-alert type="info">Veuillez sélectionner un personnage.</v-alert>
          </div>
          <div v-else>
            <v-btn
              v-if="selectedCharacter.guild_id == guildId"
              color="red"
              class="mb-2 white--text"
              @click="quitGuild()"
            >
              <v-icon left>mdi-account-minus</v-icon>
              Quitter la guilde
            </v-btn>
            <v-btn
              v-else
              color="green"
              class="mb-2 white--text"
              :disabled="selectedCharacter.guild != null"
              @click="joinGuild()"
            >
              <v-icon left
                >mdi-account-{{
                  selectedCharacter.guild != null ? "lock" : "plus"
                }}</v-icon
              >
              {{
                selectedCharacter.guild != null
                  ? "Déjà dans une guilde"
                  : "Rejoindre la guilde"
              }}
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-alert
            v-model="actionResultAlert"
            dismissible
            :type="actionResultType"
          >
            {{ actionResultMessage }}
          </v-alert>
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
            <template v-slot:[`item.gm_user`]="{ item }">
              <router-link :to="'/user/' + item.gm_user.id">
                {{ item.gm_user.name }}
              </router-link>
            </template>
            <template v-slot:[`item.moderation`]="{ item }">
              <div
                v-if="
                  selectedCharacterId != null &&
                  selectedCharacter.guild_id == guild.id
                "
              >
                <div v-if="selectedCharacter.id == item.id">
                  <v-chip color="gray" small>Votre personnage</v-chip>
                </div>
                <div
                  v-else-if="
                    selectedCharacter.guild_role.id == 1 ||
                    selectedCharacter.guild_role.id < item.guild_role.id
                  "
                >
                  <v-btn
                    v-if="item.guild_role.id > 1"
                    color="green"
                    small
                    dark
                    @click="promoteMember(item)"
                  >
                    Élever
                  </v-btn>
                  <v-btn
                    v-if="item.guild_role.id < 3"
                    color="orange"
                    small
                    dark
                    @click="demoteMember(item)"
                  >
                    Dégrader
                  </v-btn>
                  <v-btn color="red" small dark @click="kickMember(item)">
                    Expulser
                  </v-btn>
                </div>
              </div>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
      <v-row
        v-if="
          selectedCharacterId != null &&
          selectedCharacter.guild_id == guild.id &&
          selectedCharacter.guild_role.id == 1
        "
      >
        <v-col>
          <h3>Modération</h3>
          <v-btn color="red" dark class="mb-2" @click="deleteGuild()">
            Supprimer la guilde
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
  props: ["guildId"],
  data: () => ({
    guild: null,
    members: [],
    loadingMembers: true,
    membersHeaders: [
      { text: "Role", value: "role" },
      { text: "Nom", value: "name" },
      { text: "Utilisateur", value: "gm_user" },
      { text: "Status", value: "guild_role.name" },
      { text: "Modération", value: "moderation" },
    ],
    myCharacters: [],
    selectedCharacterId: null,
    selectedCharacter: null,
    actionResultAlert: false,
    actionResultType: "success",
    actionResultMessage: "Évênement créé avec succès.",
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
    reload() {
      this.selectedCharacterId = null;
      this.selectedCharacter = null;
      this.loadMembers();
      this.loadMyCharacters();
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
    loadMyCharacters() {
      let _this = this;

      axios
        .get("/api/characters")
        .then(function (response) {
          _this.myCharacters = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    onChangeCharacter(event) {
      this.selectedCharacter = this.myCharacters.filter(
        (character) => character.id == this.selectedCharacterId
      )[0];
    },
    kickMember(kickedCharacter) {
      let _this = this;

      axios
        .post(
          "/api/guild/" +
            this.guild.id +
            "/actor/" +
            this.selectedCharacterId +
            "/target/" +
            kickedCharacter.id +
            "/kick"
        )
        .then(function (response) {
          _this.actionResultType = "success";
          _this.actionResultMessage = "Personnage expulsé avec succès.";
          _this.actionResultAlert = true;
          _this.reload();
          console.log(response.data);
        })
        .catch(function (error) {
          _this.actionResultType = "error";
          _this.actionResultMessage = "Le personnage n'a pas pu être expulsé.";
          _this.actionResultAlert = true;
          console.log(error);
        });
    },
    promoteMember(promotedCharacter) {
      let _this = this;

      axios
        .post(
          "/api/guild/" +
            this.guild.id +
            "/actor/" +
            this.selectedCharacterId +
            "/target/" +
            promotedCharacter.id +
            "/promote"
        )
        .then(function (response) {
          _this.actionResultType = "success";
          _this.actionResultMessage = "Personnage élevé avec succès.";
          _this.actionResultAlert = true;
          _this.reload();
          console.log(response.data);
        })
        .catch(function (error) {
          _this.actionResultType = "error";
          _this.actionResultMessage = "Le personnage n'a pas pu être élevé.";
          _this.actionResultAlert = true;
          console.log(error);
        });
    },
    demoteMember(demotedCharacter) {
      let _this = this;

      axios
        .post(
          "/api/guild/" +
            this.guild.id +
            "/actor/" +
            this.selectedCharacterId +
            "/target/" +
            demotedCharacter.id +
            "/demote"
        )
        .then(function (response) {
          _this.actionResultType = "success";
          _this.actionResultMessage = "Personnage dégradé avec succès.";
          _this.actionResultAlert = true;
          _this.reload();
        })
        .catch(function (error) {
          _this.actionResultType = "error";
          _this.actionResultMessage = "Le personnage n'a pas pu être dégradé.";
          _this.actionResultAlert = true;
          console.log(error);
        });
    },
    joinGuild() {
      let _this = this;

      axios
        .post(
          "/api/guild/" +
            this.guild.id +
            "/character/" +
            this.selectedCharacterId +
            "/join"
        )
        .then(function (response) {
          _this.actionResultType = "success";
          _this.actionResultMessage = "Guilde rejointe avec succès.";
          _this.actionResultAlert = true;
          _this.reload();
        })
        .catch(function (error) {
          _this.actionResultType = "error";
          _this.actionResultMessage = "La guilde n'a pas pu être rejointe.";
          _this.actionResultAlert = true;
          console.log(error);
        });
    },
    quitGuild() {
      let _this = this;

      axios
        .post(
          "/api/guild/" +
            this.guild.id +
            "/character/" +
            this.selectedCharacterId +
            "/quit"
        )
        .then(function (response) {
          _this.actionResultType = "success";
          _this.actionResultMessage = "Guilde quittée avec succès.";
          _this.actionResultAlert = true;
          _this.reload();
          console.log(response.data);
        })
        .catch(function (error) {
          _this.actionResultType = "error";
          _this.actionResultMessage = "La guilde n'a pas pu être quittée.";
          _this.actionResultAlert = true;
          console.log(error);
        });
    },
    deleteGuild() {
      let _this = this;

      axios
        .post(
          "/api/guild/" +
            _this.guild.id +
            "/actor/" +
            this.selectedCharacterId +
            "/delete"
        )
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

    // Get my characters
    this.loadMyCharacters();
  },
};
</script>

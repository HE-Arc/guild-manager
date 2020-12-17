<template>
  <v-app>
    <v-form ref="form" v-model="valid">
      <v-container fluid>
        <v-row>
          <v-col>
            <h1>{{ guildId == null ? "Créer" : "Modifier" }} une guilde</h1>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="guild.name"
              :rules="[rules.required, rules.min, rules.max]"
              :counter="64"
              label="Nom"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-select
              v-model="guild.actor_id"
              :items="actors"
              item-text="name"
              item-value="id"
              :rules="[rules.required]"
              :label="
                guildId == null
                  ? 'Créateur (personnage sans guilde)'
                  : 'Maître de guilde'
              "
              required
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              v-model="guild.faction_id"
              :items="factions"
              item-text="name"
              item-value="id"
              :rules="[rules.required]"
              label="Faction"
              required
            ></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-select
              v-model="guild.server_id"
              :items="servers"
              item-text="name"
              item-value="id"
              :rules="[rules.required]"
              label="Serveur"
              required
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-btn
              :disabled="!valid"
              color="success"
              class="mr-4"
              @click="createGuild"
            >
              {{ guildId == null ? "Créer" : "Modifier" }} la guilde
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-alert v-model="formError" dismissible type="error">
              Erreur lors de la création/modification de la guilde.
            </v-alert>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-app>
</template>

<script>
export default {
  props: ["guildId"],
  data: () => ({
    valid: false,
    rules: {
      required: (value) => !!value || "Ce champs est requis",
      min: (v) => v.length >= 4 || "Au moins 4 charactères",
      max: (v) => v.length <= 64 || "Au maximum de 64 lettres",
    },
    guild: {
      name: "",
      actor_id: null,
      faction_id: null,
      server_id: null,
    },
    actors: [],
    factions: [],
    servers: [],
    formSuccess: false,
    formError: false,
  }),
  methods: {
    createGuild() {
      let _this = this;
      this.formSuccess = false;
      this.formError = false;

      if (this.guild.id == null) {
        axios
          .post("/api/guild/create", {
            name: this.guild.name,
            creator_id: this.guild.actor_id,
            faction_id: this.guild.faction_id,
            server_id: this.guild.server_id,
          })
          .then(function (response) {
            _this.$router.push({ name: "guilds" });
          })
          .catch(function (error) {
            console.log(error);
            _this.formError = true;
          });
      } else {
        axios
          .post("/api/guild/update", {
            id: this.guild.id,
            name: this.guild.name,
            actor_id: this.guild.actor_id,
            faction_id: this.guild.faction_id,
            server_id: this.guild.server_id,
          })
          .then(function (response) {
            _this.$router.push({ name: "guilds" });
          })
          .catch(function (error) {
            console.log(error);
            _this.formError = true;
          });
      }
    },
  },
  created: function () {
    let _this = this;

    // Get my free characters / guild masters
    axios
      .get("/api/characters")
      .then(function (response) {
        _this.actors =
          _this.guildId != null
            ? response.data.filter(
                (character) =>
                  character.guild_id == _this.guildId &&
                  character.guild_role_id == 1
              )
            : response.data.filter((character) => character.guild_id == null);
      })
      .catch(function (error) {
        console.log(error);
      });

    // Get factions
    axios
      .get("/api/factions")
      .then(function (response) {
        _this.factions = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });

    // Get servers
    axios
      .get("/api/servers")
      .then(function (response) {
        _this.servers = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });

    // Get the guild
    if (this.guildId != null) {
      axios
        .get("/api/guild/" + this.guildId)
        .then(function (response) {
          _this.guild = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
};
</script>
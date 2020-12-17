<template>
  <v-app>
    <v-form ref="form" v-model="valid">
      <v-container fluid>
        <v-row>
          <v-col>
            <h1>
              {{ characterId == null ? "Créer" : "Modifier" }} un personnage
            </h1>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="character.name"
              :rules="[rules.required, rules.min, rules.max]"
              :counter="64"
              label="Nom"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-select
              v-model="character.role_id"
              :items="roles"
              item-text="name"
              item-value="id"
              :rules="[rules.required]"
              label="Role"
              required
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              v-model="character.character_class_id"
              :items="classes"
              item-text="name"
              item-value="id"
              :rules="[rules.required]"
              label="Classe"
              required
            ></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-select
              v-model="character.faction_id"
              :items="factions"
              item-text="name"
              item-value="id"
              :rules="[rules.required]"
              label="Faction"
              required
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              v-model="character.server_id"
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
              @click="createUpdateCharacter"
            >
              {{ characterId == null ? "Créer" : "Modifier" }} le personnage
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-alert v-model="formError" dismissible type="error">
              Erreur lors de la création/modification du personnage.
            </v-alert>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-app>
</template>

<script>
export default {
  props: ["characterId"],
  data: () => ({
    valid: false,
    rules: {
      required: (value) => !!value || "Ce champs est requis",
      min: (v) => v.length >= 4 || "Au moins 4 charactères",
      max: (v) => v.length <= 64 || "Au maximum de 64 lettres",
    },
    character: {
      id: null,
      name: "",
      role_id: null,
      character_class_id: null,
      faction_id: null,
      server_id: null,
    },
    roles: [],
    classes: [],
    factions: [],
    servers: [],
    formSuccess: false,
    formError: false,
  }),
  methods: {
    createUpdateCharacter() {
      let _this = this;
      this.formSuccess = false;
      this.formError = false;

      if (this.character.id == null) {
        axios
          .post("/api/character/create", {
            name: this.character.name,
            role_id: this.character.role_id,
            character_class_id: this.character.character_class_id,
            guild_id: null,
            guild_role_id: null,
            faction_id: this.character.faction_id,
            server_id: this.character.server_id,
          })
          .then(function (response) {
            _this.$router.push({ path: "/character/" + response.data });
          })
          .catch(function (error) {
            console.log(error);
            _this.formError = true;
          });
      } else {
        axios
          .post("/api/character/update", {
            id: this.character.id,
            name: this.character.name,
            role_id: this.character.role_id,
            character_class_id: this.character.character_class_id,
            faction_id: this.character.faction_id,
            server_id: this.character.server_id,
          })
          .then(function (response) {
            _this.$router.push({ path: "/character/" + response.data });
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

    // Get roles
    axios
      .get("/api/roles")
      .then(function (response) {
        _this.roles = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });

    // Get character classes
    axios
      .get("/api/classes")
      .then(function (response) {
        _this.classes = response.data;
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

    // Get the character
    if (this.characterId != null) {
      axios
        .get("/api/character/" + this.characterId)
        .then(function (response) {
          _this.character = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
};
</script>
<template>
  <v-app>
    <v-form ref="form" v-model="valid">
      <v-container fluid>
        <v-row>
          <v-col>
            <h1>Créer un personnage</h1>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="name"
              :rules="[rules.required, rules.min, rules.max]"
              :counter="64"
              label="Nom"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-select
              v-model="selectedRole"
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
              v-model="selectedClass"
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
              v-model="selectedFaction"
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
              v-model="selectedServer"
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
              @click="createCharacter"
            >
              Créer le personnage
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-alert v-model="formSuccess" dismissible type="success">
              Personnage créé avec succès.
            </v-alert>
            <v-alert v-model="formError" dismissible type="error">
              Erreur lors de la création du personnage.
            </v-alert>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    valid: false,
    rules: {
      required: (value) => !!value || "Ce champs est requis",
      min: (v) => v.length >= 4 || "Au moins 4 charactères",
      max: (v) => v.length <= 64 || "Au maximum de 64 lettres",
    },
    name: "",
    roles: [],
    selectedRole: null,
    classes: [],
    selectedClass: null,
    factions: [],
    selectedFaction: null,
    servers: [],
    selectedServer: null,
    formSuccess: false,
    formError: false,
  }),
  methods: {
    createCharacter() {
      let _this = this;
      this.formSuccess = false;
      this.formError = false;

      axios
        .post("/api/character/create", {
          name: this.name,
          role_id: this.selectedRole,
          character_class_id: this.selectedClass,
          guild_id: null,
          guild_role_id: null,
          faction_id: this.selectedFaction,
          server_id: this.selectedServer,
        })
        .then(function (response) {
          _this.$router.push({ name: "characters" });
        })
        .catch(function (error) {
          console.log(error);
          _this.formError = true;
        });
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
  },
};
</script>
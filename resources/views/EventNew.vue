<template>
  <v-app>
    <v-form ref="form" v-model="valid">
      <v-container fluid>
        <v-row>
          <v-col>
            <h1>Créer un évênement</h1>
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
              v-model="selectedLocation"
              :items="locations"
              item-text="name"
              item-value="id"
              :rules="[rules.required]"
              label="Lieu"
              required
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              v-model="selectedGuild"
              :items="guilds"
              item-text="name"
              item-value="id"
              :rules="[rules.required]"
              label="Guilde"
              required
            ></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="playerCount"
              :rules="[rules.required, freeSpotsRules.min, freeSpotsRules.max]"
              label="Nombre de places"
              type="number"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-menu
              ref="dateMenu"
              v-model="dateMenu"
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              min-width="290px"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="date"
                  :rules="[rules.required, dateRules.chronology(date, delay)]"
                  label="Date"
                  prepend-icon="mdi-calendar"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="date"
                no-title
                @input="dateMenu = false"
              ></v-date-picker>
            </v-menu>
          </v-col>
          <v-col cols="12" md="6">
            <v-menu
              v-model="delayMenu"
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              min-width="290px"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="delay"
                  :rules="[rules.required, dateRules.chronology(date, delay)]"
                  label="Délais d'inscription"
                  prepend-icon="mdi-calendar"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="delay"
                no-title
                @input="delayMenu = false"
              ></v-date-picker>
            </v-menu>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="password"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.max]"
              :type="showPassword ? 'text' : 'password'"
              name="input-10-1"
              label="Mot de passe (facultatif)"
              counter
              @click:append="showPassword = !showPassword"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-switch
              v-model="autoBench"
              :label="`Bench automatique: ${
                autoBench ? `activé` : `désactivé`
              }`"
            ></v-switch>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-btn
              :disabled="!valid"
              color="success"
              class="mr-4"
              @click="createEvent"
            >
              Créer l'évênement
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-alert v-model="formSuccess" dismissible type="success">
              Évênement créé avec succès.
            </v-alert>
            <v-alert v-model="formError" dismissible type="error">
              Erreur lors de la création de l'évênement.
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
    freeSpotsRules: {
      max: (v) => v <= 100 || "Il ne peut y avoir plus de 100 places",
      min: (v) => v >= 5 || "Il ne peut y avoir moins de 5 places",
    },
    dateRules: {
      chronology: (dateAfter, dateBefore) =>
        dateAfter >= dateBefore ||
        "Le délais d'inscription ne peux être après l'évênement",
    },
    name: "",
    playerCount: 40,
    locations: [],
    selectedLocation: null,
    guilds: [],
    selectedGuild: null,
    password: "",
    autoBench: false,
    date: new Date().toISOString().substr(0, 10),
    dateMenu: false,
    delay: new Date().toISOString().substr(0, 10),
    delayMenu: false,
    showPassword: false,
    formSuccess: false,
    formError: false,
  }),
  methods: {
    createEvent() {
      let _this = this;
      this.formSuccess = false;
      this.formError = false;

      axios
        .post("/api/event/create", {
          name: this.name,
          date: this.date,
          subscription_delay: this.delay,
          player_count: this.playerCount,
          auto_bench: this.autoBench,
          status: "preparing",
          password: this.password,
          user_id: this.$store.state.token,
          guild_id: this.selectedGuild,
          location_id: this.selectedLocation,
        })
        .then(function (response) {
          _this.formSuccess = true;
          _this.$refs.form.reset();
        })
        .catch(function (error) {
          console.log(error);
          _this.formError = true;
        });
    },
  },
  created: function () {
    let _this = this;

    // Get locations
    axios
      .get("/api/locations")
      .then(function (response) {
        _this.locations = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });

    // Get user's guilds
    axios
      .get("/api/guilds")
      .then(function (response) {
        _this.guilds = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>
<template>
  <v-app>
    <v-form ref="form" v-model="valid">
      <v-container fluid>
        <v-row>
          <v-col>
            <h1>{{ eventId == null ? "Créer" : "Modifier" }} un évênement</h1>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="event.name"
              :rules="[rules.required, rules.min, rules.max]"
              :counter="64"
              label="Nom"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="6">
            <v-select
              v-model="event.location_id"
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
              v-model="event.guild_id"
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
              v-model="event.player_count"
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
                  v-model="event.date"
                  :rules="[
                    rules.required,
                    dateRules.chronology(event.date, event.subscription_delay),
                  ]"
                  label="Date"
                  prepend-icon="mdi-calendar"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="event.date"
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
                  v-model="event.subscription_delay"
                  :rules="[
                    rules.required,
                    dateRules.chronology(event.date, event.subscription_delay),
                  ]"
                  label="Délais d'inscription"
                  prepend-icon="mdi-calendar"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="event.subscription_delay"
                no-title
                @input="delayMenu = false"
              ></v-date-picker>
            </v-menu>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="event.password"
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
              v-model="event.auto_bench"
              :label="`Bench automatique: ${
                event.auto_bench ? `activé` : `désactivé`
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
              @click="createUpdateEvent"
            >
              {{ eventId == null ? "Créer" : "Modifier" }} l'évênement
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-alert v-model="formError" dismissible type="error">
              Erreur lors de la création/modification de l'évênement.
            </v-alert>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-app>
</template>

<script>
export default {
  props: ["eventId"],
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
    event: {
      id: null,
      name: "",
      date: new Date().toISOString().substr(0, 10),
      subscription_delay: new Date().toISOString().substr(0, 10),
      player_count: 40,
      auto_bench: false,
      password: "",
      guild_id: null,
      location_id: null,
    },
    guilds: [],
    locations: [],
    showPassword: false,
    dateMenu: false,
    delayMenu: false,
    formSuccess: false,
    formError: false,
  }),
  methods: {
    createUpdateEvent() {
      let _this = this;
      this.formSuccess = false;
      this.formError = false;

      if (this.event.id == null) {
        axios
          .post("/api/event/create", {
            name: this.event.name,
            date: this.event.date,
            subscription_delay: this.event.subscription_delay,
            player_count: this.event.player_count,
            auto_bench: this.event.auto_bench,
            password: this.event.password,
            guild_id: this.event.guild_id,
            location_id: this.event.location_id,
          })
          .then(function (response) {
            _this.$router.push({ name: "events" });
          })
          .catch(function (error) {
            console.log(error);
            _this.formError = true;
          });
      } else {
        axios
          .post("/api/event/update", {
            id: this.event.id,
            name: this.event.name,
            date: this.event.date,
            subscription_delay: this.event.subscription_delay,
            player_count: this.event.player_count,
            auto_bench: this.event.auto_bench,
            finished: this.event.finished,
            boss_id: this.event.boss_id,
            guild_id: this.event.guild_id,
            location_id: this.event.location_id,
          })
          .then(function (response) {
            _this.$router.push({ name: "events" });
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

    // Get the event
    if (this.eventId != null) {
      axios
        .get("/api/event/" + this.eventId)
        .then(function (response) {
          _this.event = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
};
</script>
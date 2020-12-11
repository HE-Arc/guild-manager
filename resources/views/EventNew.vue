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
              :items="locations"
              :rules="[rules.required]"
              label="Lieu"
              required
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              :items="guilds"
              :rules="[rules.required]"
              label="Guilde"
              required
            ></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field
              v-model="slider"
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
                  :rules="[rules.required, dateRules]"
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
                  :rules="[rules.required, delayRules]"
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
              :rules="[rules.required, rules.min, rules.max]"
              :type="showPassword ? 'text' : 'password'"
              name="input-10-1"
              label="Mot de passe"
              hint="Au moins 8 charactères"
              counter
              @click:append="showPassword = !showPassword"
            ></v-text-field>
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
      min: (v) => v.length >= 8 || "Au moins 8 charactères",
      max: (v) => v.length <= 64 || "Au maximum de 64 lettres",
    },
    freeSpotsRules: {
      max: (v) => v <= 100 || "Il ne peut y avoir plus de 100 places",
      min: (v) => v >= 5 || "Il ne peut y avoir moins de 5 places",
    },
    name: "",
    locations: ["Foo", "Bar", "Fizz", "Buzz"],
    guilds: ["Foor", "Bard"],
    password: "",
    date: new Date().toISOString().substr(0, 10),
    dateMenu: false,
    delay: new Date().toISOString().substr(0, 10),
    delayMenu: false,
    showPassword: false,
  }),
  computed: {
    dateRules() {
      const rules = [];

      let _this = this;

      if (this.delay) {
        const rule = (v) =>
          _this.delay > _this.date ||
          `Le délais d'inscription ne peux être après la date`;
        rules.push(rule);
      }

      return rules;
    },
    delayRules() {
      const rules = [];

      let _this = this;

      if (this.date) {
        const rule = (v) =>
          _this.delay > _this.date ||
          `Le délais d'inscription ne peux être après la date`;
        rules.push(rule);
      }

      return rules;
    },
  },
  methods: {
    createEvent() {
      if (this.delay > this.date)
        alert("Le délais d'inscription ne peux être après la date.");
      else alert("WIP");
    },
  },
  created: function () {},
};
</script>
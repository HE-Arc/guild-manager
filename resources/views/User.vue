<template>
  <v-app>
    <v-container v-if="user != null" fluid>
      <v-row>
        <v-col>
          <h1>{{ user.name }}</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-data-table
            :headers="userHeaders"
            :items="[user]"
            class="elevation-1"
          >
          </v-data-table>
        </v-col>
      </v-row>
      <v-row v-if="this.$store.state.token == user.id">
        <v-col>
          <h3>Modération</h3>
          <v-btn color="red" dark class="mb-2" @click="deleteUser()">
            Supprimer le compte
          </v-btn>
          <v-btn
            color="primary"
            class="mb-2 white--text"
            disabled
            @click="$router.push('/user/' + user.id + '/update')"
          >
            Modifier le compte
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
  props: ["userId"],
  watch: {
    userId: function (newVal, oldVal) {
      this.onCreated();
    },
  },
  data: () => ({
    user: null,
    userHeaders: [
      { text: "Nom", value: "name" },
      { text: "Email", value: "email" },
    ],
  }),
  methods: {
    deleteUser() {
      let _this = this;

      axios
        .post("/api/user/delete")
        .then(function (response) {
          _this.$store
            .dispatch("logout")
            .then(() => _this.$router.push("/"))
            .catch((err) => console.log(err));
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    onCreated() {
      let _this = this;

      // Get user
      axios
        .get("/api/user/" + this.userId)
        .then(function (response) {
          _this.user = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created: function () {
    this.onCreated();
  },
};
</script>

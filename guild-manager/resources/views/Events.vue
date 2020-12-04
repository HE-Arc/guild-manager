<template>
  <v-app>
    <v-container fluid>
      <v-row>
        <v-col class="col-sm-12 col-md-auto">
          <h1>Mes évênements</h1>
        </v-col>
        <v-col class="col-sm-12 col-md-4 mr-auto">
          <v-select
            :items="characters"
            label="Personnage"
            style="text-overflow: ellipsis"
          ></v-select>
        </v-col>
        <v-col class="col-sm-12 col-md-auto" style="text-align: right">
          <v-btn color="primary" dark class="mb-2">
            <v-icon left>mdi-plus</v-icon>
            Nouvel évênement
          </v-btn>
        </v-col>
      </v-row>

      <v-data-table
        :headers="headers"
        :items="events"
        sort-by="date"
        class="elevation-1"
      >
        <template v-slot:[`item.actions`]="{ item }">
          <v-btn small @click="clickItem(item)">Subscribe</v-btn>
          <v-btn small @click="clickItem(item)">Skip</v-btn>
        </template>
      </v-data-table>
    </v-container>
  </v-app>
</template>

<script>
import Home from "./Home.vue";
export default {
  components: { Home },
  data() {
    return {
      headers: [
        { text: "Nom", value: "name" },
        { text: "Lieu", value: "location" },
        { text: "Date", value: "date" },
        { text: "Délais", value: "delay" },
        { text: "Inscrits", value: "subscribed" },
        { text: "Total", value: "total" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      events: [
        {
          name: "Raid 1",
          location: "Repère de Nyxi",
          date: "01.02.2003",
          delay: "01.01.2003",
          subscribed: 38,
          total: 41,
        },
        {
          name: "Raid 2",
          location: "Repère de Plat",
          date: "04.02.2003",
          delay: "02.01.2003",
          subscribed: 18,
          total: 35,
        },
      ],
      characters: [
        "jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal jfdksjalfdjsfal",
        "fkdjsalkfjdsajflkdsjfa",
      ],
    };
  },
  methods: {
    clickItem(item) {
      console.log(item);
    },
  },
};
</script>
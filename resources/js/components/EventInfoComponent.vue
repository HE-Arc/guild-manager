<template>
  <v-container class="grey lighten-5" fluid>
    <v-row>
      <v-col cols="4">
        Raid
      </v-col>
      <v-col cols="8">
        <v-row no-gutters>
          <v-col>
            <v-card
              class="pa-2"
              outlined
              tile
            >
              One
            </v-card>
          </v-col>
          <v-col>
            <v-card
              class="pa-2"
              outlined
              tile
            >
              Three
            </v-card>
          </v-col>
        </v-row>
        <v-row no-gutters>
          <v-col>
            <v-card
              class="pa-2"
              outlined
              tile
            >
              Two
            </v-card>
          </v-col>
          <v-col>
            <v-card
              class="pa-2"
              outlined
              tile
            >
              Four
            </v-card>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
    var infos = ['One', 'Three', 'Two', 'Four']
</script>
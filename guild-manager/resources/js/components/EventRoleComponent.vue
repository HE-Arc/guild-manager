<template>
  <v-simple-table dense>
    <template v-slot:default>
    {{ title }}
      <tbody>
        <tr
          v-for="item in characters"
          :key="item.name"
        >
          <td>{{ item.name }}</td>
          <td>{{ item.calories }}</td>
          <td v-if="makeButton">
              <v-btn id="bench-button" class="ma-2" tile outlined color="black" dark>{{ buttonLabel }}</v-btn>
          </td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
</template>

<script>
  export default {
    props: ['title', 'makeButton', 'buttonLabel'],
    data () {
      return {
        characters: [
          {
            name: 'FrozenBoi',
            calories: 'Warrior',
          },
          {
            name: 'Giaccomo',
            calories: 'Druid',
          },
          {
            name: 'Thunderfurry',
            calories: 'Warrior',
          }
        ]
      }
    },
  }
</script>
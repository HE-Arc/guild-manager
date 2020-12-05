<template>
 <v-card outlined style="margin: 5px 0px 5px">
  <v-card-title>{{title}}</v-card-title>
  <v-simple-table dense height="200px">
      <tbody>
        <tr
          v-for="item in characters"
          :key="item.name"          
        >
          <td colspan = "2">{{ item.name }}</td>
          <td colspan = "1">{{ item.calories }}</td>
          <td colspan = "1">
              <v-btn v-show="makeButton === 'true'" id="bench-button" class="ma-2" small tile outlined color="black" dark style="font-size: 0.56em">{{ buttonLabel }}</v-btn>
          </td>
        </tr>
      </tbody>
  </v-simple-table>
 </v-card>
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
                },
                                {
                name: 'Zugzug',
                calories: 'Warrior',
                },
                {
                name: 'Giaccometty',
                calories: 'Druid',
                },
            ],
        }
    },
}
</script>
<template>
  <v-container class="grey lighten-5" fluid>
    <v-col cols="12">
        <v-row>
            <v-btn @click="postServers" id="start-event-button" class="ma-2" large tile outlined color="black" dark>Start Event</v-btn>        
        </v-row>
        <v-row>
            <v-btn id="edit-event-button" class="ma-2" large tile outlined color="black" dark>Edit Event</v-btn>
        </v-row>
        <v-row>
            <v-btn id="delete-event-button" class="ma-2" large tile outlined color="black" dark>Delete Event</v-btn>
        </v-row>
    </v-col>
  </v-container>
</template>

<script>
    export default {        
            data () {
                return {  
                    postServers: function postServers() {
                        var _this = this;
                        axios.post('/postServers', {'id':'2'}).then(function(response){
                            _this.servers = response.data;
                            console.log(response.data);
                        }).catch(error=>{
                            console.log("postServers: "+error);
                        });
                    },         
                }
            },
        }
</script>
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`event` */
        $eventData = array(
            array('name' => 'Raid De Pacques', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '1', 'guild_id' => '1', 'location_id' => '1'),
            array('name' => 'Raid De Noel', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '1', 'guild_id' => '1', 'location_id' => '2'),
            array('name' => 'Raid De l Avant', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '2', 'guild_id' => '2', 'location_id' => '3'),
            array('name' => 'Raid Du Mardi Gras', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '2', 'guild_id' => '2', 'location_id' => '2'),
            array('name' => 'Raid De Carnaval', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '3', 'guild_id' => '1', 'location_id' => '3'),
            array('name' => 'Raid Du Solstice dhiver', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '3', 'guild_id' => '1', 'location_id' => '1'),
            array('name' => 'Raid Du Solstice dete', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '4', 'guild_id' => '2', 'location_id' => '1'),
            array('name' => 'Raid De La St Patrick', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '4', 'guild_id' => '1', 'location_id' => '2'),
            array('name' => 'Premier Raid de guilde', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '5', 'guild_id' => '2', 'location_id' => '2'),
            array('name' => 'Raid des 50 ans de paul', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '6', 'guild_id' => '3', 'location_id' => '1'),
            array('name' => 'Raid des 20 ans de paul', 'player_count' => '40', 'auto_bench' => '0', 'finished' => '0', 'gm_user_id' => '6', 'guild_id' => '3', 'location_id' => '3'),
        );

        foreach ($eventData as $event) {
            DB::table('events')->insert([
                'name' => $event['name'],
                'date' => now(),
                'subscription_delay' => now(),
                'player_count' => $event['player_count'],
                'auto_bench' => $event['auto_bench'],
                'finished' => $event['finished'],
                'password' => null,
                'boss_id' => null,
                'gm_user_id' => $event['gm_user_id'],
                'guild_id' => $event['guild_id'],
                'location_id' => $event['location_id'],
            ]);
        }
    }
}

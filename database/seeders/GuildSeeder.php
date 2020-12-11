<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`guild` */
        $guildData = array(
            array('name' => 'Harde', 'faction_id' => '1', 'server_id' => '2', 'password' => NULL),
            array('name' => 'Reapers', 'faction_id' => '2', 'server_id' => '1', 'password' => NULL)
        );

        DB::table('guilds')->delete();

        foreach ($guildData as $guild) {
            DB::table('guilds')->insert([
                'name' => $guild['name'],
                'faction_id' => $guild['faction_id'],
                'server_id' => $guild['server_id'],
                'password' => $guild['password']
            ]);
        }
    }
}

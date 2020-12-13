<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`character` */
        $characterData = array(
            array('name' => 'ZugZug', 'gm_user_id' => '1', 'guild_id' => '1', 'guild_role_id' => '1', 'role_id' => '3', 'class_id' => '1', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'Archange', 'gm_user_id' => '1', 'guild_id' => '2', 'guild_role_id' => '1', 'role_id' => '2', 'class_id' => '3', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Bulzator', 'gm_user_id' => '2', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '1', 'class_id' => '1', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'Aukaelem', 'gm_user_id' => '1', 'guild_id' => '2', 'guild_role_id' => '1', 'role_id' => '3', 'class_id' => '5', 'faction_id' => '2', 'server_id' => '2'),
            array('name' => 'Withme', 'gm_user_id' => '1', 'guild_id' => '2', 'guild_role_id' => '1', 'role_id' => '2', 'class_id' => '8', 'faction_id' => '2', 'server_id' => '2'),
            array('name' => 'Ippi', 'gm_user_id' => '2', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '1', 'class_id' => '1', 'faction_id' => '1', 'server_id' => '2')
        );

        foreach ($characterData as $character) {
            DB::table('characters')->insert([
                'name' => $character['name'],
                'gm_user_id' => $character['gm_user_id'],
                'guild_id' => $character['guild_id'],
                'guild_role_id' => $character['guild_role_id'],
                'role_id' => $character['role_id'],
                'character_class_id' => $character['class_id'],
                'faction_id' => $character['faction_id'],
                'server_id' => $character['server_id'],
            ]);
        }
    }
}

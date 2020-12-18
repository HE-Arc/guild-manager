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
            array('name' => 'Archange', 'gm_user_id' => '1', 'guild_id' => '2', 'guild_role_id' => '3', 'role_id' => '2', 'class_id' => '3', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Bulzator', 'gm_user_id' => '2', 'guild_id' => '1', 'guild_role_id' => '2', 'role_id' => '1', 'class_id' => '1', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'Aukaelem', 'gm_user_id' => '2', 'guild_id' => '2', 'guild_role_id' => '1', 'role_id' => '3', 'class_id' => '5', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Withme', 'gm_user_id' => '3', 'guild_id' => '2', 'guild_role_id' => '1', 'role_id' => '3', 'class_id' => '8', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Triceramix', 'gm_user_id' => '3', 'guild_id' => '1', 'guild_role_id' => '2', 'role_id' => '1', 'class_id' => '1', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'Berzebutor', 'gm_user_id' => '4', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '2', 'class_id' => '9', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'HenrySalvador', 'gm_user_id' => '4', 'guild_id' => '2', 'guild_role_id' => '1', 'role_id' => '3', 'class_id' => '2', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Persecutor', 'gm_user_id' => '5', 'guild_id' => '2', 'guild_role_id' => '3', 'role_id' => '3', 'class_id' => '4', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Trollator', 'gm_user_id' => '5', 'guild_id' => '2', 'guild_role_id' => '3', 'role_id' => '2', 'class_id' => '5', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Juxtarion', 'gm_user_id' => '6', 'guild_id' => '3', 'guild_role_id' => '1', 'role_id' => '3', 'class_id' => '7', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Bromation', 'gm_user_id' => '6', 'guild_id' => '3', 'guild_role_id' => '3', 'role_id' => '3', 'class_id' => '2', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Zertafit', 'gm_user_id' => '7', 'guild_id' => '3', 'guild_role_id' => '2', 'role_id' => '2', 'class_id' => '3', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Hulnatid', 'gm_user_id' => '7', 'guild_id' => '3', 'guild_role_id' => '3', 'role_id' => '1', 'class_id' => '9', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Proferator', 'gm_user_id' => '8', 'guild_id' => '2', 'guild_role_id' => '2', 'role_id' => '3', 'class_id' => '8', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Mimi', 'gm_user_id' => '8', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '3', 'class_id' => '3', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'MaBiche', 'gm_user_id' => '9', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '3', 'class_id' => '4', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'CocoChannou', 'gm_user_id' => '9', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '2', 'class_id' => '6', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'Gromix', 'gm_user_id' => '10', 'guild_id' => '2', 'guild_role_id' => '3', 'role_id' => '1', 'class_id' => '1', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Trucidator', 'gm_user_id' => '10', 'guild_id' => '2', 'guild_role_id' => '3', 'role_id' => '3', 'class_id' => '2', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'VoieDeWael', 'gm_user_id' => '11', 'guild_id' => '2', 'guild_role_id' => '2', 'role_id' => '2', 'class_id' => '3', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Miaoux', 'gm_user_id' => '11', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '1', 'class_id' => '1', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'BelDortar', 'gm_user_id' => '12', 'guild_id' => '2', 'guild_role_id' => '3', 'role_id' => '2', 'class_id' => '9', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Diratel', 'gm_user_id' => '12', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '3', 'class_id' => '6', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'Arturionix', 'gm_user_id' => '13', 'guild_id' => '3', 'guild_role_id' => '3', 'role_id' => '2', 'class_id' => '5', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'Souleurix', 'gm_user_id' => '13', 'guild_id' => '3', 'guild_role_id' => '3', 'role_id' => '3', 'class_id' => '4', 'faction_id' => '2', 'server_id' => '1'),
            array('name' => 'MarcheOmbrero', 'gm_user_id' => '14', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '2', 'class_id' => '3', 'faction_id' => '1', 'server_id' => '2'),
            array('name' => 'ElChepe', 'gm_user_id' => '14', 'guild_id' => '1', 'guild_role_id' => '3', 'role_id' => '3', 'class_id' => '3', 'faction_id' => '1', 'server_id' => '2'),
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

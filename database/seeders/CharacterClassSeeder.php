<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`class` */
        $characterClassData = array(
            array('name' => 'Guerrier'),
            array('name' => 'Mage'),
            array('name' => 'Prêtre'),
            array('name' => 'Voleur'),
            array('name' => 'Paladin'),
            array('name' => 'Chaman'),
            array('name' => 'Chasseur'),
            array('name' => 'Démoniste'),
            array('name' => 'Druide')
        );

        foreach ($characterClassData as $characterClass) {
            DB::table('character_classes')->insert([
                'name' => $characterClass['name']
            ]);
        }
    }
}

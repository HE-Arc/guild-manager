<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`faction` */
        $factionData = array(
            array('name' => 'Horde'),
            array('name' => 'Alliance')
        );

        DB::table('factions')->delete();

        foreach ($factionData as $faction) {
            DB::table('factions')->insert([
                'name' => $faction['name']
            ]);
        }
    }
}

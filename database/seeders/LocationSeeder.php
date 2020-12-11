<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`location` */
        $locationData = array(
            array('name' => 'Coeur du magma'),
            array('name' => 'Repaire d\'Onyxia'),
            array('name' => 'Naxxramas')
        );

        foreach ($locationData as $location) {
            DB::table('locations')->insert([
                'name' => $location['name']
            ]);
        }
    }
}

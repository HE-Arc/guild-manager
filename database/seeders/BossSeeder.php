<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BossSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`boss` */
        $bossData = array(
            array('name' => 'Lucifron', 'location_id' => '1'),
            array('name' => 'Magmadar', 'location_id' => '1'),
            array('name' => 'Gehennas', 'location_id' => '1'),
            array('name' => 'Garr', 'location_id' => '1'),
            array('name' => 'Shazzrah', 'location_id' => '1'),
            array('name' => 'Baron Geddon', 'location_id' => '1'),
            array('name' => 'Golemagg l\'Incinérateur', 'location_id' => '1'),
            array('name' => 'Messager de Sulfuron', 'location_id' => '1'),
            array('name' => 'Majordomo Executus', 'location_id' => '1'),
            array('name' => 'Ragnaros', 'location_id' => '1'),
            array('name' => 'Onyxia', 'location_id' => '2'),
            array('name' => 'Anub\'Rekhan', 'location_id' => '3'),
            array('name' => 'Grande veuve Faerlina', 'location_id' => '3'),
            array('name' => 'Maexxna', 'location_id' => '3')
        );

        foreach ($bossData as $boss) {
            DB::table('bosses')->insert([
                'name' => $boss['name'],
                'location_id' => $boss['location_id']
            ]);
        }
    }
}

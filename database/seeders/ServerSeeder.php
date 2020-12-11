<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`server` */
        $serverData = array(
            array('name' => 'Amnennar'),
            array('name' => 'Sulfuron')
        );

        DB::table('servers')->delete();
        
        foreach ($serverData as $server) {
            DB::table('servers')->insert([
                'name' => $server['name']
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`role` */
        $roleData = array(
            array('name' => 'Tank'),
            array('name' => 'Healer'),
            array('name' => 'Dps')
        );
        
        foreach ($roleData as $role) {
            DB::table('roles')->insert([
                'name' => $role['name']
            ]);
        }
    }
}

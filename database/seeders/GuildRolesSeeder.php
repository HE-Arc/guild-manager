<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuildRolesSeeder extends Seeder
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
            array('name' => 'Master'),
            array('name' => 'Admin'),
            array('name' => 'Member')
        );
        
        foreach ($roleData as $role) {
            DB::table('guild_roles')->insert([
                'name' => $role['name']
            ]);
        }
    }
}

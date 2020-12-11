<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GmUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `guild_manager`.`gm_user` */
        $gmUserData = array(
            array('name' => 'Jean', 'password' => '1234'),
            array('name' => 'Jacques', 'password' => '4321')
        );

        foreach ($gmUserData as $gmUser) {
            DB::table('gm_user')->insert([
                'name' => $gmUser['name'],
                'password' => $gmUser['password']
            ]);
        }
    }
}

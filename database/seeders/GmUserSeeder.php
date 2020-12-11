<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            array('name' => 'Jean', 'email' => 'jean@hotmail.com', 'password' => '1234'),
            array('name' => 'Jacques', 'email' => 'jacques@hotmail.com', 'password' => '4321')
        );

        DB::table('users')->delete();

        foreach ($gmUserData as $gmUser) {
            DB::table('users')->insert([
                'name' => $gmUser['name'],
                'password' => $gmUser['password'],
                'email' => $gmUser['email'],
                'email_verified_at' => now(),
                // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'password' => $gmUser['password'], // password
                'remember_token' => Str::random(10),
            ]);
        }
    }
}

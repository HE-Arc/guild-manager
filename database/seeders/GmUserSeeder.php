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
            array('name' => 'Henry', 'email' => 'henry@hotmail.com', 'password' => '1234'),
            array('name' => 'Jenifer', 'email' => 'jenifer@hotmail.com', 'password' => '1234'),
            array('name' => 'Ravioli', 'email' => 'ravioli@hotmail.com', 'password' => '1234'),
            array('name' => 'Niguan', 'email' => 'niguan@hotmail.com', 'password' => '1234'),
            array('name' => 'Arthur', 'email' => 'arthur@hotmail.com', 'password' => '1234'),
            array('name' => 'Josef', 'email' => 'josef@hotmail.com', 'password' => '1234'),
            array('name' => 'Vladimir', 'email' => 'vladimir@hotmail.com', 'password' => '1234'),
            array('name' => 'Pitievic', 'email' => 'pitievic@hotmail.com', 'password' => '1234'),
            array('name' => 'Preskovic', 'email' => 'preskovic@hotmail.com', 'password' => '1234'),
            array('name' => 'Ulfric', 'email' => 'ulfric@hotmail.com', 'password' => '1234'),
            array('name' => 'Ibrahim', 'email' => 'ibrahim@hotmail.com', 'password' => '1234'),
            array('name' => 'Joris', 'email' => 'joris@hotmail.com', 'password' => '1234'),
            array('name' => 'Tendebert', 'email' => 'tendebert@hotmail.com', 'password' => '1234'),
            array('name' => 'Enoris', 'email' => 'enoris@hotmail.com', 'password' => '1234'),
        );

        foreach ($gmUserData as $gmUser) {
            DB::table('gm_users')->insert([
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

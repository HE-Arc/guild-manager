<?php

namespace Database\Seeders;

use App\Models\Boss;
use App\Models\CharacterClass;
use App\Models\GmUser;
use App\Models\Server;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Guid\Guid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CharacterClassSeeder::class,
            FactionSeeder::class,
            RoleSeeder::class,
            ServerSeeder::class,
            GmUserSeeder::class,
            GuildSeeder::class,
            LocationSeeder::class,
            CharacterSeeder::class,
            BossSeeder::class,            
            ItemSeeder::class,           
        ]);
    }
}

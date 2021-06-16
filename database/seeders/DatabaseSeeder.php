<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call all other seeders
        $this->call(UsersSeeder::class);
        $this->call(TeamsSeeder::class);
        $this->call(RidersSeeder::class);
        $this->call(RacesSeeder::class);
        $this->call(StagesSeeder::class);
    }
}

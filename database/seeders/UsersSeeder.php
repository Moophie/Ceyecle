<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Make 3 test users for the devs
        $michael = new User();
        $michael->username = "Michael";
        $michael->email = "michael@test.com";
        $michael->password = Hash::make("test");
        $michael->save();

        $hannah = new User();
        $hannah->username = "Hannah";
        $hannah->email = "hannah@test.com";
        $hannah->password = Hash::make("test");
        $hannah->save();

        $lize = new User();
        $lize->username = "Lize";
        $lize->email = "lize@test.com";
        $lize->password = Hash::make("test");
        $lize->save();
    }
}

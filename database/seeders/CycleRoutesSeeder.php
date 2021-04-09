<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CycleRoute;

class CycleRoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Some test data
        $route = new CycleRoute();
        $route->event_id = 1;
        $route->name = "Brest-Landerneau";
        $route->profile_img = '';
        $route->distance = '187';
        $route->type = 'Hilly';
        $route->time = "2021-06-26 00:00:00";
        $route->save();

        $route = new CycleRoute();
        $route->event_id = 1;
        $route->name = "Lorient-Pontivy";
        $route->profile_img = '';
        $route->distance = '182';
        $route->type = 'Flat';
        $route->time = "2021-06-28 00:00:00";
        $route->save();

        $route = new CycleRoute();
        $route->event_id = 1;
        $route->name = "Cluses-Tignes";
        $route->profile_img = '';
        $route->distance = '145';
        $route->type = 'Mountain';
        $route->time = "2021-07-04 00:00:00";
        $route->save();
    }
}

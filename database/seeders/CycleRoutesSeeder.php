<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CycleRoute;
use App\Classes\SportsradarAPI;
use Illuminate\Support\Facades\Log;

class CycleRoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*// Some test data
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
        $route->save(); */

        $seasonEvents = SportsradarAPI::getSeasonEvents();
        sleep(1);

        foreach ($seasonEvents as $championship) {
            //foreach ($championship['stages'] as $event) {
            $stage = $championship['stages'][2];
            foreach ($stage['stages'] as $stage) {
                Log::info(print_r($stage['id'], true));
                $event_info = SportsradarAPI::getEventInfo($stage['id']);
                Log::info(print_r($event_info, true));
                $event_info = $event_info['stage'];

                $s = new CycleRoute();
                $s->event_id = $event_info['parents'][0]['id'];
                $s->name = $event_info['departure_city'] . ' - ' . $event_info['arrival_city'];
                $s->profile_img = '';
                if (!empty($event_info['distance'])) {
                    $s->distance = $event_info['distance'];
                } else {
                    $s->distance = 0;
                }

                if (!empty($event_info['classification'])) {
                    $s->type = $event_info['classification'];
                } else {
                    $s->type = 'Unknown';
                }
                
                $s->time = $event_info['scheduled'];
                $s->save();
                sleep(1);
            }
            //}
        }
    }
}

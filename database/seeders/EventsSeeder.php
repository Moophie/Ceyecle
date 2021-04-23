<?php

namespace Database\Seeders;

use App\Classes\SportsradarAPI;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasonEvents = SportsradarAPI::getSeasonEvents();

        foreach ($seasonEvents as $championship) {
            foreach ($championship['stages'] as $event) {
                $e = new Event();
                $e->name = $event['description'];
                $e->event_code = $event['id'];
                $e->description = "";
                $e->date = $event['scheduled'];
                $e->thumbnail = "";
                $e->save();
            }
        }
    }
}

<?php

namespace Database\Seeders;

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
        // Some test data
        $event = new Event();
        $event->name = "Tour de France";
        $event->description = "The Tour de France is an annual men's multiple stage bicycle race primarily held in France, while also occasionally passing through nearby countries.";
        $event->date = "2021-06-26";
        $event->thumbnail = "";
        $event->save();

        $event = new Event();
        $event->name = "Ronde van Vlaanderen";
        $event->description = 'The Tour of Flanders, also known as De Ronde ("The Tour"), is an annual road cycling race held in Belgium every spring.';
        $event->date = "2021-04-04";
        $event->thumbnail = "";
        $event->save();
    }
}

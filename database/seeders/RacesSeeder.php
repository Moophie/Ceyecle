<?php

namespace Database\Seeders;

use App\Classes\ProCyclingStats;
use App\Models\Race;
use Illuminate\Database\Seeder;

class RacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $races = ProCyclingStats::getAllRaces();
        foreach ($races as $race) {
            $r = new Race();
            $r->name = $race['name'];
            $r->class = $race['class'];
            $r->pcs_url = $race['pcs_url'];
            $race_info = ProCyclingStats::getRaceInfo($r->class, $r->pcs_url);
            $r->startdate = $race_info['startdate'];
            $r->enddate = $race_info['enddate'];
            $r->save();
            sleep(5);
        }
    }
}

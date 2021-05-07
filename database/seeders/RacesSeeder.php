<?php

namespace Database\Seeders;

use App\Classes\ProCyclingStats;
use App\Models\Race;
use App\Models\Team;
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

            foreach ($race_info['competing_teams'] as $competing_team) {
                $team = Team::where('pcs_url', $competing_team['pcs_url'])->first();
                if($team){
                    $r->teams()->attach($team->id);
                }
            }

            sleep(5);
        }
    }
}

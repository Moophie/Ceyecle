<?php

namespace Database\Seeders;

use App\Classes\ProCyclingStats;
use App\Models\Race;
use App\Models\Rider;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            $r->logo = $race_info['logo'];
            $r->event_map_picture = $race_info['event_map_picture'];
            $r->save();

            foreach ($race_info['competing_teams'] as $competing_team) {
                $team = Team::where('pcs_url', $competing_team['pcs_url'])->first();
                if ($team) {
                    $r->teams()->attach($team->id);
                }
            }

            foreach ($race_info['previous_winners'] as $previous_winner) {
                $previous_winner['fullname'] = explode(' ', $previous_winner['fullname'], 2);
                $previous_winner['firstname'] = $previous_winner['fullname'][1];
                $previous_winner['lastname'] = $previous_winner['fullname'][0];
                
                $rider = Rider::where('firstname', '=', $previous_winner['firstname'])->where('lastname', '=', $previous_winner['lastname'])->first();
                if ($rider) {
                    $r->previousWinners()->attach($rider->id, ['year' => $previous_winner['year']]);
                }
            }

            sleep(2);
        }
    }
}

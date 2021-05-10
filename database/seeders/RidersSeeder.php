<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Classes\ProCyclingStats;
use App\Models\Rider;
use App\Models\Team;

class RidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::all();
        foreach ($teams as $team) {
            $riders = ProCyclingStats::getRidersFromTeam($team->pcs_url);
            foreach ($riders as $rider) {
                $r = new Rider();
                $r->firstname = $rider['firstname'];
                $r->lastname = $rider['lastname'];
                $r->pcs_url = $rider['pcs_url'];
                $r->team_id = $team->id; 
               
                $rider = ProCyclingstats::getRiderInfo($r->pcs_url);
                $r->dob = $rider['dob'];
                $r->age = $rider['age'];
                $r->nationality = $rider['nationality'];
                $r->picture = $rider['picture'];
                $r->height = $rider['height'];
                $r->weight = $rider['weight'];
                $r->uci_wr = $rider['uci_wr'];
                $r->save();
                sleep(5);
            }
        }
    }
}

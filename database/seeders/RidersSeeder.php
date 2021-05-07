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
               
                //$rider = ProCyclingstats::getRiderInfo($r->pcs_url);
                $r->age = 0;
                $r->nationality = "Unknown";
                
                $r->save();
                sleep(5);
            }
        }
    }
}

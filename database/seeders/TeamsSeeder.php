<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Classes\ProCyclingStats;
use App\Models\Team;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = ProCyclingStats::getAllTeams();
        foreach ($teams as $team) {
            $t = new Team();
            $t->name = $team['name'];
            $t->pcs_url = $team['pcs_url'];
            $team_info = ProCyclingStats::getTeamInfo($t->pcs_url);
            $t->nationality = $team_info['nationality'];
            $t->save();
            sleep(2);
        }
    }
}

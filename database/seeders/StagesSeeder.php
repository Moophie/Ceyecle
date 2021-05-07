<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Classes\ProCyclingStats;
use App\Models\Stage;

class StagesSeeder extends Seeder
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
            if ($race->class == "2.UWT") {
                $stages = ProCyclingStats::getStagesFromRace($race->pcs_url);

                foreach ($stages as $stage) {
                    $s = new Stage();
                    $s->name = $stage['name'];
                    $s->pcs_url = $stage['pcs_url'];
                    $s->race_id = $race->id;
                    $stage_info = ProCyclingStats::getStageInfo($s->pcs_url);
                    $s->date = $stage_info['date'];
                    $s->departure = $stage_info['departure'];
                    $s->arrival = $stage_info['arrival'];
                    $s->save();
                    sleep(5);
                }
            }
        }
    }
}
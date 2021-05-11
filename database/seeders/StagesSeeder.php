<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Classes\ProCyclingStats;
use App\Models\Race;
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
        $races = Race::all();
        foreach ($races as $race) {
            if ($race->class == "2.UWT") {
                $stages = ProCyclingStats::getStagesFromRace($race->pcs_url);

                foreach ($stages as $stage) {
                    $s = new Stage();
                    $s->name = $stage['name'];
                    if (!empty($s->name)) {
                        $s->pcs_url = $stage['pcs_url'];
                        $s->race_id = $race->id;
                        $stage_info = ProCyclingStats::getStageInfo($s->pcs_url);
                        $s->date = $stage_info['date'];
                        $s->type = $stage_info['type'];
                        $s->departure = $stage_info['departure'];
                        $s->arrival = $stage_info['arrival'];
                        $s->distance = $stage_info['distance'];
                        $s->profile_img = $stage_info['profile_img'];
                        $s->save();
                        sleep(2);
                    }
                }
            }
        }
    }
}

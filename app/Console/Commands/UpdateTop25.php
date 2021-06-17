<?php

namespace App\Console\Commands;

use App\Classes\ProCyclingStats;
use App\Models\Rider;
use App\Models\Stage;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTop25 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top25:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the current top25 for a given stage';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current_stage = '';
        $past_stages = Stage::whereRaw('date < ? ', [date("Y-m-d H:i:s")])->get();

        foreach ($past_stages as $p_s) {
            $end_of_stage = Carbon::createFromFormat('Y-m-d H:i:s', $p_s->date)->endOfDay();

            if (date("Y-m-d H:i:s") < date($end_of_stage)) {
                $current_stage = $p_s;
            };
        }
        
        if ($current_stage) {
            $top25 = [];
            // Demo purposes
            $top25_names = array('EGHOLM Jakob', 'MORENO Ivan', 'DONOVAN Mark', 'FRAILE Omar', 'FOSS Tobias', 'FRANK Mathias', 'FROOME Chris', 'VALVERDE Alejandro', 'ALAPHILIPPE Julian', 'BERNAL Egan', 'CARUSO Damiano', 'YATES Adam', 'ALMEIDA João', 'SAGAN Peter', 'WOODS Michael', 'GAUDU David', 'MARTIN Guillaume', 'EWAN Caleb', 'LANDA Mikel', 'MAS Enric', 'YATES Simon', 'CARTHY Hugh', 'PHILIPSEN Jasper', 'ULISSI Diego', 'NIZZOLO Giacomo');
            shuffle($top25_names);
            // Real version
            // $top25_names = ProCyclingStats::getLiveRanking($current_stage->pcs_url);
            $last_top25 = unserialize($current_stage->top25);

            $current_stage->last_leader = $last_top25[0];
            
            foreach ($top25_names as $name) {
                $rider_name = explode(" ", strrev($name), 2);
                $rider = Rider::where('firstname', strrev($rider_name[0]))->where('lastname', strrev($rider_name[1]))->first();
                array_push($top25, $rider->id);
            }

            $top25 = serialize($top25);
            $current_stage->top25 = $top25;
            $current_stage->save();
        }

        return 0;
    }
}

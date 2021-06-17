<?php

namespace App\Console\Commands;

use App\Classes\HelperFunctions;
use App\Models\Rider;
use App\Models\Room;
use App\Models\Stage;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Top25Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:top25';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a notification if the first place changes';

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
            $top25 = unserialize($current_stage->top25);
            $last_leader = $current_stage->last_leader;

            $current_leader = $top25[0];

            if ($last_leader != $current_leader) {
                $current_leader = Rider::find($current_leader);
                $current_rooms = Room::where('race_id', $current_stage->race->id)->get();
                $users = [];
                $registration_ids = [];
                foreach ($current_rooms as $room) {
                    $users = $room->users;
                    foreach ($users as $user) {
                        if ($user->device_key) {
                            array_push($registration_ids, $user->device_key);
                        }
                    }
                }
                
                if ($registration_ids) {
                    HelperFunctions::sendNotification('Exciting news!', $current_leader->firstname . " " . $current_leader->lastname . ' just took the lead in the ' . $current_stage->race->name, $registration_ids);
                }
            }
        }

        return 0;
    }
}

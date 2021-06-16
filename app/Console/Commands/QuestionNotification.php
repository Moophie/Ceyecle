<?php

namespace App\Console\Commands;

use App\Classes\HelperFunctions;
use App\Http\Controllers\WebNotificationController;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class QuestionNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:question';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an automated notification when there is an unanswered question.';

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
        $registration_ids = [];
        $users_with_rooms = User::has('rooms')->get();

        foreach ($users_with_rooms as $user) {
            foreach ($user->rooms as $room) {
                if ($room->pivot->status == 'active') {
                    $unanswered_questions = $room->questions->where('status', 'unanswered');
                    
                    if (count($unanswered_questions) > 0) {
                        if ($user->device_key) {
                            array_push($registration_ids, $user->device_key);
                        }
                    }
                }
            }
        }

        if ($registration_ids) {
            HelperFunctions::sendNotification('A new question!', 'You have an unanswered question waiting for you in Ceyecle!', $registration_ids);
        }
        
        return 0;
    }
}

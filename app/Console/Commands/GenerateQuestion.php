<?php

namespace App\Console\Commands;

use App\Classes\QuestionGenerator;
use App\Models\Race;
use App\Models\Room;
use Illuminate\Console\Command;

class GenerateQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'question:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get new questions for rooms without any.';

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
        $rooms = Room::whereDoesntHave('questions', function ($query) {
            $query->where('status', 'unanswered');
        })->get();

        foreach ($rooms as $room) {
            $room = Room::find($room->id);
            $race = Race::find($room->race->id);
            QuestionGenerator::newQuestion($room, $race);
        }

        return 0;
    }
}

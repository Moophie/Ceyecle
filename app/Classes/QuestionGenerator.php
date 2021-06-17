<?php

namespace App\Classes;

use App\Models\Question;
use App\Models\Rider;

class QuestionGenerator
{
    public static function newQuestion($room, $race, $top25 = [])
    {
        $rng = rand(0, 1);

        $q = new Question();

        switch ($rng) {
            case 0:
                $q->question = "Who won the last " . $race->name . "?";
                $q->answer = $race->previousWinners()->first()->firstname . " " . $race->previousWinners()->first()->lastname;
                break;

            case 1:
                $random_year = rand(2015, 2020);
                $q->question = "Who won the " . $race->name . " in " . $random_year . "?";
                $q->answer = $race->previousWinners()->where('year', $random_year . '-01-01')->first()->firstname . " " .  $race->previousWinners()->where('year', $random_year . '-01-01')->first()->lastname;
                break;
        }

        $q->room_id = $room->id;
        $q->status = "unanswered";
        $q->save();

        if (!empty($top25)) {
            $rng_rider = rand(0, (count($top25)-1));
            $rng = rand(0, 0);
            $rider_name = explode(" ", strrev($top25[0]->name), 2);
            $rider = Rider::where('firstname', strrev($rider_name[0]))->where('lastname', strrev($rider_name[1]))->first();

            $q = new Question();

            switch ($rng) {
            case 0:
                $q->question = $top25[$rng_rider]->name . " is momenteel op plaats " . $rng_rider . ". Uit welk land komt deze renner?";
                $q->answer = $rider->nationality;
                break;
        }

            $q->room_id = $room->id;
            $q->status = "unanswered";
            $q->save();
        }
        

        return redirect()->route('show-room', ['room' => $room->id]);
    }
}

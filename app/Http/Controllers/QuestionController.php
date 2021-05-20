<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Race;
use App\Models\Rider;
use App\Models\Room;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public static function raceQuestion(Request $request)
    {
        $room = Room::find($request->input('room-id'));
        $race = Race::find($room->race->id);
        $rng = rand(0, 1);

        $q = new Question();

        switch ($rng) {
            case 0:
                $q->question = "Who won the last " . $race->name . "?";
                $q->answer = $race->previousWinners()->first()->firstname . " " . $race->previousWinners()->first()->lastname;
                break;

            case 1:
                $random_year = rand(2015, 2020);
                $q->question = "Who won the the " . $race->name . " in " . $random_year . "?";
                $q->answer = $race->previousWinners()->where('year', $random_year . '-01-01')->first();
                break;
        }

        $q->room_id = $room->id;
        $q->status = "unanswered";
        $q->save();

        return redirect()->route('show-room', ['room' => $room->id]);;
    }

    public static function riderQuestion(Request $request)
    {
        $room = Room::find($request->input('room-id'));
        $race = Race::find($room->race->id);
        $top25 = json_decode($request->input('top-25'));
        $rng_rider = rand(0, (count($top25)-1));
        $rng = rand(0, 0);
        $rider_name = explode(" ", $top25[$rng_rider]);
        $rider = Rider::where('firstname', $rider_name[0])->where('lastname', $rider_name[1])->first(); 

        $q = new Question();

        switch ($rng) {
            case 0:
                $q->question = $top25[$rng_rider] . " is momenteel op plaats " . $rng_rider . ". Welke nationaliteit heeft deze renner?";
                $q->answer = $rider->nationality;
                break;
        }

        $q->room_id = $room->id;
        $q->status = "unanswered";
        $q->save();

        return redirect()->route('show-room', ['room' => $room->id]);;
    }

    public function answerQuestion(Request $request){
        $question = Question::find($request->input('question-id'));
        $room = Room::find($request->input('room-id'));
        $answer = strtolower($request->input('question-answer'));

        if($answer == strtolower($question->answer)){
            Question::where('id', $question->id)->update(['status' => 'answered']);
        }

        return redirect()->route('show-room', ['room' => $room->id]);;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Race;
use App\Models\Room;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public static function raceQuestion(Request $request)
    {
        $room = Room::find($request->input('room-id'));
        $race = Race::find($room->race->id);
        $rng = rand(0, 0);

        $q = new Question();

        switch ($rng) {
            case 0:
                $q->question = "Who won the last " . $race->name . "?";
                $q->answer = $race->previousWinners()->first()->firstname . " " . $race->previousWinners()->first()->lastname;
                break;

            case 1:
                $random_year = rand(2015, 2020);
                $q->question = "Who won the most " . $race->name . "s?";
                $q->answer = $race->previousWinners()->where('year', $random_year . '-01-01')->first();
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

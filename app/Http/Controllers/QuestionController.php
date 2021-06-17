<?php

namespace App\Http\Controllers;

use App\Classes\QuestionGenerator;
use App\Models\Question;
use App\Models\Race;
use App\Models\Rider;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Polyfill\Intl\Idn\Info;

class QuestionController extends Controller
{
    public static function raceQuestion(Request $request)
    {
        $room = Room::find($request->input('room-id'));
        $race = Race::find($room->race->id);
        
        QuestionGenerator::newQuestion($room, $race);

        return redirect()->route('show-room', ['room' => $room->id]);
    }

    public static function riderQuestion(Request $request)
    {
        $room = Room::find($request->input('room-id'));
        $race = Race::find($room->race->id);
        $top25 = json_decode($request->input('top-25'));
        
        QuestionGenerator::newQuestion($room, $race, $top25);

        return redirect()->route('show-room', ['room' => $room->id]);
    }

    public function answerQuestion(Request $request)
    {
        $question = Question::find($request->input('question-id'));
        $room = Room::find($request->input('room-id'));
        $answer = strtolower($request->input('question-answer'));
        $user = User::find($request->input('user-id'));
        $new_score = $user->score + 1;

        if ($answer == strtolower($question->answer)) {
            Question::where('id', $question->id)->update(['status' => 'answered', 'user_id' => $user->id]);
            User::where('id', $user->id)->update(['score' => $new_score]);
        }

        return redirect()->route('show-room', ['room' => $room->id]);
    }
}

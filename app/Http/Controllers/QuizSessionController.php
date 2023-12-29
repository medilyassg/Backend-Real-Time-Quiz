<?php

namespace App\Http\Controllers;

use App\Events\NextQuestion;
use App\Events\QuestionTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QuizSessionController extends Controller
{
    public function getDataQuizSession(Request $request){
        
        $pin = $request->input('pin');
        $data = Cache::get("quiz-session-{$pin}");
        Cache::put("first-time-{$pin}", ["state"=>0], now()->addHours(1));

        return response()->json(['data' => $data]);
    }

    public function changeTime(Request $request){

        $pin = $request->input('pin');

        $timeRequest = $request->input('time');

        $data = Cache::get("quiz-session-{$pin}");

        $newData = ["time"=>$timeRequest,"index"=>$data['index'],"score"=> $data["score"]];

        Cache::put("quiz-session-{$pin}", $newData, now()->addHours(1));

        if($timeRequest==0){
            broadcast(new QuestionTime($pin, $newData));
        }

        return response()->json(['data' => $newData]);
    }

    public function changeIndex(Request $request){
        $pin = $request->input('pin');

        $indexRequest = $request->input('index');

        $stateRequest=$request->input('state');

        $data = Cache::get("quiz-session-{$pin}");

        $newData = ["time"=>$data['time'],"index"=>$indexRequest,"score"=> $data["score"]];

        Cache::put("quiz-session-{$pin}", $newData, now()->addHours(1));

        broadcast(new NextQuestion($pin,$stateRequest,$indexRequest));

        return response()->json(['data' => $newData]);
    }

    public function getScoreOfplayer(Request $request){
        $pin=$request->input('pin');
        $nameToFind = $request->input('nickname');
        $time = Cache::get("quiz-session-{$pin}");
        $score = null; 

        foreach ($time['score'] as $item) {
            if ($item['name'] === $nameToFind) {
                $score = $item['score'];
                break;
            }
        }

        if ($score !== null) {
            return response()->json(["score"=> $score]);
        } else {
            return response()->json(["error"=>"Name not found"]);
        }
        
    }

    public function changeScore(Request $request){

        $pin=$request->input('pin');
        $nameToUpdate = $request->input('nickname');
        $newScoreValue = $request->input('score');; 
        $indexToUpdate = -1;
        $data = Cache::get("quiz-session-{$pin}");

        foreach ($data['score'] as $index => $item) {
            if ($item['name'] === $nameToUpdate) {
                $indexToUpdate = $index;
                break;
            }
        }

        if ($indexToUpdate !== -1) {
            
            $data['score'][$indexToUpdate]['score'][] = $newScoreValue;
        } else {
            
            $data['score'][] = ['name' => $nameToUpdate, 'score' => [$newScoreValue]];
        }

        Cache::put("quiz-session-{$pin}", $data, now()->addHours(1));

        return response()->json(["data"=> $data]);
    }

    public function deleteCache(){
        Cache::flush();
        return response()->json(["success"=> true]);
    }

    public function getFirstTime(Request $request){
        $pin = $request->input('pin');
        $data = Cache::get("first-time-{$pin}");
        return response()->json(['data' => $data]);
    }

    public function changeFirstTime(Request $request){
        $pin = $request->input('pin');
        $newData=["state"=>1];
        Cache::put("first-time-{$pin}", $newData, now()->addHours(1));
        return response()->json(['data' => $newData]);
    }









}

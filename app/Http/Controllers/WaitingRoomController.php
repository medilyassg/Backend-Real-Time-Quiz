<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Events\WaitingRoomCreated;
use Illuminate\Support\Str;
use App\Events\PlayerJoined;
use App\Events\QuizStarted;

class WaitingRoomController extends Controller
{
    public function createRoom(Request $request)
    {
        $user = Auth::user(); // Assuming you have authentication set up



        $pin =  substr(Str::random(10), 0, 5);;
        // Store the room PIN and host information in cache
        $waitingRoom = ['host' => $user, 'players' => []];
        Cache::put("waiting-room-{$pin}", $waitingRoom, now()->addHours(1));

        // Broadcast the waiting room creation event
        broadcast(new WaitingRoomCreated($pin, $waitingRoom));

        return response()->json(['pin' => $pin, 'message' => 'Waiting room created successfully']);
    }

    public function roomExists(Request $request)
    {
        $pin = $request->input('pin');

        // Retrieve the waiting room from cache
        $waitingRoom = Cache::get("waiting-room-{$pin}");

        // Check if the waiting room exists
        if (!$waitingRoom) {
            return response()->json(['exists' => false, 'message' => 'The room does not exist.']);
        }

        return response()->json(['exists' => true, 'message' => 'The room exists.']);
    }

    public function joinRoom(Request $request)
    {
        $pin = $request->input('pin');
        $nickname = $request->input('nickname');



        // Retrieve the waiting room from cache
        $waitingRoom = Cache::get("waiting-room-{$pin}");

        // Check if the waiting room exists
        if (!$waitingRoom) {
            return response()->json(['error' => 'Invalid PIN. The waiting room does not exist.']);
        }

        // Add the player to the waiting room
        $waitingRoom['players'][] = ['nickname' => $nickname];
        Cache::put("waiting-room-{$pin}", $waitingRoom, now()->addHours(1));

        // Broadcast the player joined event
        broadcast(new PlayerJoined($pin, $nickname));

        return response()->json(['message' => 'Successfully joined the room','room'=>$waitingRoom]);
    }

    public function getPlayers(Request $request)
    {
        $pin = $request->input('pin');

        // Retrieve the waiting room from cache
        $waitingRoom = Cache::get("waiting-room-{$pin}");

        // Check if the waiting room exists
        if (!$waitingRoom) {
            return response()->json(['error' => 'Invalid PIN. The waiting room does not exist.']);
        }

        // Return the list of players
        $players = $waitingRoom['players'];

        return response()->json(['players' => $players]);
    }

    public function startQuiz(Request $request)
    {
        $pin = $request->input('pin');
        $quizId = $request->input('quizId');

        // Broadcast the quiz started event
        broadcast(new QuizStarted($pin,$quizId));

        return response()->json(['message' => 'Quiz has started']);
    }
}

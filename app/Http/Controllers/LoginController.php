<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;


class LoginController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('throttle:3,1')->only('login');

    }

    public function login(LoginRequest $request){
        $request->authenticate();
        
        return UserResource::make(auth()->user())
            ->additional([
                'message' => 'Logged in successful.'
            ]);
    }

    public function logout(){

        Auth::guard('web')->logout();

        if (Auth::check()) {
            Auth::guard('web')->logout();
            Session::flush();
            return response()->json(['message' => 'Logged out successfully'], 200)
            ->cookie('XSRF-TOKEN', '', 0, '/', null, false, true);
        }
        
        return response()->json(
            [
                'error' => 'Logged out'
            ]
        ,500);
    }

    public function user()
    {
        return UserResource::make(auth()->user());
    }
}

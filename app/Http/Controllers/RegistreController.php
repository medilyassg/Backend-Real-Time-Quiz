<?php

namespace App\Http\Controllers;

use App\Repository\DBUsersRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistreRequest;

class RegistreController extends Controller
{

    public function registre(RegistreRequest $request,DBUsersRepository $userRepository){

        $request->validated();

        $user=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'email_verified_at'=>now(),
            'remember_token' => Str::random(10),
        ];
        
        $userRepository->create($user);

        return response()->json(
            [
                'message' => 'Registration in successful.'
            ],200
        );

    }
}

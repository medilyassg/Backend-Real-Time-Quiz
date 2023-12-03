<?php

namespace App\Repository;

use App\Models\User;

class DBUsersRepository{

    public function all(){

        return User::all();
    }

    public function create($attributs){

        return User::create($attributs);

    }
}
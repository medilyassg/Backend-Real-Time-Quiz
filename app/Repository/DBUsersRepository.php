<?php

namespace App\Repository;

use App\Models\User;
use App\RepositoryInterface\StandardRepositoryInterface;

class DBUsersRepository implements StandardRepositoryInterface{

    public function all(){

        return User::all();
    }

    public function create($attributs){

        return User::create($attributs);

    }
}
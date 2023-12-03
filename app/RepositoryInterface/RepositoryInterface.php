<?php

namespace App\RepositoryInterface;

interface StandardRepositoryInterface{

    public function all();

    public function create($attributs);

}
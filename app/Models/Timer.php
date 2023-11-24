<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function session()
    {
        return $this->belongsTo(QuizSession::class);
    }
}

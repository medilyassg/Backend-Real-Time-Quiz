<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function host()
    {
        return $this->belongsTo(Host::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

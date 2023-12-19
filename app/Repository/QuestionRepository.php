<?php

namespace App\Repository;

use App\Models\Question;

class QuestionRepository
{
    public function all()
    {
        return Question::all();
    }

    public function create(array $data)
    {
        return Question::create($data);
    }

    public function find($question){
        
        return $question;
    }

    public function update($question, array $data)
    {
        $question->update($data);
        return $question;
    }

    public function delete($question)
    {
        return $question->delete();
    }
}

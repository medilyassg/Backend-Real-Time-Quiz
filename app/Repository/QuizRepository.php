<?php

namespace App\Repository;

use App\Models\Quiz;

class QuizRepository
{
    public function all()
    {
        return Quiz::all();
    }

    public function create(array $data)
    {
        return Quiz::create($data);
    }

    public function update(Quiz $quiz, array $data)
    {
        $quiz->update($data);
        return $quiz;
    }

    public function delete(Quiz $quiz)
    {
        $quiz->delete();
    }
}

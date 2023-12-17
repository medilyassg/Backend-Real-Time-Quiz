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

    public function update(Question $quiz, array $data)
    {
        $quiz->update($data);
        return $quiz;
    }

    public function delete(Question $quiz)
    {
        $quiz->delete();
    }
}

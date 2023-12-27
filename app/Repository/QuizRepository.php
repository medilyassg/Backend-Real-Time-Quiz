<?php

namespace App\Repository;

use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class QuizRepository
{
    public function all()
    {
        return Quiz::all();
    }

    public function find($id){
        $firstResult = Quiz::orderByDesc('created_at')->where('quizzes.hostId', '=', $id)->first();
        $lastResult = Quiz::join('questions', 'quizzes.id', '=', 'questions.quizId')
            ->join('options', 'questions.id', '=', 'options.questionId')
            ->where('quizzes.id', '=',$firstResult->id)
            ->select(
                'questions.text as question',
                DB::raw("MAX(CASE WHEN options.correct = 1 THEN options.text END) as correctAnswer"),
                DB::raw('JSON_ARRAYAGG(options.text) as answers')
            )
            ->groupBy('quizzes.id', 'questions.id') 
            ->orderBy('quizzes.created_at', 'desc') 
            ->get();

        $lastResult->transform(function ($item) {
            $item->answers = json_decode($item->answers);
            return $item;
        });

        return $lastResult;
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

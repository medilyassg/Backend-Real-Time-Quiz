<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use App\Repository\QuizRepository;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    private $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function index()
    {
        $quizzes = $this->quizRepository->all();
        return response()->json($quizzes);
    }

    public function store(QuizRequest $request)
    {
        $quiz = $this->quizRepository->create($request->all());
        return response()->json($quiz, 201);
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $quiz = $this->quizRepository->update($quiz, $request->all());
        return response()->json($quiz);
    }

    public function destroy(Quiz $quiz)
    {
        $this->quizRepository->delete($quiz);
        return response()->json(null, 204);
    }
}
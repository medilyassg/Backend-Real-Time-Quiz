<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Repository\QuestionRepository;

class QuestionController extends Controller
{

    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }


    public function index()
    {
        return QuestionResource::collection($this->questionRepository->all());
    }


    public function store(QuestionRequest $request)
    {
        if($request->validated()){
            $this->questionRepository->create($request->validated());
            return QuestionResource::collection($this->questionRepository->all());
        }
        return response()->json(["message"=>'data not valid'],400);
    }


    public function show(Question $question)
    {
        return QuestionResource::make($this->questionRepository->find($question));
    }



    public function update(QuestionRequest $request,Question $question)
    {
        if($request->validated()){
            $this->questionRepository->update($question,$request->validated());
            return QuestionResource::collection($this->questionRepository->all());
        }
        return response()->json(["message"=>'data not valid or resource not found'],400);
    }


    public function destroy(Question $question)
    {
        $state=$this->questionRepository->delete($question);
        if($state){
            return response()->json(['message'=> 'Data deleted successfully'],200);
        }
        return response()->json(['message'=> 'Resource not found'],404);
    }
}

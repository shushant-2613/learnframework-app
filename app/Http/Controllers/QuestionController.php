<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Services\ExternalApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class QuestionController extends Controller
{    
    protected $externalApiService;

    public function __construct(ExternalApiService $externalApiService)
    {
        $this->externalApiService = $externalApiService;
    }

    public function fetchInsert()
    {
                // Fetch questions from the external API
                $apiQuestions = $this->externalApiService->getQuestions();

                // Process and insert questions into the local database
                foreach ($apiQuestions as $apiQuestion) {
                    $question = new Question();
                    $question->question = $apiQuestion['question'];
                    // Assuming answers is an array, adjust accordingly if it's an object
                    $question->answer_a = $apiQuestion['answers']['answer_a'];
                    $question->answer_b = $apiQuestion['answers']['answer_b'];
                    $question->answer_c = $apiQuestion['answers']['answer_c'];
                    
                    $question->save();
                }
        
                // Retrieve questions from the local database
                $localQuestions = Question::all();
                return view('questions', compact('localQuestions'));
    }

    public function show(){
        $localQuestions = Question::all(); 
        return view('questions', compact('localQuestions'));
    }

    //end of class
}
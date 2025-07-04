<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("admin.question.create_question");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Quiz $quiz)
    {
        //
        return view("admin.question.create_question",["quiz"=>$quiz]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate(
            [
                "question_text" => ["required"],
                "quiz_id" => ["required"],
            ]
        );
        $q= Question::create([
            "quiz_id" => $request["quiz_id"],
            "question_text" => $request["question_text"],
        ]);
        $request->session()->put("question_id",$q->id);
        return response()->json([
            "success" => true,
            "message" => "Question added successfully!",
            "data" => [
                "question_id" => $q->id,
                "quiz_id" => $request["quiz_id"],
                "question_text" => $request["question_text"]
            ]
        ]);
    }

    /**
     * Add a question label to the database.
     */
    public function addOptionLabel(Request $request)
    {
        $validated = $request->validate([
            'option_text' => 'required|string',
            'option_label' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
            'question_id' => 'required',
        ]);

        // Save the option label to the database
        $o=Option::create([
            'option_text' => $validated['option_text'],
            'question_id' => $validated['question_id'],
            'option_label' => $validated['option_label'],
            'is_correct' => $validated['is_correct'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Question label added successfully!',
            'data'=>$o
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
        // dd($question);
        return view("admin.question.show",['quiz'=>$quiz]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
        $question->delete();    
        return back()->with("success","Question deleted successfully");
    }

    /**
     * Get the correct answer for a question.
     */
    public function getCorrectAnswer($id)
    {
        $question = Question::with('options')->findOrFail($id);

        $correctOption = $question->options->where('is_correct', true)->first();

        if ($correctOption) {
            return response()->json([
                'success' => true,
                'correct_answer' => "{$correctOption->option_label}: {$correctOption->option_text}"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No correct answer found for this question.'
        ]);
    }
}

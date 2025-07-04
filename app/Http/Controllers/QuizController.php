<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quiz = Quiz::latest()->get();
        return view("admin.quiz.index", ["quiz" => $quiz]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.quiz.create_quiz");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required"],
            "description" => ["required"]
        ]);

        Quiz::create($validated);
        return redirect("/admin/quiz")->with(["message" => "quiz created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
        // dd($quiz);
        return view("admin.quiz.show", ["quiz" => $quiz]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        //
        // dd($quiz);
        return view("admin.quiz.edit", ["quiz" => $quiz]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
        // dd($quiz);
        $validated = $request->validate([
            "name" => ["required"],
            "description" => ["required"]
        ]);
        $quiz->update($validated);
        return redirect("/admin/quiz")->with(["update" => "quiz update"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        //
        $quiz->delete();
        return redirect("/admin/quiz")->with(["delete" => "quiz deleted"]);
        // dd($quiz);
    }
}


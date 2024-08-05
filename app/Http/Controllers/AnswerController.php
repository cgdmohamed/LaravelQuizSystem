<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function index(Question $question)
    {
        return view('answers.index', compact('question'));
    }

    public function create(Question $question)
    {
        return view('answers.create', compact('question'));
    }

    public function store(Request $request, Question $question)
    {
        $answer = new Answer($request->all());
        $question->answers()->save($answer);
        return redirect()->route('questions.answers.index', $question);
    }

    public function edit(Question $question, Answer $answer)
    {
        return view('answers.edit', compact('question', 'answer'));
    }

    public function update(Request $request, Question $question, Answer $answer)
    {
        $answer->update($request->all());
        return redirect()->route('questions.answers.index', $question);
    }

    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();
        return redirect()->route('questions.answers.index', $question);
    }

}

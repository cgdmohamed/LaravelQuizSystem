<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        return view('questions.index', compact('quiz'));
    }

    public function create(Quiz $quiz)
    {
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $question = new Question($request->all());
        $quiz->questions()->save($question);
        return redirect()->route('quizzes.questions.index', $quiz);
    }

    public function edit(Quiz $quiz, Question $question)
    {
        return view('questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        $question->update($request->all());
        return redirect()->route('quizzes.questions.index', $quiz);
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        $question->delete();
        return redirect()->route('quizzes.questions.index', $quiz);
    }
}

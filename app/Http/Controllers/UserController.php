<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\Quiz;

class UserController extends Controller
{
    public function submitQuiz(Request $request, Quiz $quiz)
    {
        $userAnswers = $request->input('answers');

        foreach ($userAnswers as $questionId => $answer) {
            UserAnswer::create([
                'user_id' => auth()->id(),
                'quiz_id' => $quiz->id,
                'question_id' => $questionId,
                'answer_id' => $answer['answer_id'] ?? null,
                'answer_text' => $answer['answer_text'] ?? null,
            ]);
        }

        // Calculate the result
        $correctAnswers = 0;
        $totalQuestions = $quiz->questions()->count();

        foreach ($quiz->questions as $question) {
            if ($question->question_type == 'multiple_choice' || $question->question_type == 'true_false') {
                $userAnswer = UserAnswer::where([
                    ['user_id', auth()->id()],
                    ['quiz_id', $quiz->id],
                    ['question_id', $question->id],
                ])->first();

                if ($userAnswer && $userAnswer->answer_id == $question->answers()->where('is_correct', true)->first()->id) {
                    $correctAnswers++;
                }
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;

        return view('quizzes.result', compact('score', 'quiz'));
    }
}

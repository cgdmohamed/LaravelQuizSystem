<?php
namespace App\Services;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Question;

class QuizService
{
    public function calculateQuizResult(Request $request, Quiz $quiz)
    {
        $correctAnswers = 0;
        $totalQuestions = $quiz->questions->count();
        $userResults = [];

        foreach ($quiz->questions as $question) {
            $userAnswers = $request->input('answers.' . $question->id);
            $isCorrect = false;
            $answerTexts = [];
            $correctAnswerText = '';

            if ($question->question_type == 'multiple_choice') {
                $correctAnswerIds = $question->answers->where('is_correct', true)->pluck('id')->toArray();
                $answerTexts = $question->answers->whereIn('id', $userAnswers)->pluck('answer_text')->toArray();
                $correctAnswerText = $question->answers->where('is_correct', true)->pluck('answer_text')->toArray();

                if ($userAnswers && !array_diff($correctAnswerIds, $userAnswers) && !array_diff($userAnswers, $correctAnswerIds)) {
                    $correctAnswers++;
                    $isCorrect = true;
                }
            } elseif ($question->question_type == 'true_false') {
                $correctAnswer = $question->answers->where('is_correct', true)->first();
                $userAnswerText = $question->answers->find($userAnswers)->answer_text ?? '';
                $answerTexts[] = $userAnswerText;
                $correctAnswerText = $correctAnswer->answer_text;

                if ($correctAnswer && $correctAnswer->id == $userAnswers) {
                    $correctAnswers++;
                    $isCorrect = true;
                }
            } elseif ($question->question_type == 'short_answer') {
                $correctAnswer = $question->answers->where('is_correct', true)->first();
                $answerTexts[] = $userAnswers;
                $correctAnswerText = $correctAnswer->answer_text;

                if ($correctAnswer && strtolower($correctAnswer->answer_text) == strtolower($userAnswers)) {
                    $correctAnswers++;
                    $isCorrect = true;
                }
            }

            $userResults[] = [
                'question_id' => $question->id,
                'question_text' => $question->question_text,
                'user_answer' => $answerTexts,
                'correct_answer' => $correctAnswerText,
                'is_correct' => $isCorrect
            ];
        }

        $score = ($correctAnswers / $totalQuestions) * 100;

        return [
            'score' => $score,
            'user_results' => $userResults
        ];
    }


    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'answers' => 'required|array',
            'correct_answer' => 'required'
        ]);

        $question = $quiz->questions()->create($request->only('question_text', 'question_type'));

        foreach ($request->answers as $index => $answerText) {
            $question->answers()->create([
                'answer_text' => $answerText,
                'is_correct' => in_array($index, $request->correct_answer)
            ]);
        }

        return $question;
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'answers' => 'required|array',
            'correct_answer' => 'required'
        ]);

        $question->update($request->only('question_text', 'question_type'));

        $question->answers()->delete();

        foreach ($request->answers as $index => $answerText) {
            $question->answers()->create([
                'answer_text' => $answerText,
                'is_correct' => in_array($index, $request->correct_answer)
            ]);
        }

        return $question;
    }
}

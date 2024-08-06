<?php

namespace App\Exports;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Answer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class QuestionsExport implements WithHeadings, WithMapping
{
    public function array(): array
    {
        $quizzes = Quiz::with('questions.answers')->get();
        $data = [];

        foreach ($quizzes as $quiz) {
            foreach ($quiz->questions as $question) {
                foreach ($question->answers as $answer) {
                    $data[] = [
                        'quiz_name' => $quiz->name,
                        'question' => $question->question_text,
                        'question_type' => $question->question_type,
                        'answer' => $answer->answer_text,
                        'is_correct' => $answer->is_correct ? 1 : '',
                    ];
                }
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Quiz Name',
            'Question',
            'Question Type',
            'Answer',
            'Is Correct',
        ];
    }

    public function map($question): array
    {
        $rows = [];

        foreach ($question->answers as $answer) {
            $rows[] = [
                $question->id,
                $question->quiz_id,
                $question->question_text,
                $question->question_type,
                $answer->id,
                $answer->answer_text,
                $answer->is_correct,
            ];
        }

        return $rows;
    }
}
<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Answer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class QuestionsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $question = Question::firstOrCreate([
            'id' => $row['question_id'],
        ], [
            'quiz_id' => $row['quiz_id'],
            'question_text' => $row['question_text'],
            'question_type' => $row['question_type'],
        ]);

        Answer::updateOrCreate([
            'id' => $row['answer_id'],
        ], [
            'question_id' => $question->id,
            'answer_text' => $row['answer_text'],
            'is_correct' => $row['is_correct'],
        ]);

        return $question;
    }

    public function rules(): array
    {
        return [
            '*.quiz_id' => 'required|exists:quizzes,id',
            '*.question_text' => 'required|string',
            '*.question_type' => 'required|string',
            '*.answer_text' => 'required|string',
            '*.is_correct' => 'required|boolean',
        ];
    }
}
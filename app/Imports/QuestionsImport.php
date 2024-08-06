<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Answer;
use App\Models\Quiz;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Log;


class QuestionsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        try {
            // Use the title field directly for the quiz
            $quiz = Quiz::firstOrCreate(['title' => $row['quiz_name']]); // Change to 'title'

            $question = Question::firstOrCreate([
                'quiz_id' => $quiz->id,
                'question_text' => $row['question'],
                'question_type' => $row['question_type'],
            ]);

            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $row['answer'],
                'is_correct' => isset($row['is_correct']) && $row['is_correct'] == 1,
            ]);

        } catch (\Exception $e) {
            Log::error('Import error: ' . $e->getMessage());
        }
    }

    public function rules(): array
    {
        return [
            '*.quiz_name' => 'required|string',
            '*.question' => 'required|string',
            '*.question_type' => 'required|in:multiple_choice,true_false,short_answer',
            '*.answer' => 'required|string',
            '*.is_correct' => 'nullable|in:1',
        ];
    }
}
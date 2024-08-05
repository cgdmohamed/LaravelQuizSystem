<?php

namespace App\Exports;

use App\Models\Question;
use App\Models\Answer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class QuestionsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Question::with('answers')->get();
    }

    public function headings(): array
    {
        return [
            'Question ID',
            'Quiz ID',
            'Question Text',
            'Question Type',
            'Answer ID',
            'Answer Text',
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
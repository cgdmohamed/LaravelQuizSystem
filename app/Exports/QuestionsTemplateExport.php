<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;


class QuestionsTemplateExport implements FromArray, WithHeadings 
{
    public function array(): array
    {
        return [
            ['Book One', 'Question1', 'multiple_choice', 'Answer 1', 1],
            ['Book One', 'Question1', 'multiple_choice', 'Answer 2', ''],
            ['Book One', 'Question1', 'multiple_choice', 'Answer 3', ''],
            ['Book One', 'Question1', 'multiple_choice', 'Answer 4', ''],
            ['Book Two', 'Question1', 'true_false', 'true', 1],
            ['Book Two', 'Question1', 'true_false', 'false', ''],
            ['Book Two', 'Question2', 'multiple_choice', 'Answer 1', ''],
            ['Book Two', 'Question2', 'multiple_choice', 'Answer 2', 1],
            ['Book Two', 'Question2', 'multiple_choice', 'Answer 3', ''],
            ['Book Two', 'Question2', 'multiple_choice', 'Answer 4', ''],
        ];
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
}

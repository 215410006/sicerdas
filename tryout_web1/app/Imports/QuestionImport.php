<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{
    public function model(array $row)
    {
        return new Question([
            'question_text' => $row[0],
            'options' =>[$row[1], $row[2], $row[3], $row[4]],
            'correct_answer' => $row[5],
        ]);
    }
}

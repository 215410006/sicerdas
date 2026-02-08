<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Penalaran Umum'],
            ['name' => 'Penalaran Matematika'],
            ['name' => 'Pemahaman Bacaan dan Menulis'],
            ['name' => 'Literasi dalam Bahasa Inggris'],
            ['name' => 'Literasi dalam Bahasa Indonesia'],
            ['name' => 'Pengetahuan Kuantitatif'],
            ['name' => 'Pengetahuan dan Pemahaman Umum'],
        ];

        foreach ($categories as $category) {
            DB::table('question_categories')->insert([
                'name' => $category['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

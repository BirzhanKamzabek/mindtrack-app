<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Question::create(['text' => 'Как часто вы чувствуете себя усталым?']);
        Answer::create(['question_id' => 1, 'text' => 'Никогда', 'score' => 0]);
        Answer::create(['question_id' => 1, 'text' => 'Иногда', 'score' => 1]);
        Answer::create(['question_id' => 1, 'text' => 'Часто', 'score' => 2]);
        Answer::create(['question_id' => 1, 'text' => 'Постоянно', 'score' => 3]);
    }
}

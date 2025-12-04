<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Word;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Word::insert([
            ['name' => 'php'],
            ['name' => 'home'],
            ['name' => 'junior'],
            ['name' => 'sinior'],
            ['name' => 'javascript'],
            ['name' => 'yamaha'],
            ['name' => 'game'],
            ['name' => 'Laravel'],
        ]);
    }
}

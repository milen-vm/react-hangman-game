<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class GameController extends Controller
{
    
    public function index()
    {
        $word = Word::inRandomOrder()->first();
        $chars = [];

        if($word) {
            $chars = mb_str_split($word->name);
        }

        return view('index', compact('word', 'chars'));
    }

    public function getWord()
    {
        $word = Word::inRandomOrder()->first();
        $chars = [];

        if($word) {
            $chars = mb_str_split($word->name);
        }

        return response()->json([
            'chars' => $chars,
        ]);
    }

    public function submitLetter(Request $request, $wordId)
    {
        dd($request->all());
    }
}

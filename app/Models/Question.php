<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'options', 'correct_option'];

    protected $casts = [
        'options' => 'array'
    ];

    // count correct answer

    public static function getCorrectAnswerCount()
    {
        $count = self::count('correct_option');

        return 'correct answer count: ' . $count;
    }

    // search question by title

    public static function getByTitle($string)
    {
        return self::where('title', 'like', '%' . $string . '%')->get();
    }

    // method to sort by correct answer

    public static function sortByCorrectAnswer()
    {
        return self::orderBy('correct_option', 'desc')->get();
    }

}

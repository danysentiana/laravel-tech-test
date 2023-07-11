<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        $question = Question::limit($limit)->get();

        return response()->json(['questions' => $question]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'options' => 'required|array',
            'correct_option' => 'required|integer|min:0|max:' . (count($request->options) - 1),
        ]);

        $question = Question::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'options' => $validatedData['options'],
            'correct_option' => $validatedData['correct_option'],
        ]);

        return response()->json(['question' => [
            'id' => $question->id,
            'title' => $question->title,
            'content' => $question->content,
            'options' => $question->options,
            'correct_option' => $question->correct_option,
        ]]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['message' => 'Pertanyaan tidak ditemukan'], 404);
        }

        return response()->json(['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        // validation
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'options' => 'required|array',
            'correct_option' => 'required|integer|min:0|max:' . (count($request->options) - 1),
        ]);

        $question->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'options' => $validatedData['options'],
            'correct_option' => $validatedData['correct_option'],
        ]);

        return response()->json([
            'question' => [
                'id' => $question->id,
                'title' => $question->title,
                'content' => $question->content,
                'options' => $question->options,
                'correct_option' => $question->correct_option,
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'Question deleted']);
    }
}

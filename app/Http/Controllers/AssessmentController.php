<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAi;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //When the page is loaded
        $question = 'Question: Do you have an Anti-Virus installed? How often do you run scan?';
        $question_no = 1;
        return view('write', compact('question', 'question_no'));
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
        // clicking on the proceed button
        $questions_arr = [
            'Question: Do you have an Anti-Virus installed? How often do you run scan?',
            'Question: How do you backup data?',
            'Question: What are your online privacy practices?',
            'Question: Which programming languages do you prefer?'
        ];
        if ($request->question_no == 1) {
            $question = $questions_arr[0];
            $question_no = $request->question_no;
            return view('write', compact('question', 'question_no'));
        } elseif ($request->question_no == 2) {
            $question = $questions_arr[1];
            $question_no = $request->question_no;
            return view('write', compact('question', 'question_no'));
        } elseif ($request->question_no == 3) {
            $question = $questions_arr[2];
            $question_no = $request->question_no;
            return view('write', compact('question', 'question_no'));
        } elseif ($request->question_no == 4) {
            $question = $questions_arr[3];
            $question_no = $request->question_no;
            return view('write', compact('question', 'question_no'));
        } else {
            return view('write', ['question' => '', 'question_no' => 5]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

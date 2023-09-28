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
        $title = '';
        $content = '';
        return view('write', compact('title', 'content'));
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
        if ($request->title == null) {
            return;
        }

        $title = 'Question: Do you have an Anti-Virus installed? How often do you run scans?' . 'Answer: ' . $request->title;

        $client = OpenAI::client(config('app.openai_api_key'));

        // dd($title);
        $result = $client->completions()->create([
            "model" => "text-davinci-003",
            // "model" => "text-davinci-003",
            // "temperature" => 0.7,
            // "top_p" => 1,
            // "frequency_penalty" => 0,
            // "presence_penalty" => 0,
            'max_tokens' => 100,
            'prompt' => sprintf('Analyse the answer followed by the question and tell him whats wrong with the answer and if the answer is good give just return the answer is good to go: %s', $title),
        ]);

        // dd($result['choices'][0]);
        $content = trim($result['choices'][0]['text']);
        return view('write', compact('title', 'content'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class HomeController extends Controller
{
    function index(Request $request)
    {
        //Ajax request to get suggestions on the answers
        if ($request->answer == null) {
            return;
        }
        $title = $request->question . ' Answer: ' . $request->answer;

        $client = OpenAI::client(config('app.openai_api_key'));

        $result = $client->completions()->create([
            "model" => "text-davinci-003",
            // "model" => "text-davinci-003",
            // "temperature" => 0.7,
            // "top_p" => 1,
            // "frequency_penalty" => 0,
            // "presence_penalty" => 0,
            'max_tokens' => 100,
            'prompt' => sprintf('Analyse the answer followed by the question and tell him whats wrong with the answer. Also only if the answer is same as you expect than return 1: %s', $title),
        ]);

        $content = trim($result['choices'][0]['text']);
        return $content;
    }
}

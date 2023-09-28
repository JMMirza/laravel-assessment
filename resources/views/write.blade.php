<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Risk Analysis Application - AI Writing Assistant for Bloggers</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        body {
            font-family: "Space Grotesk", sans-serif;
        }

        .title:empty:before {
            content: attr(data-placeholder);
            color: gray;
        }
    </style>

    <script src="https://unpkg.com/marked" defer></script>
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl w-full mx-auto sm:px-6 lg:px-8 space-y-4 py-4">
            <div class="text-center text-gray-800 dark:text-gray-300 py-4">
                <h1 class="text-7xl font-bold">Risk Analysis Application</h1>
            </div>

            <div class="w-full rounded-md bg-white border-2 border-gray-600 p-4 min-h-[60px] h-full text-gray-600">
                @if ($question_no == 5)
                    <h1>Thank you</h1>
                @else
                    <form action="{{ route('assessment.store') }}" method="post" class="gap-2 w-full">
                        @csrf
                        <input name="" id="" class="w-full mb-3 outline-none text-2xl font-bold"
                            placeholder="{{ $question }}" value="{{ $question }}" disabled />

                        <input required name="answer" id="answer" class="w-full outline-none text-2xl font-bold"
                            placeholder="Type your answer here...">
                        <input required name="question" id="question" value="{{ $question }}"
                            style="display: none" />
                        <input id="question_no" name="question_no" value="{{ $question_no + 1 }}"
                            style="display: none" />
                        <button class="rounded-md bg-emerald-500 mt-3 px-4 py-2 text-white font-semibold float-end"
                            id="proceedButton" disabled>
                            Proceed
                        </button>
                    </form>
                @endif
                <input id="url" value="{{ route('check-ans') }}" style="display: none" />
            </div>
            <textarea class="min-h-[120px] h-full w-full outline-none" id="error" spellcheck="false"
                style="background: rgb(252, 140, 140); display:none">
                </textarea>
            <textarea class="min-h-[120px] h-full w-full outline-none" id="success" spellcheck="false"
                style="background: rgb(0, 176, 164); display:none">
                </textarea>
        </div>
    </div>
    <script>
        (function($) {
            $.debounce = function(func, delay) {
                var timer;
                return function() {
                    var args = arguments;
                    var context = this;
                    clearTimeout(timer);
                    timer = setTimeout(function() {
                        func.apply(context, args);
                    }, delay);
                };
            };
        })(jQuery);
        $(document).ready(function() {
            var inputField = $("#answer");
            var url = $('#url').val()
            var debouncedFunction = function() {
                var question = $('#question').val()
                var answer = $('#answer').val()
                if (answer !== "") {
                    // Send a request to the server to perform the search.
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            question: question,
                            answer: answer,
                        },
                        success: function(response) {
                            console.log(response);
                            if (!response.includes('1')) {
                                document.getElementById('error').style.display = "block";
                                document.getElementById('success').style.display = "none";
                                $('#error').val(response)
                                $('#proceedButton').prop('disabled', true);
                            } else {
                                document.getElementById('success').style.display = "block";
                                document.getElementById('error').style.display = "none";
                                $('#success').val('The answer is good to go!')
                                $('#proceedButton').prop('disabled', false);
                            }
                        },
                        error: function(error) {
                            console.log(error)
                            // $('#err_div').text(response.success);
                        }
                    });
                }
            };

            // Bind the `keyup` event to the input field element and pass the debounced function to it.
            inputField.keyup($.debounce(debouncedFunction, 1000));
        })
    </script>
</body>

</html>

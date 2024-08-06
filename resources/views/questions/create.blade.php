@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Create Question for {{ $quiz->title }}</h1>

        <form action="{{ route('quizzes.questions.store', $quiz) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Question Text Field -->
            <div class="mb-4">
                <label for="question_text" class="block text-sm font-medium text-gray-700">Question Text</label>
                <input type="text" name="question_text" id="question_text"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required>
            </div>

            <!-- Question Type Selector -->
            <div class="mb-4">
                <label for="question_type" class="block text-sm font-medium text-gray-700">Question Type</label>
                <select name="question_type" id="question_type"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required>
                    <option disabled selected>-- Question Type --</option>
                    <option value="multiple_choice">Multiple Choice</option>
                    <option value="true_false">Single Choice (True/False)</option>
                </select>
            </div>

            <!-- Answers Container -->
            <div id="answers-container" class="mb-6 space-y-4">
                <label class="block text-sm font-medium text-gray-700">Answers</label>
                <div id="answer-0" class="flex items-center space-x-2">
                    <input type="text" name="answers[]"
                        class="block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Answer text" required>
                    <input type="checkbox" name="correct_answer[]" value="0"
                        class="h-5 w-5 text-blue-500 focus:ring-blue-500">
                    <span class="text-gray-700">Correct</span>
                    <button type="button"
                        class="ml-4 px-2 py-1 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 remove-answer"
                        data-index="0">Remove</button>
                </div>
            </div>

            <!-- Add Answer Button -->
            <button type="button" id="add-answer"
                class="mt-2 px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                Add Answer
            </button>

            <!-- Submit Button -->
            <div class="mb-4 flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Create Question
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let index = 1; // Start with index 1 as the initial answer has index 0

            document.getElementById('add-answer').addEventListener('click', function() {
                var container = document.getElementById('answers-container');
                var newAnswer = document.createElement('div');
                newAnswer.setAttribute('id', 'answer-' + index);
                newAnswer.setAttribute('class', 'flex items-center space-x-2');
                newAnswer.innerHTML =
                    '<input type="text" name="answers[]" class="block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Answer text" required><input type="checkbox" name="correct_answer[]" value="' +
                    index +
                    '" class="h-5 w-5 text-blue-500 focus:ring-blue-500"><span class="text-gray-700">Correct</span><button type="button" class="ml-4 px-2 py-1 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 remove-answer" data-index="' +
                    index + '">Remove</button>';
                container.appendChild(newAnswer);
                index++;
            });

            document.getElementById('answers-container').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-answer')) {
                    var index = event.target.getAttribute('data-index');
                    var answerToRemove = document.getElementById('answer-' + index);
                    if (answerToRemove) {
                        answerToRemove.remove();
                        // Update remaining answer indices
                        Array.from(document.querySelectorAll('#answers-container .remove-answer')).forEach((
                            btn, i) => {
                            btn.setAttribute('data-index', i);
                            btn.previousElementSibling.setAttribute('value', i);
                        });
                        index = Math.max(index - 1, 0);
                    }
                }
            });
        });
    </script>
@endsection

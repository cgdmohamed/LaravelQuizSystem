@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Question for {{ $quiz->title }}</h1>

    <form action="{{ route('quizzes.questions.update', [$quiz, $question]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Question Text Input -->
        <div class="mb-4">
            <label for="question_text" class="block text-sm font-medium text-gray-700">Question Text</label>
            <input type="text" name="question_text" id="question_text" value="{{ $question->question_text }}"
                class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        </div>

        <!-- Question Type Select -->
        <div class="mb-4">
            <label for="question_type" class="block text-sm font-medium text-gray-700">Question Type</label>
            <select name="question_type" id="question_type"
                class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                <option value="multiple_choice" {{ $question->question_type == 'multiple_choice' ? 'selected' : '' }}>
                    Multiple Choice
                </option>
                <option value="true_false" {{ $question->question_type == 'true_false' ? 'selected' : '' }}> Single Choice (True/False)
                </option>
            </select>
        </div>

        <!-- Answers Section -->
        <div id="answers-container" class="mb-6 space-y-4">
            <label for="answers" class="block text-sm font-medium text-gray-700">Answers</label>
            @foreach ($question->answers as $index => $answer)
                <div id="answer-{{ $index }}" class="flex items-center space-x-4">
                    <input type="text" name="answers[]" value="{{ $answer->answer_text }}"
                        class="block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    <input type="checkbox" name="correct_answer[]" value="{{ $index }}"
                        {{ $answer->is_correct ? 'checked' : '' }} class="h-5 w-5 text-blue-600 focus:ring-blue-500">
                    <label for="correct_answer[]" class="text-sm text-gray-700">Correct</label>
                    <button type="button" class="text-red-500 hover:text-red-600" onclick="removeAnswer({{ $index }})">
                        Remove
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Add Answer Button -->
        <button type="button" id="add-answer"
            class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Add Answer
        </button>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Update Question
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-answer').addEventListener('click', function() {
        var container = document.getElementById('answers-container');
        var index = container.children.length;
        var newAnswer = document.createElement('div');
        newAnswer.setAttribute('id', 'answer-' + index);
        newAnswer.setAttribute('class', 'flex items-center space-x-4');
        newAnswer.innerHTML =
            '<input type="text" name="answers[]" class="block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required><input type="checkbox" name="correct_answer[]" value="' +
            index + '" class="h-5 w-5 text-blue-600 focus:ring-blue-500"><label for="correct_answer[]" class="text-sm text-gray-700">Correct</label><button type="button" class="text-red-500 hover:text-red-600" onclick="removeAnswer(' + index + ')">Remove</button>';
        container.appendChild(newAnswer);
    });

    function removeAnswer(index) {
        var answer = document.getElementById('answer-' + index);
        if (answer) {
            answer.remove();
        }
    }
</script>
@endsection

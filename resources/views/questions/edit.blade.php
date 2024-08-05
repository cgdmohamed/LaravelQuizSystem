@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Edit Question for {{ $quiz->title }}</h1>

        <form action="{{ route('quizzes.questions.update', [$quiz, $question]) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="question_text" class="block text-sm font-medium text-gray-700">Question Text</label>
                <input type="text" name="question_text" id="question_text" value="{{ $question->question_text }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="question_type" class="block text-sm font-medium text-gray-700">Question Type</label>
                <select name="question_type" id="question_type"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="multiple_choice" {{ $question->question_type == 'multiple_choice' ? 'selected' : '' }}>
                        Multiple Choice</option>
                    <option value="true_false" {{ $question->question_type == 'true_false' ? 'selected' : '' }}>True/False
                    </option>
                    <option value="short_answer" {{ $question->question_type == 'short_answer' ? 'selected' : '' }}>Short
                        Answer</option>
                </select>
            </div>

            <div id="answers-container" class="mb-4">
                <label for="answers" class="block text-sm font-medium text-gray-700">Answers</label>
                @foreach ($question->answers as $index => $answer)
                    <div id="answer-{{ $index }}" class="flex items-center mb-2">
                        <input type="text" name="answers[]" value="{{ $answer->answer_text }}"
                            class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <input type="checkbox" name="correct_answer[]" value="{{ $index }}"
                            {{ $answer->is_correct ? 'checked' : '' }} class="ml-2"> Correct
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-answer" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg">Add
                Answer</button>

            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update Question</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-answer').addEventListener('click', function() {
            var container = document.getElementById('answers-container');
            var index = container.children.length;
            var newAnswer = document.createElement('div');
            newAnswer.setAttribute('id', 'answer-' + index);
            newAnswer.setAttribute('class', 'flex items-center mb-2');
            newAnswer.innerHTML =
                '<input type="text" name="answers[]" class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"><input type="checkbox" name="correct_answer[]" value="' +
                index + '" class="ml-2"> Correct';
            container.appendChild(newAnswer);
        });
    </script>
@endsection

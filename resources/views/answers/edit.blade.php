<!-- resources/views/answers/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Edit Answer for {{ $question->question_text }}</h1>
        <form action="{{ route('questions.answers.update', [$question, $answer]) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="answer_text" class="block text-gray-700">Answer:</label>
                <input type="text" name="answer_text" id="answer_text" class="w-full px-4 py-2 border rounded-lg" value="{{ $answer->answer_text }}" required>
            </div>
            <div class="mb-4">
                <label for="is_correct" class="block text-gray-700">Is Correct:</label>
                <input type="checkbox" name="is_correct" id="is_correct" class="mr-2 leading-tight" {{ $answer->is_correct ? 'checked' : '' }}>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update Answer</button>
        </form>
    </div>
@endsection

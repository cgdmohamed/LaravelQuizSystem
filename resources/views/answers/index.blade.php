<!-- resources/views/answers/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Answers for {{ $question->question_text }}</h1>
        <a href="{{ route('questions.answers.create', $question) }}" class="text-blue-500">Add New Answer</a>
        <ul class="mt-4">
            @foreach ($question->answers as $answer)
                <li class="mb-2">
                    {{ $answer->answer_text }} - {{ $answer->is_correct ? 'Correct' : 'Incorrect' }}
                    <a href="{{ route('questions.answers.edit', [$question, $answer]) }}" class="text-blue-500 ml-2">Edit</a>
                    <form action="{{ route('questions.answers.destroy', [$question, $answer]) }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

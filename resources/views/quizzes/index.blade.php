<!-- resources/views/quizzes/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Quizzes</h1>
        <a href="{{ route('quizzes.create') }}" class="text-blue-500">Create New Quiz</a>
        <ul class="mt-4">
            @foreach ($quizzes as $quiz)
                <li class="mb-2">
                    <a href="{{ route('quizzes.show', $quiz) }}" class="text-blue-500">{{ $quiz->title }}</a>
                    <a href="{{ route('quizzes.edit', $quiz) }}" class="text-blue-500 ml-2">Edit</a>
                    <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

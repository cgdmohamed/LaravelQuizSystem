<!-- resources/views/quizzes/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Edit Quiz</h1>
        <form action="{{ route('quizzes.update', $quiz) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title:</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-lg" value="{{ $quiz->title }}" required>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update</button>
        </form>
    </div>
@endsection

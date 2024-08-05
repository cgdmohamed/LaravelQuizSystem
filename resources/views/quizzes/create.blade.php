<!-- resources/views/quizzes/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Create Quiz</h1>
        <form action="{{ route('quizzes.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title:</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Create</button>
        </form>
    </div>
@endsection

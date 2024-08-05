<!-- resources/views/questions/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Questions for {{ $quiz->title }}</h1>
        <a href="{{ route('quizzes.questions.create', $quiz) }}" class="mt-5 px-4 py-2 bg-green-500 text-white rounded-lg">Add Question</a>
        <div class="mt-4">
            @if($questions->isEmpty())
                <p>No questions available.</p>
            @else
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 tracking-wider">Question</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 tracking-wider">Type</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $question->question_text }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ ucfirst(str_replace('_', ' ', $question->question_type)) }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-right">
                                    <a href="{{ route('quizzes.questions.edit', [$quiz, $question]) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection

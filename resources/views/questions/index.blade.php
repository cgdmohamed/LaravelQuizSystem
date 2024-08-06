@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Questions for {{ $quiz->title }}</h1>
            <a href="{{ route('quizzes.questions.create', $quiz) }}"
                class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                Add Question
            </a>
        </div>

        <div class="mt-6">
            @if ($questions->isEmpty())
                <p class="text-gray-500">No questions available.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-medium text-gray-600">
                                    Question</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-medium text-gray-600">
                                    Type</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 border-b border-gray-200 text-sm">{{ $question->question_text }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 text-sm">
                                        {{ ucfirst(str_replace('_', ' ', $question->question_type)) }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200 text-right">
                                        <a href="{{ route('quizzes.questions.edit', [$quiz, $question]) }}"
                                            class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                            Edit
                                        </a>
                                        <form action="{{ route('quizzes.questions.destroy', [$quiz, $question]) }}"
                                            method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-500 text-white rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $quiz->title }}</h1>
        <div class="mb-4 flex justify-end">
            <a href="{{ route('quizzes.questions.index', $quiz) }}"
                class="inline-block px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                View Questions
            </a>
        </div>
        <form action="{{ route('quizzes.submit', $quiz) }}" method="POST" class="space-y-6">
            @csrf

            @foreach ($quiz->questions as $question)
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <label class="block text-lg font-semibold text-gray-800 mb-2">{{ $question->question_text }}</label>

                    @if ($question->question_type == 'multiple_choice')
                        @foreach ($question->answers as $answer)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="answers[{{ $question->id }}][]" value="{{ $answer->id }}"
                                    class="form-checkbox h-4 w-4 text-blue-500 focus:ring-blue-500">
                                <label class="ml-2 text-gray-700">{{ $answer->answer_text }}</label>
                            </div>
                        @endforeach
                    @elseif($question->question_type == 'true_false')
                        @foreach ($question->answers as $answer)
                            <div class="flex items-center mb-2">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}"
                                    class="form-radio h-4 w-4 text-blue-500 focus:ring-blue-500">
                                <label class="ml-2 text-gray-700">{{ $answer->answer_text }}</label>
                            </div>
                        @endforeach
                    @elseif($question->question_type == 'short_answer')
                        <input type="text" name="answers[{{ $question->id }}]"
                            class="block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @endif
                </div>
            @endforeach

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection

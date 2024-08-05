@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold">{{ $quiz->title }}</h1>
    <a href="{{ route('quizzes.questions.index', $quiz) }}" class="text-blue-500">View Questions</a>

    <form action="{{ route('quizzes.submit', $quiz) }}" method="POST" class="mt-4">
        @csrf
        @foreach($quiz->questions as $question)
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">{{ $question->question_text }}</label>
                @if($question->question_type == 'multiple_choice')
                    @foreach($question->answers as $answer)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="answers[{{ $question->id }}][]" value="{{ $answer->id }}" class="mr-2">
                            <label class="text-gray-700">{{ $answer->answer_text }}</label>
                        </div>
                    @endforeach
                @elseif($question->question_type == 'true_false')
                    @foreach($question->answers as $answer)
                        <div class="flex items-center mb-2">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="mr-2">
                            <label class="text-gray-700">{{ $answer->answer_text }}</label>
                        </div>
                    @endforeach
                @elseif($question->question_type == 'short_answer')
                    <input type="text" name="answers[{{ $question->id }}]" class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @endif
            </div>
        @endforeach

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Submit Quiz</button>
        </div>
    </form>
</div>
@endsection

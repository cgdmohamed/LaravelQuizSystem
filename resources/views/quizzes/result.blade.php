@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Quiz Result</h1>
        <p class="text-lg text-gray-700">Your score: <span class="font-semibold text-blue-600">{{ $score }}%</span></p>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Detailed Results</h2>
            <ul class="space-y-6">
                @foreach ($user_results as $result)
                    <li class="border p-4 rounded-lg shadow-sm bg-gray-50">
                        <p class="text-lg font-medium text-gray-800 mb-2">{{ $result['question_text'] }}</p>
                        <p class="text-sm text-gray-600 mb-2">Your Answer:
                            @if (is_array($result['user_answer']))
                                @foreach ($result['user_answer'] as $answer)
                                    <span
                                        class="inline-block bg-gray-200 text-gray-800 px-2 py-1 rounded-full">{{ $answer }}</span>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @else
                                <span
                                    class="inline-block bg-gray-200 text-gray-800 px-2 py-1 rounded-full">{{ $result['user_answer'] }}</span>
                            @endif
                        </p>
                        @if (!$result['is_correct'])
                            <p class="text-red-500 mb-2">Correct Answer:
                                @if (is_array($result['correct_answer']))
                                    @foreach ($result['correct_answer'] as $answer)
                                        <span
                                            class="inline-block bg-gray-200 text-gray-800 px-2 py-1 rounded-full">{{ $answer }}</span>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                @else
                                    <span
                                        class="inline-block bg-gray-200 text-gray-800 px-2 py-1 rounded-full">{{ $result['correct_answer'] }}</span>
                                @endif
                            </p>
                        @endif
                        <p
                            class="{{ $result['is_correct'] ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                            {{ $result['is_correct'] ? 'Correct' : 'Incorrect' }}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

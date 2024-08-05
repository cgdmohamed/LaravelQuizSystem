@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold">Quiz Result</h1>
    <p class="mt-2">Your score: {{ $score }}%</p>

    <div class="mt-4">
        <h2 class="text-xl font-semibold">Detailed Results</h2>
        <ul class="mt-2">
            @foreach ($user_results as $result)
                <li class="mb-4">
                    <p class="text-lg font-medium">{{ $result['question_text'] }}</p>
                    <p>Your Answer: 
                        @if(is_array($result['user_answer']))
                            @foreach($result['user_answer'] as $answer)
                                {{ $answer }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            {{ $result['user_answer'] }}
                        @endif
                    </p>
                    @if (!$result['is_correct'])
                        <p class="text-red-500">Correct Answer: 
                            @if(is_array($result['correct_answer']))
                                @foreach($result['correct_answer'] as $answer)
                                    {{ $answer }}@if(!$loop->last), @endif
                                @endforeach
                            @else
                                {{ $result['correct_answer'] }}
                            @endif
                        </p>
                    @endif
                    <p class="{{ $result['is_correct'] ? 'text-green-500' : 'text-red-500' }}">
                        {{ $result['is_correct'] ? 'Correct' : 'Incorrect' }}
                    </p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

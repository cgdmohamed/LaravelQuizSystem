<!-- resources/views/questions/types/multiple_choice.blade.php -->
<div class="mb-4">
    <p class="font-semibold">{{ $question->question_text }}</p>
    @foreach ($question->answers as $answer)
        <label class="block">
            <input type="checkbox" name="answers[{{ $question->id }}][]" value="{{ $answer->id }}" class="mr-2">{{ $answer->answer_text }}
        </label>
    @endforeach
</div>

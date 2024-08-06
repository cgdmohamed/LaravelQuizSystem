<!-- resources/views/questions/types/multiple_choice.blade.php -->
<div class="mb-6 p-4 border border-gray-300 rounded-lg bg-white shadow-sm">
    <p class="text-lg font-semibold mb-2">{{ $question->question_text }}</p>
    <div class="space-y-2">
        @foreach ($question->answers as $answer)
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="answers[{{ $question->id }}][]" value="{{ $answer->id }}"
                    class="form-checkbox h-5 w-5 text-blue-500 focus:ring-blue-500">
                <span class="text-gray-700">{{ $answer->answer_text }}</span>
            </label>
        @endforeach
    </div>
</div>

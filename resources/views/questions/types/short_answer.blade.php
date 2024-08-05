<!-- resources/views/questions/types/short_answer.blade.php -->
<div class="mb-4">
    <p class="font-semibold">{{ $question->question_text }}</p>
    <input type="text" name="answers[{{ $question->id }}]" class="w-full px-4 py-2 border rounded-lg">
</div>

<!-- resources/views/questions/types/true_false.blade.php -->
<div class="mb-4">
    <p class="font-semibold">{{ $question->question_text }}</p>
    <label class="block">
        <input type="radio" name="answers[{{ $question->id }}]" value="1" class="mr-2">True
    </label>
    <label class="block">
        <input type="radio" name="answers[{{ $question->id }}]" value="0" class="mr-2">False
    </label>
</div>

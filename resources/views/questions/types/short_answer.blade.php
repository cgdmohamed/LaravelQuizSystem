<!-- resources/views/questions/types/short_answer.blade.php -->
<div class="mb-6 p-4 border border-gray-300 rounded-lg bg-white shadow-sm">
    <p class="text-lg font-semibold mb-4">{{ $question->question_text }}</p>
    <input type="text" name="answers[{{ $question->id }}]"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        placeholder="Type your answer here">
</div>

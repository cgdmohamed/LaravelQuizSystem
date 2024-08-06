<!-- resources/views/questions/types/true_false.blade.php -->
<div class="mb-6 p-4 border border-gray-300 rounded-lg bg-white shadow-sm">
    <p class="text-lg font-semibold mb-4">{{ $question->question_text }}</p>
    <div class="space-y-2">
        <label class="flex items-center space-x-2">
            <input type="radio" name="answers[{{ $question->id }}]" value="1"
                class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-500">
            <span class="text-gray-700">True</span>
        </label>
        <label class="flex items-center space-x-2">
            <input type="radio" name="answers[{{ $question->id }}]" value="0"
                class="form-radio h-5 w-5 text-blue-500 focus:ring-blue-500">
            <span class="text-gray-700">False</span>
        </label>
    </div>
</div>

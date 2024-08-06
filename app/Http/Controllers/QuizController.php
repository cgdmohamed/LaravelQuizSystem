<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Services\QuizService;
use App\Exports\QuestionsExport;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Exports\QuestionsTemplateExport;



class QuizController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function index()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $quiz = Quiz::create($request->all());
        return redirect()->route('quizzes.index');
    }

    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $quiz->update($request->all());
        return redirect()->route('quizzes.index');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index');
    }
    public function showQuiz(Quiz $quiz)
    {
        return view('quizzes.take', compact('quiz'));
    }

    public function submitQuiz(Request $request, Quiz $quiz)
    {
        $result = $this->quizService->calculateQuizResult($request, $quiz);

        // Save the user's quiz result if needed

        return view('quizzes.result', [
            'score' => $result['score'],
            'user_results' => $result['user_results'],
        ]);
    }
    public function indexQuestions(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('questions.index', compact('quiz', 'questions'));
    }

    public function createQuestion(Quiz $quiz)
    {
        return view('questions.create', compact('quiz'));
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $this->quizService->storeQuestion($request, $quiz);

        return redirect()->route('quizzes.questions.index', $quiz)->with('success', 'Question created successfully');
    }

    public function editQuestion(Quiz $quiz, Question $question)
    {
        return view('questions.edit', compact('quiz', 'question'));
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $this->quizService->updateQuestion($request, $quiz, $question);

        return redirect()->route('quizzes.questions.index', $quiz)->with('success', 'Question updated successfully');
    }

    /**
     * Import and export methods
     */
    public function export()
    {
        return Excel::download(new QuestionsExport, 'questions.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new QuestionsImport, $request->file('file'));

        return back()->with('success', 'Questions imported successfully.');
    }
    public function showImportForm()
    {
        return view('quizzes.import');
    }

    public function downloadTemplate()
    {
        return Excel::download(new QuestionsTemplateExport, 'questions_template.xlsx');
    }
}

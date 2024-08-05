<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-white p-4 shadow-md">
        <div class="container mx-auto">
            <a href="{{ route('quizzes.index') }}" class="text-blue-500">Quizzes</a>
        </div>
    </nav>
    <nav class="bg-gray-800 p-2">
        <div class="container mx-auto flex justify-between">
            <div class="flex space-x-4">
                <!-- Primary Navigation Links -->
                <a href="{{ url('/') }}" class="text-white">Home</a>
                <a href="{{ route('quizzes.index') }}" class="text-white">Quizzes</a>
                <a href="{{ route('quizzes.create') }}" class="text-white">Create Quiz</a>
                <a href="{{ route('quizzes.export') }}" class="text-white">Export Questions</a>
                <a href="{{ route('quizzes.import') }}" class="text-white">Import Questions</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>

</html>

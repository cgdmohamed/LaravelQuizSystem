<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles can go here */
        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex items-center justify-between p-4">
            <a href="{{ route('quizzes.index') }}" class="text-blue-500 font-bold text-lg">Quiz App</a>
            <div class="flex space-x-4">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 nav-link">Home</a>
                <a href="{{ route('quizzes.index') }}" class="text-gray-700 hover:text-blue-600 nav-link">Quizzes</a>
                <a href="{{ route('quizzes.create') }}" class="text-gray-700 hover:text-blue-600 nav-link">Create
                    Quiz</a>
                <a href="{{ route('quizzes.export') }}" class="text-gray-700 hover:text-blue-600 nav-link">Export
                    Questions</a>
                <a href="{{ route('quizzes.showImportForm') }}"
                    class="text-gray-700 hover:text-blue-600 nav-link">Import Questions</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Quiz Application. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>

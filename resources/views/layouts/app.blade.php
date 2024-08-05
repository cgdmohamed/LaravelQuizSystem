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
    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>

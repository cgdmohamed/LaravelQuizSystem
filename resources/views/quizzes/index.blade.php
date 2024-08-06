<!-- resources/views/quizzes/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Quizzes</h1>
        <div class="mb-4 flex justify-end">
            <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <a href="{{ route('quizzes.create') }}"
                    class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Create New Quiz
                </a>
        </div>
        <div class="container mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Quesitons
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($quizzes as $quiz)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $quiz->title }}</td>
                                <td class="ml-4 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $quiz->created_at->format('Y-m-d') }}</td>
                                <td class="ml-4 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                        {{ $quiz->questions_count }} Question(s)
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ route('quizzes.show', $quiz->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Show</a>
                                    <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                        class="ml-4 text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <a href="{{ route('quizzes.destroy', $quiz->id) }}"
                                        class="ml-4 text-red-600 hover:text-red-900">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Import Questions</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Download Template Button -->
    <div class="mb-6">
        <a href="{{ route('quizzes.downloadTemplate') }}"
            class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Download Template
        </a>
    </div>

    <!-- Import Form -->
    <form action="{{ route('quizzes.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- File Upload -->
        <div>
            <label for="file" class="block text-sm font-medium text-gray-700">Excel File</label>
            <input type="file" name="file" id="file"
                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                required>
        </div>
        
        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Import
            </button>
        </div>
    </form>
</div>
@endsection

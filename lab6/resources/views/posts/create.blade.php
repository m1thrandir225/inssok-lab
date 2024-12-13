<!-- resources/views/posts/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Post</h1>

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                @include('posts.form', ['categories' => $categories])

                <div class="mt-6 flex justify-end space-x-4">
                    <a
                        href="{{ route('posts.index') }}"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300"
                    >
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

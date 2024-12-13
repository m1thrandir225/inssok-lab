<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $post->title }}</h1>
                <div class="text-gray-600 text-sm">
                    <span>Category: {{ $post->category->name }}</span>
                    <span class="mx-2">|</span>
                    <span>Published: {{ $post->created_at->format('F d, Y') }}</span>
                </div>
            </div>

            <div class="prose max-w-none">
                {!! nl2br(e($post->body)) !!}
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <a
                    href="{{ route('posts.edit', $post) }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300"
                >
                    Edit Post
                </a>
                <a
                    href="{{ route('posts.index') }}"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300"
                >
                    Back to Posts
                </a>
            </div>
        </div>
    </div>
@endsection

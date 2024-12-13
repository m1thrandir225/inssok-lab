<!-- resources/views/categories/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Category Details</h1>
                    <div class="space-x-2">
                        <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Are you sure you want to delete this category?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Category Name</label>
                    <p class="text-gray-900 text-lg">{{ $category->name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
                    <p class="text-gray-900">{{ $category->slug }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Created At</label>
                    <p class="text-gray-900">{{ $category->created_at->format('F d, Y H:i A') }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Updated At</label>
                    <p class="text-gray-900">{{ $category->updated_at->format('F d, Y H:i A') }}</p>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Posts in this Category</h2>

                    @if($category->posts->count() > 0)
                        <div class="bg-gray-50 rounded-lg">
                            <table class="w-full">
                                <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="px-4 py-2 text-gray-600">Title</th>
                                    <th class="px-4 py-2 text-gray-600">Published At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category->posts as $post)
                                    <tr class="border-b last:border-b-0">
                                        <td class="px-4 py-2">
                                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $post->title }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-2 text-gray-700">
                                            {{ $post->created_at->format('F d, Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-600 italic">No posts found in this category.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                ← Back to Categories
            </a>
        </div>
    </div>
@endsection

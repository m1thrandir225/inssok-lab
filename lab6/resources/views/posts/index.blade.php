<!-- resources/views/posts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="category_id" class="form-control" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Posts</h1>
            <a
                href="{{ route('posts.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300"
            >
                Create New Post
            </a>
        </div>

        @if(count($posts) < 0)
            <div class="bg-gray-100 p-4 rounded-md text-center text-gray-600">
                No posts found. Create your first post!
            </div>
        @else
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created At
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posts as $post)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $post->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post->category->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a
                                        href="{{ route('posts.show', $post) }}"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        View
                                    </a>
                                    <a
                                        href="{{ route('posts.edit', $post) }}"
                                        class="text-green-600 hover:text-green-900"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        action="{{ route('posts.destroy', $post) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @endif
    </div>
@endsection

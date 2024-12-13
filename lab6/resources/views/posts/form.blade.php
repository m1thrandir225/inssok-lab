<!-- resources/views/posts/form.blade.php -->
<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $post->title ?? '') }}"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        >
        @error('title')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
        <select
            name="category_id"
            id="category_id"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        >
            <option value="">Select a Category</option>
            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ (old('category_id', $post->category_id ?? '') == $category->id) ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="body" class="block text-sm font-medium text-gray-700">Content</label>
        <textarea
            name="body"
            id="body"
            rows="6"
            required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        >{{ old('body', $post->body ?? '') }}</textarea>
        @error('body')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

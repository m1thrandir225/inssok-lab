<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $posts = Post::query()
            ->with('category')
            ->when(
                $request->get('category_id') !== null,
                fn ($query) => $query->where('category_id', $request->get('category_id'))
            )
            ->latest()
            ->paginate(100);

        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:50|max:2000',
            'category_id' => 'required|integer|exists:categories,id',
        ]);
        Post::query()->create($validated);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:50|max:2000',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->route('posts.index');
    }
}

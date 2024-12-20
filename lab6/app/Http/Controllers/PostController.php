<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $postRepository;
    protected $categoryRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $posts = $request->get('category_id')
            ? $this->postRepository->findByCategory($request->get('category_id'), 100)
            : $this->postRepository->paginate(100);

        $categories = $this->categoryRepository->all();

        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->categoryRepository->all();
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

        $this->postRepository->create($validated);

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
        $categories = $this->categoryRepository->all();
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

        $this->postRepository->update($post, $validated);

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $this->postRepository->delete($post);
        return redirect()->route('posts.index');
    }
}

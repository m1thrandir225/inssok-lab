<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;

    }
    public function index(Request $request)
    {
        //
        $categories = $request->has('search')
            ? $this->categoryRepository->search($request->get('search'))
            : $this->categoryRepository->paginate(100);

        return view('categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryRepository->create($validated);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryRepository->update($category, $validated);

        return redirect()->route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $this->categoryRepository->delete($category);
        return redirect()->route('categories.index');
    }
}

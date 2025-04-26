<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $CategoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository ){
        $this->CategoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->CategoryRepository->all();
        return view('Admin.categories.category',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $this->CategoryRepository->create($request->validated());
            return redirect()->route('category.index')->with('success', 'Category Added successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to add category');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->CategoryRepository->find($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = $this->CategoryRepository->find($id);
        return view('Admin.categories.update',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $result = $this->CategoryRepository->update($id, $request->validated());
        if ($result) {
            return redirect()->route('category.index')->with('success', 'Category updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->CategoryRepository->delete($id);
        return response()->json(['success' => 'Category deleted successfully']);
        // return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}

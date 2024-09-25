<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('articles')->paginate(5);

         if(request()->filled('page') && request()->input('page') > $categories->lastPage()){

            return redirect()->route('categories.index', ['page' => $categories->lastPage()])->with('message', 'Type deleted successfully');
         }
         
       return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create', ['page' => request()->query('page')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index', ['page' => request()->query('page')])->with('message', 'Category ' . $request->validated('type') .' is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $page = request('page');


        return view('categories.edit', compact('category', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index', ["page" => $request->page])->with('message', 'The category is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $page = request()->query('page');


        return redirect()->route('categories.index', ['page' => $page])->with('message', 'The category is deleted successfully');
    }
}

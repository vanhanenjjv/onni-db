<?php

namespace OWS\Http\Controllers\Categories;

use OWS\Category;
use OWS\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(30);

        return view('categories.all')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Show view for adding new categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        return view('categories.new');
    }

    /**
     * Store new categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|min:1'
        ]);

        $category = new Category;
        $category->category = $request->category;
        $category->save();

        return redirect()
            ->route('category.all')
            ->with([
                'status' => 200,
                'message' => 'Category added'
            ]);
    }

    /**
     * Edit categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($category, Request $request)
    {
        $category = Category::findOrFail($category);
        return view('categories.edit')
            ->with([
                'category' => $category,
            ]);
    }

    /**
     * Update categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($category, Request $request)
    {
        $this->validate($request, [
            'category' => 'required|min:1',
        ]);

        $category = Category::findOrFail($category);

        // update question
        $category->category = $request->category;
        $category->save();

        return redirect()
            ->route('category.edit', ['category' => $category->id])
            ->with([
                'status' => 200,
                'message' => 'Category updated',
                'category' => $category,
            ]);
    }

    /**
     * Delete category.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($category, Request $request)
    {
        $category = Category::findOrFail($category);
        return view('categories.delete')
            ->with([
                'category' => $category
            ]);
    }

    /**
     * Delete category.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($category, Request $request)
    {
        Category::destroy($category);
        return redirect()
            ->route('category.all')
            ->with([
                'status' => 200,
                'message' => 'Category deleted'
            ]);
    }
}

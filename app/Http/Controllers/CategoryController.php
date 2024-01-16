<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{

    // index
    public function index(Request $request)
    {
        // get user with paginantin
        $categories = DB::table('categories')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->paginate(5);
        return view('pages.category.index', compact('categories'));
    }

    // create
    public function create()
    {
        return view('pages.category.create');
    }

    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $category = \App\Models\Category::create($validated);

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    // edit
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Change variable name to $category
        return view('pages.category.edit', compact('category'));
    }

    // update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $category = \App\Models\Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}

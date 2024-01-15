<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // index
    public function index(Request $request)
    {
        $categories = \App\Models\Category::paginate(5);
        return view('pages.category.index', compact('categories'));
    }

    // create
    public function create()
    {
        return view('pages.category.create');
    }

    // store
    public function store(Request $request)
    {
        $data = $request->all();
        Category::create($data);
        return redirect()->route('category.index');
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
        $data = $request->all();
        $categories = Category::findOrFail($id);
        //check if password is not empty
        $categories->update($data);
        return redirect()->route('category.index');
    }

    // destroy
    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->route('category.index');
    }
}

<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        $input = $request->except('_token');
        $input['slug'] = getSlug($request->name);
        $category = Category::create($input);
        return response()->json($category);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $input = $request->except('_token');
        $input['slug'] = getSlug($request->name);
        $category->update($input);
        return response()->json('Category updated');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json('Category deleted');
    }
}

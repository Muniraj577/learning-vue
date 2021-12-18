<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }
        if($validator->passes()){
            $input = $request->except('_token');
            $input['slug'] = getSlug($request->name);
            $category = Category::create($input);
            return response()->json(['success' => true, 'message' => 'Category created successfully']);
        }
        
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            "name" => ["required", "unique:categories,name,".$id],
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()]);
        }
        if($validator->passes()){
            $category = Category::find($id);
            $input = $request->except('_token');
            $input['slug'] = getSlug($request->name);
            $category->update($input);
            return response()->json(['success' => true, 'message' => 'Category updated']);
        }
        
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json('Category deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin\API;

use App\Contracts\CategoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        $categories = $this->categoryRepository->getCategories();
        // $categories = Category::latest()->get();
        return response()->json(["success"=>true,"categories"=>$categories]);
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }
        if($validator->passes()){
            $category = $this->categoryRepository->store($request);
            return response()->json(['success' => true, 'message' => 'Category created successfully']);
        }
        
        
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
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
            $category = $this->categoryRepository->update($request, $id);
            return response()->json(['success' => true, 'message' => 'Category updated']);
        }
        
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return response()->json(['success'=>true, 'message' => 'Category deleted']);
    }

    public function getAllCategories()
    {
        $categories = $this->categoryRepository->allCategories();
        return response()->json($categories);
    }
}

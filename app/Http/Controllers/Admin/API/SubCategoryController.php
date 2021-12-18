<?php

namespace App\Http\Controllers\Admin\API;

use App\Contracts\CategoryInterface;
use App\Contracts\SubCategoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    private $categoryRepository;
    private $subcategoryRepository;

    public function __construct(CategoryInterface $categoryRepository, SubCategoryInterface $subcategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
    }

    public function index()
    {
        $subcategories = $this->subcategoryRepository->getSubCategories();
        return response()->json(["success"=>true, 'subcategories'=>$subcategories]);
    }

    public function create()
    {
        $categories = $this->categoryRepository->allCategories();
        return response()->json(["success"=>true, "categories" => $categories]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "category_id" => ["required"],
            "name" => ["required", "unique:sub_categories,name"],
        ]);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()]);
        }

        if($validator->passes()){
            try{
                DB::beginTransaction();
                $this->subcategoryRepository->store($request);
                DB::commit();
                return response()->json(["success"=>true,"message"=>"Subcategory created successfully"]);
            } catch(\Exception $e){
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $subcategory = $this->subcategoryRepository->find($id);
        return response()->json(['subcategory' => $subcategory, 'success' => true]);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $this->subcategoryRepository->delete($id);
        return response()->json(["success"=> true, "message" => "Subcategory deleted successfully"]);
    }
}

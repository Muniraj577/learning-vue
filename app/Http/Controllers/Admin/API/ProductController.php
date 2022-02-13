<?php

namespace App\Http\Controllers\Admin\API;

use App\Contracts\ProductInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getProductWithCat();
        return response()->json(["success"=>true, "products"=>$products]);
    }

    public function store(Request $request)
    {
        // return response()->json($request->file('image'));
        // die();
        $validator = Validator::make($request->all(),[
            "category_id" => ["required"],
            "title" => ["required", "unique:products,title"],
            "image" => ["nullable", "mimes:jpg,png,jpeg", "max:2048"],
            "price" => ["required", "numeric"],
        ]);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()]);
        }

        if($validator->passes()){
            try{
                DB::beginTransaction();
                $product = $this->productRepository->store($request);
                DB::commit();
                return response()->json(["success"=>true, "message"=>"Product created successfully"]);
            } catch(\Exception $e){
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        return response()->json(["success"=>true, "product" => $product]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            "category_id" => ["required"],
            "title" => ["required", "unique:products,title,".$id],
            "image" => ["nullable", "mimes:jpeg,jpg,png","max:2048"],
            "price" => ["required", "numeric"],
        ]);
        if($validator->fails()){
            return response()->json(["errors"=>$validator->errors()]);
        }

        if($validator->passes()){
            try{
                DB::beginTransaction();
                $product = $this->productRepository->update($request, $id);
                DB::commit();
                return response()->json(["success"=>true, "message"=>"Product updated successfully"]);
            } catch(\Exception $e){
                DB::rollBack();
                return response()->json(["db_error"=>$e->getMessage()]);
            }
        }
    }


    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return response()->json(["success"=>true,"message"=>"Product deleted successfully"]);
    }
}

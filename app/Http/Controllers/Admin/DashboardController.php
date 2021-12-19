<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SubCategoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $subcategoryRepository;

    public function __construct(SubCategoryInterface $subcategoryRepository)
    {
        $this->subcategoryRepository = $subcategoryRepository;
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function filterSubCatByCategory(Request $request)
    {
        // return response()->json(["success"=>true, "request"=>$request->category_id]);
        $subcategories = $this->subcategoryRepository->filterSubCatByCategory($request);
        return response()->json(["success"=> true, "subcategories" => $subcategories]);
    }
}

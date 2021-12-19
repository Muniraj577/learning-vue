<?php 

namespace App\Repositories\Admin;

use App\Contracts\SubCategoryInterface;
use App\Models\SubCategory;

class SubCategoryRepository implements SubCategoryInterface{

    public function getSubCategories()
    {
        return SubCategory::latest()->get();
    }

    public function subcatwithCategory()
    {
        return SubCategory::with('category')->latest()->get();
    }

    public function store($data)
    {
        $input = $data->except('_token');
        $input['slug'] = getSlug($data->name);
        return SubCategory::create($input);
    }

    public function find($id)
    {
        return SubCategory::findOrFail($id);
    }

    public function update($data, $id)
    {
        $subcategory = SubCategory::find($id);
        $input = $data->except('_token');
        $input['slug'] = getSlug($data->name);
        return $subcategory->update($input);
    }


    public function delete($id)
    {
        return SubCategory::find($id)->delete();
    }


    public function filterSubCatByCategory($data)
    {
        return SubCategory::where("category_id", $data->category_id)->get();
    }


}
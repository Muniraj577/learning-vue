<?php

namespace App\Repositories\Admin;

use App\Contracts\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{

    public function getCategories()
    {
        $categories = Category::latest()->get();
        return $categories;
    }

    public function allCategories()
    {
        return Category::all();
    }

    public function store($data)
    {

        $input = $data->except('_token');
        $input['slug'] = getSlug($data->name);
        $category = Category::create($input);
        return $category;

    }

    public function find($id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    public function update($data, $id)
    {
        $category = Category::find($id);
        $input = $data->except('_token');
        $input['slug'] = getSlug($data->name);
        return $category->update($input);

    }

    public function delete($id)
    {
        return Category::destroy($id);
    }

}

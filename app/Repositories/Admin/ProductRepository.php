<?php

namespace App\Repositories\Admin;

use App\Contracts\ProductInterface;
use App\Models\Product;
use App\Models\Upload;

class ProductRepository implements ProductInterface
{
    private $destination = "images/products/";

    public function getProducts()
    {
        return Product::latest()->get();
    }

    public function getProductWithCat()
    {
        return Product::with(["category", "subcategory"])->latest()->get();
    }

    public function store($data)
    {
        $input = $data->except("_token");
        $input["slug"] = getSlug($data->title);
        if($data->hasFile('image')){
            $input["image"] = Upload::image($data, "image", $this->destination, null);
        }
        return Product::create($input);
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function update($data, $id)
    {
        $product = $this->find($id);
        $input = $data->except("_token");
        $oldImage = $product->image;
        $input['slug'] = getSlug($data->title);
        if($data->hasFile('image')){
            $input["image"] = Upload::image($data, "image", $this->destination, $oldImage);
        }
        return $product->update($input);
    }

    public function delete($id)
    {
        return Product::find($id)->delete();
    }
}

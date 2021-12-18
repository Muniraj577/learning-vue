<?php

namespace App\Contracts;

interface ProductInterface{
    public function getProducts();
    public function getProductWithCat();
    public function store($data);
    public function find($id);
    public function update($data, $id);
    public function delete($id);
}
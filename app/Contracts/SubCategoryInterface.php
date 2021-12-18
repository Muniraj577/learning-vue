<?php

namespace App\Contracts;

interface SubCategoryInterface{
    public function getSubCategories();
    public function store($data);
    public function find($id);
    public function update($data, $id);
    public function delete($id);
}
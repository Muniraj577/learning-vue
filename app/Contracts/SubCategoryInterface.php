<?php

namespace App\Contracts;

interface SubCategoryInterface{
    public function getSubCategories();
    public function subcatwithCategory();
    public function store($data);
    public function find($id);
    public function update($data, $id);
    public function delete($id);
    public function filterSubCatByCategory($data);
}
<?php 

namespace App\Contracts;

interface CategoryInterface{

    public function getCategories();
    public function store($data);
    public function find($id);
    public function update($data, $id);
    public function delete($id);
}
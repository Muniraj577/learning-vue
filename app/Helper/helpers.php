<?php 

if(!function_exists('getSlug')){
    function getSlug($name)
    {
        return Illuminate\Support\Str::slug($name);
    }
}
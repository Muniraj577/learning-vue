<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Image;

class Upload extends Model
{
    use HasFactory;


    static function image($request, $filename, $path, $oldImage = null)
    {
        $_this = new self;
        $_this->__createDirectory($path);
        $image = $request->$filename;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        if($oldImage != null && file_exists($path.$oldImage) && $oldImage != 'default.png'){
            unlink($path.$oldImage);
        }
        $image->move($path, $imageName);
        return $imageName;
    }

    static function resizeImage($request, $filename, $path, $h, $w)
    {
        $_this = new self;
        $_this->createDirectory($path);
        $image = $request->file($filename);
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize($h, $w)->save($path . $imageName);
        return $imageName;
    }


    private function __createDirectory($path)
    {
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
    }
}

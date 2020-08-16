<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

use InterImage;
use Storage; 

class ImageController extends Controller
{
    public function crop($folder, $width, $height, $name)
    {
        try 
        {
            $path = storage_path().'/app/'. $folder .'/' . $name;
            // dd($path);
            $img = InterImage::make($path)->fit($width, $height); 
        }
        catch(\Exception $e)
        {
            $imgPath = '/trash/noimg.png';
            $path = base_path() . $imgPath;  
            $img = InterImage::make($path)->fit($width, $height);
        }

        return $img->response('jpg');
    }

    public function resize($folder, $width, $height, $name)
    {
        try 
        {
            $path = storage_path().'/app/'. $folder .'/' . $name;
            $img = InterImage::make($path)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->resizeCanvas($width, $height, 'center', false, '#cccccc');
        }
        catch(\Exception $e)
        {
            $img = InterImage::make(storage_path().'/app/noimg.png');
        }

        return $img->response('jpg');
    }

    public function full(Request $request, $folder, $name)
    {   
        try
        {
            $path = storage_path().'/app/'. $folder .'/' . $name; 
            $img = InterImage::make($path); 
        }
        catch(\Exception $e)
        { 

            $imgPath = '/trash/noimg.png';
            if($folder == 'groups') 
            {
                $imgPath = '/trash/group.png';
            } 

            $path = base_path() . $imgPath;  

            $img = InterImage::make($path);
        }

        return $img->response('jpg');
    }
}

 

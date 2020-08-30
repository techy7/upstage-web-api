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
            $img = InterImage::make($path)->fit($width, $height); 
        }
        catch(\Exception $e)
        {
            $path = storage_path().'/app/public/nophoto.png';
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
            $img = InterImage::make(storage_path().'/app/public/nophoto.png');
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

            $img = InterImage::make(storage_path().'/app/public/nophoto.png');
        }

        return $img->response('jpg');
    }

    public function download(Request $request, $folder, $name)
    {   
        if(Storage::exists($folder .'/' . $name)) {
            return Storage::download($folder .'/' . $name);    
        } else {
            return 'File not found';
        } 
    }
}

 

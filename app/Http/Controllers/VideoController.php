<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Storage; 
use File;
use Response;

class VideoController extends Controller
{
    public function show($folder, $filename)
    {
        $path = storage_path("app/$folder/") . $filename; 

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public static function watch(Request $request, $folder, $filename) 
    {
        $path = storage_path("app/$folder/") . $filename; 
        $file = Storage::disk('local')->get($folder.'/'.$filename); 
        $size = Storage::disk('local')->size($folder.'/'.$filename);
        $stream = fopen($path, "r");

        $type = File::mimeType($path);
        $start = 0;
        $length = $size;
        $status = 200;

        $headers = ['Content-Type' => $type, 'Content-Length' => $size, 'Accept-Ranges' => 'bytes'];

        if (false !== $range = $request->server('HTTP_RANGE', false)) {
            list($param, $range) = explode('=', $range);

            if (strtolower(trim($param)) !== 'bytes') {
                header('HTTP/1.1 400 Invalid Request');
                exit;
            }
            list($from, $to) = explode('-', $range);
            if ($from === '') {
                $end = $size - 1;
                $start = $end - intval($from);
            } elseif ($to === '') {
                $start = intval($from);
                $end = $size - 1;
            } else {
                $start = intval($from);
                $end = intval($to);
            }

            $length = $end - $start + 1;
            $status = 206;
            $headers['Content-Range'] = sprintf('bytes %d-%d/%d', $start, $end, $size);
        }

        return Response::stream(function() use ($stream, $start, $length) {
                fseek($stream, $start, SEEK_SET);
                echo fread($stream, $length);
                fclose($stream);
            }, $status, $headers);
    }

    public function download(Request $request, $folder, $name)
    {   
        if(Storage::exists($folder .'/' . $name)) {
            return Storage::download($folder .'/' . $name, 'ssss');    
        } else {
            return 'File not found';
        } 
    }
}

 

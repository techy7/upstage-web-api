<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;  
use App\Template; 

class TemplateController extends Controller
{
    /**
     * Fetch user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $strKeywords = $request->input('q', null); 
        $type = $request->input('type', null);
        $cat = $request->input('category', null);
        
        $templates = Template::ofKeywords($strKeywords)
            ->ofType($type)
            ->ofCategory($cat)
            ->orderBy('type', 'asc')
            ->get(); 

        $templates->transform(function ($template) {
            $folderUrl = strpos($template->mimetype, 'image') !== false ? 'image' : 'video';
            $thumb = strpos($template->mimetype, 'image') !== false ? env('APP_URL').'/image/presentations/150/150/'.$template->filename : null;

            $objFile = array(
                "filename" => $template->filename,
                "mimetype" => $template->mimetype,
                "file_url" => env('APP_URL').'/'.$folderUrl.'/presentations/'.$template->filename,
                "thumbnail_url" => $thumb
            );

            return array(
                "name" => $template->name,
                "description" => $template->description, 
                "category" => $template->category,
                "type" => $template->type,  
                "id" => $template->id, 
                "file" => $objFile
            ); 
        });

        return response()->json([
            'results' => $templates,
            'meta' => [
                'current_filters' => array('type'=>$type, 'category'=>$cat),
                'types' => Template::TYPES,
                'types_categories' => Template::OPTIONS,
            ]
        ]);
    }

    /**
     * Fetch user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    { 
        $folderUrl = strpos($template->mimetype, 'image') !== false ? 'image' : 'video';
        $thumb = strpos($template->mimetype, 'image') !== false ? env('APP_URL').'/image/presentations/150/150/'.$template->filename : null;

        $objFile = array(
            "filename" => $template->filename,
            "mimetype" => $template->mimetype,
            "file_url" => env('APP_URL').'/'.$folderUrl.'/presentations/'.$template->filename,
            "thumbnail_url" => $thumb
        );
        
        return array(
            "name" => $template->name,
            "description" => $template->description, 
            "category" => $template->category,
            "type" => $template->type,  
            "id" => $template->id, 
            "file" => $objFile
        ); 
    }
}

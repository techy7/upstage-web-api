<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use App\Http\Requests\TemplateRequest;
use App\Http\Requests\TemplateEditRequest;
use Illuminate\Support\Str; 

class TemplateController extends Controller
{
    protected $exceptData = [
        'id',
        'hash',
        'slug',
        'created_at',
        'updated_at'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('templates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $options = Template::OPTIONS; 
        $types = Template::TYPES; 
        $template = new Template([
            'name' => '',
            "description" => '',
            "category" => '',
            "type" => ''
        ]);


        return view('templates.create', compact('template', 'options', 'types'));
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        return view('templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        $options = Template::OPTIONS; 
        $types = Template::TYPES; 
        
        return view('templates.edit', compact('template', 'options', 'types'));
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $template
     * @return \Illuminate\Http\Response
     */
    public function delete(Template $template)
    {
        return view('templates.delete', compact('template'));
    }

    public function api_index(Request $request)
    {
        $strKeywords = $request->input('q', null);
        
        $templates = Template::ofKeywords($strKeywords)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return response()->json($templates);
    }

    public function api_store(TemplateRequest $request)
    {
        $template = Template::create($request->except($this->exceptData));

        // save avatar
        if($request->file('media'))
        {
            $medianame = Str::slug($request->media->getClientOriginalName(), '-') . '.' .$request->media->extension(); 
            $media_stamp = $template->hash . time() . '_media_' . $medianame; 
            $request->media->storeAs('templates', $media_stamp); 
            $template->update([
                'filename'=>$media_stamp,
                'mimetype'=>$request->media->getMimeType(),
            ]);
        } 

        return response()->json($template, 201);
    }

    public function api_show(Template $template)
    {
        return response()->json($template);
    }

    public function api_update(TemplateEditRequest $request, Template $template)
    {
        $template->update($request->except($this->exceptData));

        // save avatar
        if($request->file('media'))
        {
            $medianame = Str::slug($request->media->getClientOriginalName(), '-') . '.' .$request->media->extension(); 
            $media_stamp = $template->hash . time() . '_media_' . $medianame; 
            $request->media->storeAs('templates', $media_stamp); 
            $template->update([
                'filename'=>$media_stamp,
                'mimetype'=>$request->media->getMimeType(),
            ]);
        } 
        
        return response()->json($template, 200);
    }

    public function api_destroy(Template $template)
    {
        $template->delete();
        return response()->json(null, 204);
    }
}

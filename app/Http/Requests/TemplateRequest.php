<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'category' => 'required',
            'type' => 'required',
            'media' => 'required|file'
        ];
    }
}
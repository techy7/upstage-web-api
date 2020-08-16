<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'plan_identifier' => 'required',
            'limit_list' => 'required',
            'limit_space' => 'required',
            'price' => 'required|numeric|min:0'
        ];
    }
}
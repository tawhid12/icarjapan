<?php

namespace App\Http\Requests\Vehicle\SubBrand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AddNewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    
    public function rules(Request $r)
    { 
        return [
            'name'=>[
                'required',
                Rule::unique('sub_brands')->where(function ($query) use ($r){
                    return $query->where('brand_id', $r->brand_id);
                }),
            ],
            'brand_id'=>'required',
            'slug'  => 'unique:sub_brands,slug',
        ];
    }

    public function messages(){
        return [
            'required' => "The :attribute filed is required",
            'unique' => "The :attribute already used. Please try another",
        ];
    }
}
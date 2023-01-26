<?php

namespace App\Http\Requests\Product\SemiFinishProduct;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'category_id'=>'required',
            'item_code'=>'required',
            'name'=>'required',
            'unit_style_id'=>'required'
        ];
    }

    public function messages(){
        return [
            'required' => "The :attribute filed is required"
        ];
    }
}

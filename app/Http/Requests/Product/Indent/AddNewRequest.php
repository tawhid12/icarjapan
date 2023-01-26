<?php

namespace App\Http\Requests\Product\Indent;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'product_style_id'=>'required',
            'unit_style_id'=>'required',
            'buyer_id'=>'required',
            'indent_no'=>'required',
            'qty'=>'required'
        ];
    }

    public function messages(){
        return [
            'required' => "The :attribute filed is required"
        ];
    }
}

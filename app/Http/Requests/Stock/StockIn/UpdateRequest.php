<?php

namespace App\Http\Requests\Stock\StockIn;

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
            'indent_id'=>'required',
            'unit_style_id'=>'required',
            'company_id'=>'required',
            'warehouse_id'=>'required',
            'warehouse_board_id'=>'required',
            'location'=>'required',
            'stock_date'=>'required',
            'qty'=>'required'
        ];
    }

    public function messages(){
        return [
            'required' => "The :attribute filed is required"
        ];
    }
}

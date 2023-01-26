<?php

namespace App\Http\Requests\Stock\Requisition;

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
            'indent_id'=>'required',
            'company_id'=>'required',
            'product_id'=>'required',
            'unit_style_id'=>'required',
            'req_date'=>'required',
            'slip_no'=>'required',
            'line_no'=>'required',
            'issue_by'=>'required',
            'qty_total'=>'required',
            'qty'=>'required'
        ];
    }

    public function messages(){
        return [
            'required' => "The :attribute filed is required"
        ];
    }
}

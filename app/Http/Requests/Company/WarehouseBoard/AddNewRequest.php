<?php

namespace App\Http\Requests\Company\WarehouseBoard;

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
            'warehouse_id'=>'required',
            'board_type'=>'required',
            'board_no'=>'required'
        ];
    }

    public function messages(){
        return [
            'required' => "The :attribute filed is required"
        ];
    }
}

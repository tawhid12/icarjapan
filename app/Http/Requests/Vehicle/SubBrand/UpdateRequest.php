<?php

namespace App\Http\Requests\Vehicle\SubBrand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
    public function rules(Request $r)
    {
        $id=encryptor('decrypt',$r->uptoken);
        return [
            'name'=>'required|unique:sub_brands,name,'.$id,
            'brand_id' => [
                'required',
                Rule::unique('sub_brands')->where(function ($query) {
                    return $query->where('brand_id', $this->brand_id);
                })->ignore($this->id),
            ],
        ];
    }

    public function messages(){
        return [
            'required' => "The :attribute filed is required",
            'unique' => "The :attribute already used. Please try another",
        ];
    }
}

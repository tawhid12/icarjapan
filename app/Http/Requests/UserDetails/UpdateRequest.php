<?php

namespace App\Http\Requests\UserDetails;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
            'whatsapp'=>'nullable|unique:user_details,whatsapp,'.$id,
            'facebook'=>'nullable|unique:user_details,facebook,'.$id,
            'viver'=>'nullable|unique:user_details,viver,'.$id,
            'instagram'=>'nullable|unique:user_details,instagram,'.$id,
            'gmail'=>'nullable|unique:user_details,gmail,'.$id,
            'contact_no'=>'nullable|unique:user_details,contact_no,'.$id,
        ];
    }

    public function messages(){
        return [
            'required' => "The :attribute filed is required",
            'unique' => "The :attribute already used. Please try another",
        ];
    }
}

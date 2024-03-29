<?php

namespace App\Http\Requests\AdminUser;

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
        $id = encryptor('decrypt', $r->uptoken);
        $rules = [
            'userEmail' => 'nullable|unique:users,email,' . $id,
            'contactNumber' => 'nullable|unique:users,contact_no,' . $id
        ];
        // Check if the current user is 'superadmin' and conditionally add validation rules.
        if (currentUser() == 'superadmin') {
            $rules['userName'] = 'required';
            $rules['role_id'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => "The :attribute filed is required",
            'unique' => "The :attribute already used. Please try another",
        ];
    }
}

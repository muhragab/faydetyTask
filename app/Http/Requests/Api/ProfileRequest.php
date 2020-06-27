<?php

namespace App\Http\Requests\Api;

use App\Custom\CustomFormArrayRequest;

class ProfileRequest extends CustomFormArrayRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'phone_number' => 'required|exists:users,phone_number',
            'auth_token' => 'required|string|exists:users,auth_token',
        ];
    }
}

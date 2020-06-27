<?php

namespace App\Http\Requests\Api;

use App\Custom\CustomFormArrayRequest;
use App\Models\User;

class RegisterRequest extends CustomFormArrayRequest
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
        return User::$rules;
    }

    public function messages()
    {
        return [
            'phone_number.regex' => 'Must be in E.164 format i.e . +xxxxxxxxxxxx',
        ];
    }
}

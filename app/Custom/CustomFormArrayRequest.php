<?php

namespace App\Custom;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomFormArrayRequest extends FormRequest
{
    /**
     * Validation Failed.
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->sendError($validator->errors()));

    }

    public function sendError($error, $code = 400)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }
}

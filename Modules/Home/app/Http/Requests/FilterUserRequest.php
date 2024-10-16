<?php

namespace Modules\Home\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'less_height' => 'required|numeric',
            'high_height' => 'required|numeric',
            'marital_status' => 'required',
            'have_kids' => 'required',
            'less_age' => 'required|numeric',
            'high_age' => 'required|numeric',
            'city_id' => 'required|numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }

    public function authorize(): bool
    {
        return true;
    }
}

<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->first()], 422));
    }

    public function rules()
    {
        return [
            'provider' => 'nullable|in:DataProviderX,DataProviderY,both',
            'statusCode' => 'nullable|in:authorised,decline,refunded',
            'balanceMin' => 'nullable|numeric|min:0',
            'balanceMax' => 'nullable|numeric|min:' . ($this->input('balanceMin') ?: 0),
            'currency' => 'nullable|string',
        ];
    }
}

<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
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

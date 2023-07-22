<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataImportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'provider' => 'required|in:DataProviderX,DataProviderY',
            'file' => 'required|mimes:json|max:2048',
        ];
    }
}

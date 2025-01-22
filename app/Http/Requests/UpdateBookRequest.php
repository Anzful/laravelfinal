<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'categories' => ['sometimes', 'array'],
            'categories.*' => ['required_with:categories', 'exists:categories,id'],
        ];
    }

    public function messages()
    {
        return [
            'title.string' => 'წიგნის სახელი უნდა იყოს ტექსტური',
            'categories.*.exists' => 'ერთ-ერთი კატეგორია არასწორია',
        ];
    }
}

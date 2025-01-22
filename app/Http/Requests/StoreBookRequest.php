<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    public function authorize()
    {
        // For demo, allow all. In real project, add logic
        return true;
    }

    public function prepareForValidation()
    {
        // Example: trim the title, convert to uppercase, or any other transformations
        if ($this->has('title')) {
            $this->merge([
                'title' => trim($this->title),
            ]);
        }
    }

    public function rules()
    {
        return [
            'author_id' => ['required', 'exists:authors,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'exists:categories,id'], // each element must be valid category id
        ];
    }

    public function messages()
    {
        // Custom validation messages in Georgian
        return [
            'author_id.required' => 'გთხოვთ აირჩიოთ ავტორი',
            'author_id.exists' => 'მოცემული ავტორი ვერ მოიძებნა',
            'title.required' => 'გთხოვთ შეიყვანოთ წიგნის სახელი',
            'categories.required' => 'გთხოვთ აირჩიოთ კატეგორი(ებ)ი',
            'categories.*.exists' => 'ერთ-ერთი კატეგორია არასწორია',
        ];
    }
}

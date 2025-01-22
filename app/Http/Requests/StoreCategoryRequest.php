<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     
    public function authorize()
    {
        // Update authorization logic as needed
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
            'name' => 'required|string|max:255|unique:categories,name',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
     
    public function messages()
    {
        return [
            'name.required' => 'გთხოვთ შეიყვანოთ კატეგორიის სახელი.',
            'name.unique' => 'ამ სახელით კატეგორია უკვე არსებობს.',
            'name.max' => 'კატეგორიის სახელი არ უნდა აღემატებოდეს 255 სიმბოლოს.',
        ];
    }
}

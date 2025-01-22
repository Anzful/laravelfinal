<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAuthorRequest extends FormRequest
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
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('authors', 'name')->ignore($this->author->id),
            ],
            'bio' => 'sometimes|nullable|string',
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
            'name.unique' => 'ამ სახელით ავტორი უკვე არსებობს.',
            'name.max' => 'ავტორის სახელი არ უნდა აღემატებოდეს 255 სიმბოლოს.',
        ];
    }
}

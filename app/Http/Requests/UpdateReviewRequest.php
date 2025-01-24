<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReviewRequest extends FormRequest
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
     * Prepare the data for validation.
     */
     
    protected function prepareForValidation()
    {
        // Example: Trim content
        if ($this->has('content')) {
            $this->merge([
                'content' => trim($this->content),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     
    public function rules()
    {
        return [
            'content' => 'sometimes|required|string|max:1000',
            'rating' => 'sometimes|required|integer|min:1|max:5',
            // Optionally allow updating reviewable_type and reviewable_id
            'reviewable_type' => 'sometimes|required|string|in:App\Models\Book,App\Models\Author',
            'reviewable_id' => [
                'sometimes',
                'required_with:reviewable_type',
                'integer',
                // The 'exists' rule will be conditionally added in withValidator()
            ],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // Apply 'exists' rule based on 'reviewable_type'
        $validator->sometimes('reviewable_id', [
            'exists:books,id'
        ], function ($input) {
            return $input->reviewable_type === 'App\Models\Book';
        });

        $validator->sometimes('reviewable_id', [
            'exists:authors,id'
        ], function ($input) {
            return $input->reviewable_type === 'App\Models\Author';
        });
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
     
    public function messages()
    {
        return [
            'content.required' => 'გთხოვთ შეიყვანოთ რევიუ.',
            'content.max' => 'რევიუ არ უნდა აღემატებოდეს 1000 სიმბოლოს.',
            'rating.required' => 'გთხოვთ შეიყვანოთ შეფასება.',
            'rating.integer' => 'შეფასება უნდა იყოს მთელ რიცხვი.',
            'rating.min' => 'შეფასება არ უნდა იყოს ნაკლები 1-დან.',
            'rating.max' => 'შეფასება არ უნდა აღემატებოდეს 5-ს.',
            'reviewable_type.required' => 'გთხოვთ დააინფორმიროთ რევიუ რომელის შესახებ არის.',
            'reviewable_type.in' => 'არასწორი რევიუ ტიპი.',
            'reviewable_id.required_with' => 'გთხოვთ დააინფორმიროთ რევიუ რომელის შესახებ არის.',
            'reviewable_id.exists' => 'მოცემული რევიუ 대상으로 ვერ მოიძებნა.',
        ];
    }
}

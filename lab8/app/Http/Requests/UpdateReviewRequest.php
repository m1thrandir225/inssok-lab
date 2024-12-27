<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Modify based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'jet_id' => ['sometimes', 'exists:jets,id'],
            'reviewer_name' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'rating' => ['sometimes', 'integer', 'min:1', 'max:5'],
            'status' => ['sometimes', 'string', 'in:pending,approved,rejected'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'jet_id.exists' => 'The selected jet does not exist.',
            'rating.min' => 'The rating must be at least 1.',
            'rating.max' => 'The rating cannot be greater than 5.',
            'status.in' => 'The status must be either pending, approved, or rejected.',
        ];
    }
}

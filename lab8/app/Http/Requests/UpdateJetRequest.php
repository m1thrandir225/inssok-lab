<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJetRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'model' => ['sometimes', 'string', 'max:255'],
            'capacity' => ['sometimes', 'integer', 'min:1'],
            'hourly_rate' => ['sometimes', 'numeric', 'min:0'],
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
            'capacity.min' => 'The jet must have at least 1 seat.',
            'hourly_rate.min' => 'The hourly rate cannot be negative.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\YachtTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreYachtRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'type' => [Rule::enum(YachtTypeEnum::class), 'required'],
            'capacity' => 'required|integer|gte:1',
            'hourly_rate' => 'required|numeric|gte:1',
        ];
    }
}

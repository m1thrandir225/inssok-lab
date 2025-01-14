<?php

namespace App\Http\Requests;

use App\Enums\ReservationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReviewRequest extends FormRequest
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
            //
            'reviewer_name' => 'required|string',
            'text' => 'string',
            'rating' => 'required|integer|between:1,5',
            'reservation_id' => [
                'required',
                Rule::exists('reservations', 'id')->where(function ($query) {
                    $query->where('status', ReservationStatusEnum::CONFIRMED);
                })
            ]
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\ReservationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'name' => "required|string",
            'yacht_id' => "required|exists:yachts,id",
            "reservation_date" => "required|date|after:today",
            "status" => [Rule::enum(ReservationStatusEnum::class), 'required'],
            "duration_hours" => "required|integer|between:1,24"
        ];
    }
}

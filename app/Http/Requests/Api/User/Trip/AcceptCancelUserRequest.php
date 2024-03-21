<?php

namespace App\Http\Requests\Api\User\Trip;

use App\Rules\CheckUserTripStatus;
use Illuminate\Foundation\Http\FormRequest;

class AcceptCancelUserRequest extends FormRequest
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
            'trip_id' => ['required', 'integer', 'exists:trips,id', new CheckUserTripStatus],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}

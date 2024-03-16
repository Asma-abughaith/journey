<?php

namespace App\Http\Requests\Api\User\Trip;

use App\Rules\CheckIfCanMakeTripRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;


class CreateTripRequest extends FormRequest
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
            'place_id' => ['required', 'integer', 'exists:places,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cost' => ['required', 'numeric', 'min:0'],
            'age_min' => ['required', 'integer'],
            'age_max' => ['required', 'integer'],
            'sex' => ['required'],
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isPast()) {
                        $fail('The ' . $attribute . ' must be a date in the future.');
                    }
                },
            ],
            'time' => ['required', 'date_format:H:i:s', new CheckIfCanMakeTripRule],
            'attendance_number' => ['required', 'integer', 'min:1'],
            'tags' => ['required'],
        ];
    }
}
<?php

namespace App\Http\Requests\Api\User\Trip;

use App\Rules\CheckIfCanMakeTripRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class UpdateTripRequest extends FormRequest
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
            'place_id' => ['nullable', 'integer', 'exists:places,id'],
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'age_min' => [
                Rule::requiredIf(function () {
                    return request()->filled('age_max');
                }),
                'nullable',
                'integer',
            ],
            'age_max' => [
                Rule::requiredIf(function () {
                    return request()->filled('age_min');
                }),
                'nullable',
                'integer',
                'gte:age_min',
            ],
            'gender' => ['nullable'],
            'date' => [
                Rule::requiredIf(function () {
                    return request()->filled('time');
                }),
                'nullable',
                'date',
                function ($attribute, $value, $fail) {
                    if ($value && Carbon::parse($value)->isPast()) {
                        $fail('The ' . $attribute . ' must be a date in the future.');
                    }
                },
            ],
            'time' => [
                'nullable',
                'date_format:H:i:s',
                Rule::requiredIf(function () {
                    return request()->filled('date');
                }),
                Rule::when(request()->filled('date'), [new CheckIfCanMakeTripRule]),
            ],

            'attendance_number' => ['nullable', 'integer', 'min:1'],
            'tags' => ['nullable'],
        ];
    }
}

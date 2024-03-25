<?php

namespace App\Http\Requests\Api\User\Plan;

use App\Helpers\ApiResponse;
use App\Rules\CheckIfPlanBelongsToUser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UpdatePlanApiRequest extends FormRequest
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
        $rules = [
            'plan_id'=>['required','exists:plans,id',new CheckIfPlanBelongsToUser()],
            'name' => 'required',
            'description' => 'required',
            'days' => 'required|array',
        ];

        foreach ($this->json('days') as $dayIndex => $day) {
            foreach ($day['activities'] as $activityIndex => $activity) {
                $activityRule = "required|date_format:H:i";
                if ($activityIndex > 0) {
                    $previousEndTime = $this->json("days.$dayIndex.activities." . ($activityIndex - 1) . ".end_time");
                    $activityRule .= "|after:$previousEndTime";
                }
                $rules["days.$dayIndex.activities.$activityIndex.name"] = "required";
                $rules["days.$dayIndex.activities.$activityIndex.start_time"] = $activityRule;
                $rules["days.$dayIndex.activities.$activityIndex.end_time"] = $activityRule . "|after:days.$dayIndex.activities.$activityIndex.start_time";
                $rules["days.$dayIndex.activities.$activityIndex.place_id"] = "required|exists:places,id";
                $rules["days.$dayIndex.activities.$activityIndex.note"] = "max:255";
            }
        }

        return $rules;
    }


    public function messages(): array
    {
        return [
            'days.*.activities.*.note.max' => 'The Arabic note field cannot be longer than 255 characters.',
            'days.*.activities.*.name.required' => 'The name field is required.',
            'days.*.activities.*.place_id.required' => 'The Place field is required.',
            'days.*.activities.*.start_time.required' => 'The start time field is required.',
            'days.*.activities.*.start_time.date_format' => 'The start time must be in the format H:i.',
            'days.*.activities.*.end_time.required' => 'The end time field is required.',
            'days.*.activities.*.end_time.date_format' => 'The end time must be in the format H:i.',
            'days.*.activities.*.end_time.after' => 'The end time must be after the start time.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = [];

        foreach ($validator->errors()->messages() as $field => $messages) {
            //dd($field);
            //list($dayIndex, $activityIndex, $attribute) = explode('.', $field, 3);
            $errors[] = "$field: $messages[0]";
        }

        throw new HttpResponseException(
            ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $errors)
        );
    }
}

<?php

namespace App\Http\Requests\Api\User\Post;

use App\Helpers\ApiResponse;
use App\Models\Place;
use App\Models\Plan;
use App\Models\Trip;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class CreatePostApiRequest extends FormRequest
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
            'visitable_type'=> ['required', Rule::in(['Place', 'Plan', 'Trip'])],
            'visitable_id' => ['required', function ($attribute, $value, $fail) {
                $type = $this->input('visitable_type');
                if ($type === 'Place' && !Place::where('id', $value)->exists()) {
                    $fail('The selected place does not exist.');
                } elseif ($type === 'Plan' && !Plan::where('id', $value)->exists()) {
                    $fail('The selected plan does not exist.');
                } elseif ($type === 'Trip' && !Trip::where('id', $value)->exists()) {
                    $fail('The selected trip does not exist.');
                }
            }],
            'content'=>['required', 'string'],
            'privacy'=>['required', Rule::in(['0', '1', '2'])],
            'media'=>['nullable']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException(
            ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $errors)
        );
    }
}

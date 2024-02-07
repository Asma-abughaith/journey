<?php

namespace App\Http\Requests\Web\Admin\Permission;

use App\Validation\CheckNameAndGuardExistRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePermissionRequest extends FormRequest
{
    public $errors;
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
        $currentPermissionId = request()->id;
        return [
            'name_en' => ['required','min:3',new CheckNameAndGuardExistRule($currentPermissionId)],
            'name_ar' => ['required','min:3'],
            'guard'=>['required','min:3',new CheckNameAndGuardExistRule($currentPermissionId)],
        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required' => 'English name is required.',
            'name_en.min' => 'English name must be at least :min characters.',
            'name_ar.required' => 'Arabic name is required.',
            'name_ar.min' => 'Arabic name must be at least :min characters.',
            'guard.required' => 'Guard is required.',
            'guard.min' => 'Guard must be at least :min characters.',
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
            'guard' => 'Guard',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->errors = $validator->errors();

    }


}

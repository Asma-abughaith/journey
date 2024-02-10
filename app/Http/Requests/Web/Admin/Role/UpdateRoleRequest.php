<?php

namespace App\Http\Requests\Web\Admin\Role;

use App\Validation\CheckRoleNameAndGuardExistRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $currentPermissionId = request()->id;
        return [
            'name_en' => ['required','min:3',new CheckRoleNameAndGuardExistRule($currentPermissionId)],
            'name_ar' => ['required','min:3'],
            'guard'=>['required','min:3'],
            'permissions.*'=>['required'],
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
            'permissions.required'=>'you should at least to choose one permission',
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

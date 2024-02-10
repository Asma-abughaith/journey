<?php

namespace App\Http\Requests\Web\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
        $adminId =request()->id;

        return [
            'name' => 'required',
            'email' => ['required',Rule::unique('admins', 'email')->ignore($adminId)],
            'image' => ['nullable','max:1024'],
            'role'=>'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->errors = $validator->errors();
    }
}

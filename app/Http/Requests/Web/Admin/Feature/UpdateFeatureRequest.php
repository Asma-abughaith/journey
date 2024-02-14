<?php

namespace App\Http\Requests\Web\Admin\Feature;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateFeatureRequest extends FormRequest
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
        $regionId = request()->id;
        return [
            'name_en' => ['required', 'min:3', Rule::unique('regions', 'name->en')->ignore($regionId)],
            'name_ar' => ['required', 'min:3', Rule::unique('regions', 'name->ar')->ignore($regionId)],
            'icon'=>['required']

        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required' => 'English name is required.',
            'name_en.min' => 'English name must be at least :min characters.',
            'name_ar.required' => 'Arabic name is required.',
            'name_ar.min' => 'Arabic name must be at least :min characters.',
            'icon.required' => 'Icon name is required.',
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
            'icon'=>'Icon'

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        foreach ($errors as $error) {
            Toastr::error($error, 'Error');
        }
        throw new HttpResponseException(
            redirect()->back()->withInput()->withErrors($validator)
        );
    }
}

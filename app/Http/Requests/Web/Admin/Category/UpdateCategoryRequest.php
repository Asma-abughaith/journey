<?php

namespace App\Http\Requests\Web\Admin\Category;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = request()->id;
        return [
            'name_en' => ['required', 'string' ,'min:3', Rule::unique('categories', 'name->en')->ignore($categoryId)],
            'name_ar' => ['required', 'string' ,'min:3', Rule::unique('categories', 'name->ar')->ignore($categoryId)],
            'priority' => ['required', Rule::unique('categories', 'priority')->ignore($categoryId)],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required' => __('validation.msg.english-name-required'),
            'name_en.min' => __('validation.msg.english-name-min-characters'),
            'name_ar.required' => __('validation.msg.arabic-name-required'),
            'name_ar.min' => __('validation.msg.arabic-name-min-characters'),
            'priority.required' => __('validation.msg.priority-required'),
            'priority.min' => __('validation.msg.priority-min-characters'),
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => __('validation.attributes.name-en'),
            'name_ar' => __('validation.attributes.name-ar'),
            'priority' => __('validation.attributes.priority'),
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

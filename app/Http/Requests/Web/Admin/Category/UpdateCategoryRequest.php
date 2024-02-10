<?php

namespace App\Http\Requests\Web\Admin\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
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
        $categoryId =request()->id;
        return [
            'name_en' => ['required','min:3',Rule::unique('categories', 'name->en')->ignore($categoryId)],
            'name_ar' => ['required','min:3',Rule::unique('categories', 'name->ar')->ignore($categoryId)],
            'priority' => ['required', Rule::unique('categories', 'priority')->ignore($categoryId)],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required' => 'English name is required.',
            'name_en.min' => 'English name must be at least :min characters.',
            'name_ar.required' => 'Arabic name is required.',
            'name_ar.min' => 'Arabic name must be at least :min characters.',
            'priority.required' => 'Priority is required.',
            'priority.min' => 'priority must be at least :min characters.',
            'image.required'=>'image is required',
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
            'priority' => 'Priority',
            'image' => 'Image',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->errors = $validator->errors();

    }
}

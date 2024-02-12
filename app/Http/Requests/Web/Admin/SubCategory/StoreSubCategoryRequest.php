<?php

namespace App\Http\Requests\Web\Admin\SubCategory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSubCategoryRequest extends FormRequest
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
        return [
            'name_en' => ['required', 'string', 'min:3', Rule::unique('sub_categories', 'name->en')],
            'name_ar' => ['required', 'string', 'min:3', Rule::unique('sub_categories', 'name->ar')],
            'category_id' => ['required'],
            'priority' => ['required', Rule::unique('sub_categories')],
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
            'category_id.required' => 'Category is required',
            'priority.required' => 'Priority is required.',
            'priority.min' => 'priority must be at least :min characters.',
            'image.required' => 'image is required',
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
            'category_id' => 'Category',
            'priority' => 'Priority',
            'image' => 'Image',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->errors = $validator->errors();
    }
}

<?php

namespace App\Http\Requests\Web\Admin\SubCategory;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateSubCategoryRequest extends FormRequest
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
        $subCategoryId = request()->id;
        return [
            'name_en' => ['required', 'string', 'min:3', Rule::unique('sub_categories', 'name->en')->ignore($subCategoryId)],
            'name_ar' => ['required', 'string', 'min:3', Rule::unique('sub_categories', 'name->ar')->ignore($subCategoryId)],
            'category_id' => ['required'],
            'priority' => ['required', Rule::unique('sub_categories')->ignore($subCategoryId)],
            'image' => ['nullable', 'max:1024'],
            'icon'=>'required'

        ];
    }
    //
    public function messages(): array
    {
        return [
            'name_en.required' => 'English name is required.',
            'name_en.min' => 'English name must be at least :min characters.',
            'name_ar.required' => 'Arabic name is required.',
            'name_ar.min' => 'Arabic name must be at least :min characters.',
            'priority.required' => 'Priority is required.',
            'priority.min' => 'priority must be at least :min characters.',
//            'image.required' => 'The Image is required.',
            'image.max' => 'The image size must be 1024.',
            'icon.required'=>'The Icon is required'
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
            'category_id' => 'Category',
            'image' => 'Image'

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

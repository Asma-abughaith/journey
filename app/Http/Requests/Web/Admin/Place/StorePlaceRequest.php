<?php


namespace App\Http\Requests\Web\Admin\Place;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Brian2694\Toastr\Facades\Toastr;

class StorePlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_en' => 'required|string|min:3',
            'name_ar' => 'required|string|min:3',
            'description_en' => 'required|string|min:3',
            'description_ar' => 'required|string|min:3',
            'address_en' => 'required|string|min:3',
            'address_ar' => 'required|string|min:3',
            'google_map_url' => 'required|url',
            'phone_number' => 'required|string',
            'longitude' => 'required',
            'latitude' => 'required',
            'price_level' => 'required|string',
            'website' => 'required|url',
            'rating' => 'required',
            'total_user_rating' => 'required',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'region_id' => 'required|exists:regions,id',
            'business_status' => 'required|string',
            'tags_id' => 'required|array',
            'tags_id.*' => 'exists:tags,id',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name_en.required' => __('validation.msg.english-name-required'),
            'name_en.min' => __('validation.msg.english-name-min-characters'),
            'name_ar.required' => __('validation.msg.arabic-name-required'),
            'name_ar.min' => __('validation.msg.arabic-name-min-characters'),
            'description_en.required' => __('validation.msg.english-description-required'),
            'description_en.min' => __('validation.msg.english-description-min-characters'),
            'description_ar.required' => __('validation.msg.arabic-description-required'),
            'description_ar.min' => __('validation.msg.arabic-description-min-characters'),
            'address_en.required' => __('validation.msg.english-address-required'),
            'address_en.min' => __('validation.msg.english-address-min-characters'),
            'address_ar.required' => __('validation.msg.arabic-address-required'),
            'address_ar.min' => __('validation.msg.arabic-address-min-characters'),
            'google_map_url.required' => __('validation.msg.google-map-url-required'),
            'google_map_url.url' => __('validation.msg.invalid-url'),
            'phone_number.required' => __('validation.msg.phone-number-required'),
            'longitude.required' => __('validation.msg.longitude-required'),
            'longitude.numeric' => __('validation.msg.invalid-longitude'),
            'latitude.required' => __('validation.msg.latitude-required'),
            'latitude.numeric' => __('validation.msg.invalid-latitude'),
            'price_level.required' => __('validation.msg.price-level-required'),
            'website.required' => __('validation.msg.website-required'),
            'website.url' => __('validation.msg.invalid-website-url'),
            'rating.required' => __('validation.msg.rating-required'),
            'rating.numeric' => __('validation.msg.invalid-rating'),
            'total_user_rating.required' => __('validation.msg.total-user-rating-required'),
            'total_user_rating.numeric' => __('validation.msg.invalid-total-user-rating'),
            'sub_category_id.required' => __('validation.msg.subcategory-required'),
            'sub_category_id.exists' => __('validation.msg.invalid-subcategory'),
            'region_id.required' => __('validation.msg.region-required'),
            'region_id.exists' => __('validation.msg.invalid-region'),
            'business_status.required' => __('validation.msg.business-status-required'),
            'tags.required' => __('validation.msg.tags-required'),
            'tags.array' => __('validation.msg.invalid-tags'),
            'tags.*.exists' => __('validation.msg.invalid-tag'),
            'main_image.required' => __('validation.msg.main-image-required'),
            'main_image.image' => __('validation.msg.invalid-image'),
            'main_image.mimes' => __('validation.msg.invalid-image-format'),
            'gallery_images.*.image' => __('validation.msg.invalid-gallery-image'),
            'gallery_images.*.mimes' => __('validation.msg.invalid-gallery-image-format'),
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
        $errors = $validator->errors()->all();
        foreach ($errors as $error) {
            Toastr::error($error, __('Error'));
        }
        throw new HttpResponseException(
            redirect()->back()->withInput()->withErrors($validator)
        );
    }
}

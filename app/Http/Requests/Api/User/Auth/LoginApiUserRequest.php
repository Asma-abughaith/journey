<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class LoginApiUserRequest extends FormRequest
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
            'username' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required',  Rules\Password::defaults()],
        ];
    }
}

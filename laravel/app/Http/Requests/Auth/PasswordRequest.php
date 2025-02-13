<?php

namespace App\Http\Requests\Auth;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'min:8', new CurrentPasswordCheckRule],
            'password' => ['required', 'min:8', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:8'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'old_password' => __('current password'),
        ];
    }

    public function messages()
    {
        return [
            'password.min' => __('The password must be at least 8 characters.'),

            'password_confirmation.same' => __('The password confirmation does not match.'),
        ];
    }
}

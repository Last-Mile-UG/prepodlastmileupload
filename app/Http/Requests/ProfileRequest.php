<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
            'photo' => ['nullable', 'image'],
            'display_name' => 'nullable',
            'password' => 'nullable',
            'password_confirmation' => 'nullable',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'postal_code' => 'nullable',
            'country' => 'nullable',
            'role' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SocialMediaRequest extends FormRequest
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
            'url'         => ['nullable', 'string', 'max:255', 'min:10'],
            'description' => ['nullable', 'string', 'max:1000', 'min:10'],
            'username'    => ['nullable', 'string', 'max:25', 'min:6'],
            'password'    => ['nullable', \Illuminate\Validation\Rules\Password::defaults()],
        ];
    }
}

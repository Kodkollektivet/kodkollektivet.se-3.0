<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SponsorRequest extends FormRequest
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
            'name'        => ['string', 'max:50', 'min:3'],
            'logo'        => ['file'],
            'active'      => ['boolean'],
            'website'     => ['nullable', 'string', 'max:100', 'min:10'],
            'description' => ['string', 'max:1000', 'min:3']
        ];
    }
}

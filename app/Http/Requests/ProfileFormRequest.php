<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\role;
use App\Models\Position;
use Illuminate\Validation\Rule;


class ProfileFormRequest extends FormRequest
// class ProfileFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;    // Set to false by default.
                        // Validation won't run unless set
                        // to true.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this['type'];

        return in_array($rules, ['profile', 'contacts', 'lnuKk', 'password']) ? $this::$rules() : array();
    }

    private function profile() {
        return [
            'name'     => ['string', 'max:25', 'min:3'],
            'username' => ['unique:users', 'string', 'max:25', 'min:3', 'alpha_dash'],
            'avatar'   => ['nullable', 'string'],
            'status'   => ['nullable', 'string', 'max:225', 'min:3'],
            'about'    => ['nullable', 'string', 'max:1000', 'min:3'],
            'avatar'   => ['nullable', 'file'],
            'cover'    => ['nullable', 'file'],
        ];
    }

    private function contacts() {
        return [
            'email'    => ['unique:users', 'string', 'max:50', 'min:9'],
            'phone'    => ['nullable', 'unique:user_profiles', 'min:7', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'discord'  => ['nullable', 'unique:user_profiles', 'string', 'max:20', 'min:7'],
            'github'   => ['nullable', 'unique:user_profiles', 'string', 'max:25', 'min:5'],
            'facebook' => ['nullable', 'unique:user_profiles', 'string', 'max:25', 'min:5'],
            'website'  => ['nullable', 'unique:user_profiles', 'string', 'max:50', 'min:5'],
            'linkedin' => ['nullable', 'unique:user_profiles', 'string', 'max:50', 'min:5'],
        ];
    }

    private function lnuKk() {
        return [
            'campus'       => 'in:Växjö,Kalmar',
            'programme'    => 'in:Software Technology,Computer Technology,Network Security,Other',
            'LOE'          => 'in:Bachelor,Master,PhD,Other',
            'year'         => 'in:1,2,3,4,5,Graduate,Dropout',
            'date_started' => 'date',
            'date_ended'   => 'date'
        ];
    }

    private function password() {
        return [
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ];
    }

}

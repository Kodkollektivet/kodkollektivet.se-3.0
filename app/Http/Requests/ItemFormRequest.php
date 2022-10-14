<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ItemFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = $this['item_type'] != 'post' ? $this['item_type'] : 'post_rules';

        return in_array($rules, ['event', 'post_rules', 'project']) ? $this::$rules() : array();
    }

    private function event() {
        $allowedTypes = implode(',', \App\Http\Controllers\EventController::getTypes());

        return [
            'name'         => ['string', 'max:255', 'min:3'],
            'intro'        => ['string', 'max:1000', 'min:10'],
            'description'  => ['string', 'min:100'],
            'image'        => ['file', 'nullable'],
            'event_images' => ['nullable'],
            'type'         => ["in:$allowedTypes"],
            'date'         => ['nullable', 'date'],
            'place'        => ['string', 'max:100', 'min:6']
        ];
    }

    private function post_rules() {
        return [
            'name'        => ['string', 'max:255', 'min:3'],
            'intro'       => ['string', 'max:1000', 'min:10'],
            'description' => ['string', 'min:100'],
            'community'   => ['boolean', 'nullable'],
            'image'       => ['file', 'nullable'],
            'post_images' => ['nullable'],
            'tags'        => ['string']
        ];
    }

    private function project() {
        //
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content'   => ['string', 'min:1'],
            'item_id'   => ['integer', 'min:1'],
            'item_type' => ['string', 'in:post,event,comment'],
            'origin'    => ['nullable', 'integer', 'min:1']
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'type'    => ['string', 'in:Spam,Abuse / harassment,Misinformation,Inappropriate content'],
            'content' => ['string', 'min:1'],
            'item_id' => ['integer', 'min:1'],
        ];
    }
}

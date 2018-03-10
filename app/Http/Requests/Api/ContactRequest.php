<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    use ApiRequestTrait;
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
            "room_id" => "required",
            "title" => "required",
            "content" => "required"
        ];
    }
}
<?php

namespace App\Http\Requests\Api;

use App\Traits\ApiRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            //'name' => 'required',
            //'email' => 'required|email',
            //'birthday' => 'nullable|date_format:' . PHP_DATE,
            //'id_number' => 'nullable|numeric',
            //'id_number_date' => 'nullable|date_format:' . PHP_DATE,
            //'front_id' => 'nullable|image|max:5120',
            //'backside_id' => 'nullable|image|max:5120',

            'password' => 'nullable|min:6',
            'phone' => 'nullable|min:8|max:15',
            //'facebook' => 'nullable|url',
            'avatar' => 'nullable|image|max:5120',
        ];
    }
}

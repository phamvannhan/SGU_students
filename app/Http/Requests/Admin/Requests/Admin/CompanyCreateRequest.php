<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
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
            'code' => 'required',
            'name' => 'required|min:2',
            'deputy_birthday' => 'nullable|date|date_format:'.PHP_DATE,
            'deputy_id_date' => 'nullable|date|date_format:'.PHP_DATE,
        ];
    }
}

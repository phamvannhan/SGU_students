<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReportCreateRequest extends FormRequest
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
            'name' => 'required',
            'type' => 'required',
            'file' => 'required|file|max:'.MAX_FILE_UPLOAD_SIZE,
            'report_date' => 'required|date|date_format:'.PHP_DATE,
        ];
    }
}

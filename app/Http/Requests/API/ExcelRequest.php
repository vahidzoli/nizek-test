<?php

namespace App\Http\Requests\API;

use App\Http\Requests\Request;

class ExcelRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|max:100000|mimes:xlsx, xls'
        ];
    }
}

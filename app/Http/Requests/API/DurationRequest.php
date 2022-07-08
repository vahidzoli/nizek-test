<?php

namespace App\Http\Requests\API;

use App\Http\Requests\Request;

class DurationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date'   => 'required|date|date_format:Y-m-d|before:start_date'
        ];
    }
}

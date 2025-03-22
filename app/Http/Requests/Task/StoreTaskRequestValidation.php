<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequestValidation;

class StoreTaskRequestValidation extends BaseRequestValidation
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}

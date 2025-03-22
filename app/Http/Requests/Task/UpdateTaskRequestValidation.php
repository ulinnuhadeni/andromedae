<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequestValidation;

class UpdateTaskRequestValidation extends BaseRequestValidation
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'start_date' => 'sometimes|required|date|before_or_equal:end_date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
        ];
    }
}

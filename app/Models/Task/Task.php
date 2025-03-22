<?php

namespace App\Models\Task;

use App\Models\BaseModel as Base;
use App\Models\User;

class Task extends Base
{
    protected $table = 'tasks';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'is_completed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models\Authentication;

use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken as BaseModel;

class PersonalAccessToken extends BaseModel
{
    public $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
            $model->expires_at = now()->addDays(30);
        });
    }
}

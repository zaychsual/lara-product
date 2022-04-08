<?php

namespace App\Models;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid as Generator;
use Illuminate\Database\Eloquent\Model;

class UUIDModel extends Model
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id         = Generator::uuid4()->toString();
            $model->created_at = Carbon::now();
            $model->updated_at = Carbon::now();
        });
        static::updating(function ($model) {
            $model->updated_at = Carbon::now();
        });
    }
}

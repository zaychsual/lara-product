<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends UUIDModel
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'desc',
        'price',
        'qty',
    ];

    protected function setUUID()
    {
        $this->id = preg_replace('/\./', '', uniqid(true));
    }
}

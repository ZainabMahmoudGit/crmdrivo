<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $primaryKey = 'id';   // عشان المفتاح الأساسي هو id مش auto increment
    public $incrementing = false;   // عشان id مش تلقائي
    protected $keyType = 'string';  // عشان id نصي

    protected $fillable = [
        'id', 'name', 'phone', 'email',
    ];
}

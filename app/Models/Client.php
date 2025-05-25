<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $incrementing = false; // لأن الـ id نوعه string (Firebase UID)
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'phone', 'email',
    ];
}

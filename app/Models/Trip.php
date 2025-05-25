<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'client_id',
        'sales_id',
        'status',
        'total_amount',
        'payment_status',
        'payment_method',
        'transfer_image',
        'canceled_by',
        'cancel_reason',
        'cancel_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sales()
    {
        return $this->belongsTo(Sale::class);
    }
}

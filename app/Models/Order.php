<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_date',
        'user_id',
        'mechanic_id',
        'supervisor',
        'vehicle_type',
        'sub_total',
        'vat',
        'total_amount',
        'discount',
        'grand_total',
        'paid',
        'due',
        'payment_type',
        'payment_status',
        'created_by',
        'order_status'
    ];
}

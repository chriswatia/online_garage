<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'service_id',
        'date',
        'created_by',
        'notes',
        'status'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'created_by',
        'specialization',
        'status'
    ];
}

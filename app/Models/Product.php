<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'brand_id',
        'category_id',
        'quantity',
        'rate',
        'created_by',
        'status'
    ];
}

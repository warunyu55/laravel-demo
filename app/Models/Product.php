<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'productname',
        'description',
        'price',
        'amount',
        'type_name',
        'status'
    ];
}

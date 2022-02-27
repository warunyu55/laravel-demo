<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'o_member_id',
        'o_address_id',
        'o_product_id',
        'o_amount',
        'o_total',
        'o_status',
        'o_bank_id',
        'o_payment',
        'o_note'
    ];
}

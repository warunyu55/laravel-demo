<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberaddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'a_member_id',
        'a_address',
        'tambon_id',
        'province_id',
        'district_id',
        'a_status',
    ];
}

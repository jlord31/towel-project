<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'coupon_code',
        'value',
        'total_discount_given',
        'total_current_use',
        'total_use_allowed',
        'expiration_date',
        'description',
        'img',
        'status'
    ];
}
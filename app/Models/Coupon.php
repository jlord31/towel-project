<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'value',
        'total_discount_given',
        'total_current_use',
        'total_use_allowed',
        'total_discount_given',
        'start_date',
        'expiration_date',
        'description',
        'img',
        'status'
    ];
}
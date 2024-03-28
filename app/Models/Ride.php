<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Property;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'color',
        'image',
        'actual_price_per_day',
        'customer_price_per_day',
        'company_profit_per_day',
        'airport_park_pickup_actual_price',
        'airport_park_pickup_customer_price',
        'airport_park_pickup_company_profit',
        'ride_type',
        'status'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function property() 
    {
        return $this->belongsTo(Property::class);
    }
}
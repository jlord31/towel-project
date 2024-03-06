<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Facility;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'title',
        'type',
        'address',
        'capacity',
        'facility',
        'beds',
        'bathroom',
        'sqrft',
        'rate',
        'people_limit',
        'latitude',
        'longtitude',
        'actual_price',
        'customer_price',
        'company_profit',
        'image',
        'description',
        'status'
    ];

    public function facility() 
    {
        return $this->hasMany(Facility::class);
    }
}

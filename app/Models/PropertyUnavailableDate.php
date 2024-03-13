<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Property;

class PropertyUnavailableDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'from',
        'to',
        'status'
    ];

    public function property() 
    {
        return $this->belongsTo(Property::class);
    }
}
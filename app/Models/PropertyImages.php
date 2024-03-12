<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Property;

class PropertyImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image'
    ];

    public function property() 
    {
        return $this->hasMany(Property::class);
    }

}

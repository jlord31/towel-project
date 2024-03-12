<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Property;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'img',
        'status'
    ];

    public function property() 
    {
        return $this->hasMany(Property::class);
    }

}

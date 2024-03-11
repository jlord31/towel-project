<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Property;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img',
        'status'
    ];

    public function property() 
    {
        return $this->belongsTo(Property::class);
    }
}

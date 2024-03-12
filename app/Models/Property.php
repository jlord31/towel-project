<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Facility;
use App\Models\Category;
use App\Models\Country;
use App\Models\PropertyImages;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'title',
        'category_id',
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

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function country() 
    {
        return $this->belongsTo(Country::class);
    }

    public function propertyImages() 
    {
        return $this->belongsTo(PropertyImages::class);
    }
}

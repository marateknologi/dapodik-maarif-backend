<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;

class Shop extends Model
{
    use HasFactory;
    // protected $table = 'shops';
    protected $fillable = [
        'name',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsToThrough(Country::class, City::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Country extends Model
{
    use HasFactory;
    // protected $table = 'countries';
    protected $fillable = 'name';

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function shops()
    {
        return $this->hasManyThrough(Shop::class, City::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarBrand extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * Car models relationship
     *
     * @return HasMany
     */
    public function models()
    {
        return $this->hasMany(CarModel::class, 'brand_id', 'id');
    }

    /**
     * Cars relationship
     *
     * @return HasMany
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'brand_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * Car brand relationship
     *
     * @return BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(CarBrand::class, 'brand_id', 'id');
    }

    /**
     * Cars relationship
     *
     * @return HasMany
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'model_id', 'id');
    }
}

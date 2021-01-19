<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'color',
        'transmission',
        'price_per_day',
        'number',
        'year_of_manufacture'
    ];

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
     * Car model relationship
     *
     * @return BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(CarModel::class, 'model_id', 'id');
    }
}

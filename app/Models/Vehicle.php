<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'model',
        'year',
        'passenger_amount',
        'manufacturer',
        'price',
        'vehicleable_id',
        'vehicleable_type',
    ];

    /**
     * Get the owning vehicleable model.
     */
    public function vehicleable()
    {
        return $this->morphTo();
    }
}

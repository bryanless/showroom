<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\Vehicle;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'fuel_type',
        'trunk_size',
    ];

    /**
     * Get the vehicle record associated with the car.
     */
    public function vehicle()
    {
        return $this->morphOne(Vehicle::class, 'vehicleable');
    }
}

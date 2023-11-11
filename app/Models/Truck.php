<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\Vehicle;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        'tire_amount',
        'cargo_size',
    ];

    /**
     * Get the vehicle record associated with the truck.
     */
    public function vehicle(): MorphOne
    {
        return $this->morphOne(Vehicle::class, 'vehicleable');
    }
}

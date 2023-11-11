<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\Vehicle;

class Motorbike extends Model
{
    use HasFactory;

    protected $fillable = [
        'trunk_size',
        'fuel_capacity',
    ];

    /**
     * Get the vehicle record associated with the motorbike.
     */
    public function vehicle(): MorphOne
    {
        return $this->morphOne(Vehicle::class, 'vehicleable');
    }
}

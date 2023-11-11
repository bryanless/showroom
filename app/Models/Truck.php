<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        'tire_amount',
        'cargo_size',
    ];

    public function vehicle(): MorphOne
    {
        return $this->morphOne(Vechicle::class, 'vehicleable');
    }
}

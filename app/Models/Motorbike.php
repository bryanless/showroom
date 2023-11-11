<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Motorbike extends Model
{
    use HasFactory;

    protected $fillable = [
        'trunk_size',
        'fuel_capacity',
    ];

    public function vehicle(): MorphOne
    {
        return $this->morphOne(Vechicle::class, 'vehicleable');
    }
}

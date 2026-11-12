<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    protected $fillable = [
        'name',
        'price_per_litre',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price_per_litre' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(FuelBooking::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelBooking extends Model
{
    protected $fillable = [
        'user_id',
        'fuel_type_id',
        'quantity_litres',
        'price_per_litre',
        'total_amount',
        'delivery_address',
        'phone',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quantity_litres' => 'decimal:2',
            'price_per_litre' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }
    public function statusHistory()
{
    return $this->hasMany(BookingStatusHistory::class);
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatusHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fuel_booking_id',
        'changed_by',
        'old_status',
        'new_status',
    ];

    protected function casts(): array
    {
        return ['created_at' => 'datetime'];
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function booking()
    {
        return $this->belongsTo(FuelBooking::class, 'fuel_booking_id');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FuelBooking;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FuelBookingController extends Controller
{
    public function fuelTypes()
    {
        return response()->json([
            'data' => FuelType::where('is_active', true)
                ->orderBy('name')
                ->get()
        ]);
    }

    public function index(Request $request)
    {
        $bookings = FuelBooking::with('fuelType')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fuel_type_id' => [
                'required',
                Rule::exists('fuel_types', 'id')
                    ->where('is_active', true),
            ],
            'quantity_litres' => 'required|numeric|min:1|max:10000',
            'delivery_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $booking = DB::transaction(function () use ($request, $validated) {
            $fuelType = FuelType::whereKey($validated['fuel_type_id'])
                ->where('is_active', true)
                ->lockForUpdate()
                ->firstOrFail();

            // Use decimal-safe arithmetic for money.
            $price = (string) $fuelType->price_per_litre;
            $quantity = number_format(
                (float) $validated['quantity_litres'],
                2,
                '.',
                ''
            );

            $total = bcmul($price, $quantity, 2);

            return FuelBooking::create([
                'user_id' => $request->user()->id,
                'fuel_type_id' => $fuelType->id,
                'quantity_litres' => $quantity,
                'price_per_litre' => $price,
                'total_amount' => $total,
                'delivery_address' => $validated['delivery_address'],
                'phone' => $validated['phone'],
                'status' => 'pending',
            ]);
        });

        return response()->json([
            'message' => 'Fuel booking created successfully',
            'data' => $booking->load('fuelType'),
        ], 201);
    }

    public function show(Request $request, int $id)
    {
        $booking = FuelBooking::with('fuelType')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json([
            'data' => $booking,
        ]);
    }
}

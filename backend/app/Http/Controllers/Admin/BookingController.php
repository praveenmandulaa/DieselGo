<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuelBooking;
use App\Models\BookingStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    private const TRANSITIONS = [
        'pending' => ['confirmed', 'cancelled'],
        'confirmed' => ['out_for_delivery', 'cancelled'],
        'out_for_delivery' => ['delivered'],
        'delivered' => [],
        'cancelled' => [],
    ];

    public function dashboard()
    {
        $stats = [
            'total' => FuelBooking::count(),
            'pending' => FuelBooking::where('status', 'pending')->count(),
            'confirmed' => FuelBooking::where('status', 'confirmed')->count(),
            'delivered' => FuelBooking::where('status', 'delivered')->count(),
        ];

        $bookings = FuelBooking::with(['user', 'fuelType'])
            ->latest()
            ->paginate(10);

        return view('admin.dashboard', compact('stats', 'bookings'));
    }

    
public function index(Request $request)
{
    $search = trim((string) $request->query('search', ''));
    $status = (string) $request->query('status', '');

    $allowedStatuses = [
        'pending',
        'confirmed',
        'out_for_delivery',
        'delivered',
        'cancelled',
    ];

    $query = FuelBooking::query()
        ->with(['user', 'fuelType']);

    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            if (ctype_digit($search)) {
                $q->orWhere('id', (int) $search);
            }

            $q->orWhereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        });
    }

    if (in_array($status, $allowedStatuses, true)) {
        $query->where('status', $status);
    }

    $bookings = $query->latest()
        ->paginate(15)
        ->withQueryString();

    $stats = [
        'total' => FuelBooking::count(),
        'pending' => FuelBooking::where('status', 'pending')->count(),
        'confirmed' => FuelBooking::where('status', 'confirmed')->count(),
        'delivered' => FuelBooking::where('status', 'delivered')->count(),
    ];

    return view('admin.bookings.index', compact(
        'bookings',
        'stats',
        'search',
        'status'
    ));
}

    public function updateStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'confirmed',
                    'out_for_delivery',
                    'delivered',
                    'cancelled',
                ]),
            ],
        ]);

        DB::transaction(function () use ($id, $validated, $request) {
            $booking = FuelBooking::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            $oldStatus = $booking->status;
            $newStatus = $validated['status'];

            if (!in_array(
                $newStatus,
                self::TRANSITIONS[$oldStatus] ?? [],
                true
            )) {
                throw ValidationException::withMessages([
                    'status' => 'Invalid booking status transition.',
                ]);
            }

            $booking->update(['status' => $newStatus]);

            BookingStatusHistory::create([
                'fuel_booking_id' => $booking->id,
                'changed_by' => $request->user()->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
            ]);
        });

        return back()->with(
            'success',
            'Booking status updated successfully.'
        );
    }
}

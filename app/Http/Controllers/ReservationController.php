<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // Show the reservation form for a specific screening
    public function create(Screening $screening)
    {
        return view('reservations.create', compact('screening'));
    }

    // Store a new reservation
    public function store(Request $request, Screening $screening)
    {
        // Validate the input
        $validated = $request->validate([
            'seats' => 'required|integer|min:1',
        ]);

        // Check if enough seats are available
        if ($validated['seats'] > $screening->available_seats) {
            return back()->withErrors(['seats' => 'Nie ma wystarczającej liczby dostępnych miejsc na ten seans.']);
        }

        // Create the reservation
        Reservation::create([
            'screening_id' => $screening->id,
            'user_id' => auth()->id(),
            'seats' => $validated['seats'],
        ]);

        // Subtract reserved seats from available_seats
        $screening->decrement('available_seats', $validated['seats']);

        return redirect()->route('reservations.success')->with('success', 'Rezerwacja została pomyślnie utworzona.');
    }

    // Success page after creating a reservation
    public function success()
    {
        return view('reservations.success');
    }

    // List all reservations for admins
    public function index()
    {
        // Ensure only admins can access this route
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch all reservations with their relationships
        $reservations = Reservation::with(['screening.film', 'user'])->get();

        return view('reservations.index', compact('reservations'));
    }

    // Destroy a reservation
    public function destroy(Reservation $reservation)
    {
        if (auth()->id() !== $reservation->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
    
        $reservation->screening->increment('available_seats', $reservation->seats);
    
        $reservation->delete();
    
        // Redirect to the reservations list or user profile
        return redirect()->route('user.reservations')->with('success', 'Rezerwacja została anulowana.');
    }
    
}

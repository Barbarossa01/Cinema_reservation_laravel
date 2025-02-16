<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;


class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user(); // Logged-in user
        $reservations = $user->reservations()->with('screening.film')->get();

        return view('user.profile', compact('user', 'reservations'));
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        // Update password only if provided
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Dane zostały zaktualizowane.');
    }

    
    public function reservationHistory()
    {
        // Get reservations for the logged-in user
        $reservations = auth()->user()->reservations()->with('screening.film')->get();
        return view('user.reservations', compact('reservations'));
    }
}
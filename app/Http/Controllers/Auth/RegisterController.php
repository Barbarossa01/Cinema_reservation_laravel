<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([


            'email' => [
    'required',
    'email',
    function ($attribute, $value, $fail) {
        $exists = \DB::table('cinema_project_laravel.users')
                    ->where('email', $value)
                    ->exists();
        if ($exists) {
            $fail('The email has already been taken.');
        }
    },
],



            'password' => 'required|min:6|confirmed',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
}

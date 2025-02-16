<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Show dashboard for administrators
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        // Get a list of all users
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function assignAdminRole($userId)
    {
                // Server-side validation
                $validator = Validator::make(['user_id' => $userId], [
                    'user_id' => 'required|exists:users,id'
                ]);
        
                if ($validator->fails()) {
                }        
        // Assign admin role to a user
        Administrator::create(['user_id' => $userId]);
        return redirect()->back()->with('success', 'User promoted to administrator');
    }
}
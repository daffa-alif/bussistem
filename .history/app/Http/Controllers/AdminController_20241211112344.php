<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display all users (role != admin)
    public function users()
{
    if (!auth()->check()) {
        // If user is not authenticated, redirect them to the login page
        return redirect()->route('login');
    }

    // Fetch all non-admin users
    $users = User::where('role', '!=', 'admin')->get();
    
    // Return the 'users.index' view with the users data
    return view('users.index', compact('users'));
}


    // Delete a user
    public function destroy($id)
    {
        // Find the user by id
        $user = User::find($id);

        if ($user) {
            // Delete the user
            $user->delete();
            // Redirect with success message
            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        }

        // If user not found, return error
        return redirect()->route('users.index')->with('error', 'User not found!');
    }
}

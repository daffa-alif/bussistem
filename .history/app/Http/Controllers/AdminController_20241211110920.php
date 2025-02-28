<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display all users (role != admin)
    public function users()
    {
        $users = User::where('role', '!=', 'admin')->get(); // Fetch all non-admin users
        return view('users', compact('users')); // Pass users to the view
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete(); // Delete the user
            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        }

        return redirect()->route('users.index')->with('error', 'User not found!');
    }
}

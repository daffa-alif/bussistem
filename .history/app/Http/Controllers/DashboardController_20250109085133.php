<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the count of users where role is not 'admin'
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Return the dashboard view with the total user count
        return view('dashboard', compact('totalUsers'));
    }

    public function users (){
        return view('users.index');
    }
}


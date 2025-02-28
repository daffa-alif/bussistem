@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
        @if (auth()->user()->role === 'admin')
        <h2 class="text-2xl font-bold mb-4">Admin Overview</h2>
        <p class="mb-4">Welcome to the admin dashboard. Here you can manage the system.</p>
    
        <!-- Stats cards (optional) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-2">Total Users</h3>
                <p class="text-2xl">{{ $totalUsers }}</p> <!-- This is the variable that should be passed -->
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-xl font-semibold mb-2">Active Sessions</h3>
                <p class="text-2xl">567</p>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-xl font-semibold mb-2">Revenue</h3>
                <p class="text-2xl">$4,567</p>
            </div>
        </div>
    
        <!-- More content (tables, charts, etc.) -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold mb-4">Recent Activity</h3>
            <!-- Add your activity data or other content here -->
        </div>
        @else
            <p class="text-blue-500 text-lg">Hello, User!</p>
            
        @endif
    </div>
@endsection

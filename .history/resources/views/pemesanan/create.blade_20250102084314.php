@extends('layouts.app')

@section('title', 'Create Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create Pemesanan</h1>

    <form action="{{ route('pemesanan.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="id_jadwal" class="block text-sm font-medium text-gray-700">Jadwal</label>
            <select name="id_jadwal" id="id_jadwal" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Jadwal</option>
                @foreach($jadwal as $jad)
                    <option value="{{ $jad->id_jadwal }}">{{ $jad->detail }}</option>
                @endforeach
            </select>
            
            @error('id_jadwal')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="w-full border rounded px-3 py-2" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
                <option value="booking">Booking</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create</button>
    </form>
@endsection

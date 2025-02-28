@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Pemesanan</h1>

    <form action="{{ route('pemesanan.update', $pemesanan->id_pemesanan) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="id_jadwal" class="block text-sm font-medium text-gray-700">Jadwal</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="id_jadwal" name="id_jadwal" required>
                <option value="" disabled>Pilih Jadwal</option>
                @foreach ($jadwal as $j)
                    <option value="{{ $j->id_jadwal }}" {{ $j->id_jadwal == $pemesanan->id_jadwal ? 'selected' : '' }}>
                        {{ $j->nama_jadwal }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="id_pengguna" class="block text-sm font-medium text-gray-700">Pengguna</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="id_pengguna" name="id_pengguna">
                <option value="" disabled>Pilih Pengguna</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id_pengguna }}" {{ $user->id_pengguna == $pemesanan->id_pengguna ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" id="status" name="status" required>
                <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $pemesanan->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $pemesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="booking" {{ $pemesanan->status == 'booking' ? 'selected' : '' }}>Booking</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Update
            </button>
            <a href="{{ route('pemesanan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm hover:bg-gray-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

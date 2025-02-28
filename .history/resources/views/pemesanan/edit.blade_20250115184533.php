@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pemesanan</h1>

    <form action="{{ route('pemesanan.update', $pemesanan->id_pemesanan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_jadwal" class="form-label">Jadwal</label>
            <select class="form-select" id="id_jadwal" name="id_jadwal" required>
                <option value="" disabled>Pilih Jadwal</option>
                @foreach ($jadwal as $j)
                    <option value="{{ $j->id_jadwal }}" {{ $j->id_jadwal == $pemesanan->id_jadwal ? 'selected' : '' }}>
                        {{ $j->nama_jadwal }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_pengguna" class="form-label">Pengguna</label>
            <select class="form-select" id="id_pengguna" name="id_pengguna">
                <option value="" disabled>Pilih Pengguna</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id_pengguna }}" {{ $user->id_pengguna == $pemesanan->id_pengguna ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Dropdown -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $pemesanan->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $pemesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="booking" {{ $pemesanan->status == 'booking' ? 'selected' : '' }}>Booking</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Create Pemesanan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create Pemesanan</h1>

    <form action="{{ route('detail_pemesanan.store', $pemesanan->id_pemesanan) }}" method="POST">
        @csrf
        <div>
            <label for="id_kursi_bus">Kursi Bus</label>
            <select name="id_kursi_bus" required>
                <!-- Populate with available kursi_bus -->
            </select>
        </div>
        <div>
            <label for="nama_penumpang">Nama Penumpang</label>
            <input type="text" name="nama_penumpang" required>
        </div>
        <div>
            <label for="nomor_identitas">Nomor Identitas</label>
            <input type="text" name="nomor_identitas" required>
        </div>
        <div>
            <label for="harga_kursi">Harga Kursi</label>
            <input type="number" step="0.01" name="harga_kursi" required>
        </div>
        <div>
            <label for="total_harga">Total Harga</label>
            <input type="number" step="0.01" name="total_harga" required>
        </div>
        <button type="submit">Save</button>
    </form>
    
@endsection

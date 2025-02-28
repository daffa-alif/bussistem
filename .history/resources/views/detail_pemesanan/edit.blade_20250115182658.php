@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Detail Pemesanan</h1>

    <form action="{{ route('detail_pemesanan.update', $detailPemesanan->id_detail_pemesanan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_penumpang" class="form-label">Nama Penumpang</label>
            <input type="text" class="form-control" id="nama_penumpang" name="nama_penumpang" value="{{ $detailPemesanan->nama_penumpang }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_identitas" class="form-label">Nomor Identitas</label>
            <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" value="{{ $detailPemesanan->nomor_identitas }}" required>
        </div>

        <div class="mb-3">
            <label for="id_kursi_bus" class="form-label">Kursi</label>
            <select class="form-select" id="id_kursi_bus" name="id_kursi_bus" required>
                <option value="" disabled>Pilih Kursi</option>
                @foreach ($kursiBus as $kursi)
                    <option value="{{ $kursi->id_kursi }}" {{ $kursi->id_kursi == $detailPemesanan->id_kursi_bus ? 'selected' : '' }}>
                        {{ $kursi->nomor_kursi }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('detail_pemesanan.index', $pemesanan->id_pemesanan) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

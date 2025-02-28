@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="modal">
        <form class="form" action="{{ route('bayar.confirm', $pemesanan->id_pemesanan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="text-2xl font-semibold text-center mb-4">Confirm Payment for Booking #{{ $pemesanan->id_pemesanan }}</h1>

            <!-- Display Total Harga -->
            <p class="text-xl font-bold text-center mb-4">Total Harga: Rp. {{ number_format($hargaTotal, 2, ',', '.') }}</p>

            <!-- File input for Bukti Pembayaran (Payment Proof) -->
            <div class="input_container">
                <label for="bukti_pembayaran" class="input_label">Bukti Pembayaran (Payment Proof)</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="input_field">
            </div>

            <!-- Payment Confirmation Button -->
            <button type="submit" class="purchase--btn">
                Confirm Payment
            </button>

            <p class="separator mt-4">
                <span class="line"></span>
                <span>Once payment is confirmed, your booking status will be updated to "Confirmed".</span>
                <span class="line"></span>
            </p>
        </form>
    </div>
</div>
@endsection

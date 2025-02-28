@extends('layouts.app')

@section('content')
<div class="container min-h-screen flex justify-center items-center">
    <div class="card rounded-lg p-6">
        <!-- Title -->
        <div class="title">
            <h1>Confirm Payment for Booking #{{ $pemesanan->id_pemesanan }}</h1>
        </div>

        <!-- Display Total Harga -->
        <div class="cart steps">
            <div class="step">
                <span>Total Harga:</span>
                <p class="price">Rp. {{ number_format($hargaTotal, 2, ',', '.') }}</p>
            </div>
        </div>

        <hr>

        <!-- Payment Form -->
        <form action="{{ route('bayar.confirm', $pemesanan->id_pemesanan) }}" method="POST" enctype="multipart/form-data" class="promo">
            @csrf
            
            <!-- File input for Bukti Pembayaran (Payment Proof) -->
            <div class="mb-4">
                <label for="bukti_pembayaran" class="block text-sm font-semibold mb-2">Bukti Pembayaran (Payment Proof)</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="input_field">
            </div>

            <!-- Payment Confirmation Button -->
            <div class="checkout footer">
                <button type="submit" class="checkout-btn">Confirm Payment</button>
            </div>
        </form>

        <!-- Additional Information -->
        <p class="mt-4 text-center">Once payment is confirmed, your booking status will be updated to "Confirmed".</p>
    </div>
</div>
@endsection

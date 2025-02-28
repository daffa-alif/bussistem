@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-lg border border-gray-200">
        <!-- Payment Card Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Confirm Payment</h1>
            <p class="text-sm text-gray-500">Booking ID: <span class="font-semibold">#{{ $pemesanan->id_pemesanan }}</span></p>
        </div>

        <!-- Total Harga -->
        <div class="bg-blue-50 rounded-lg p-4 text-center mb-6">
            <p class="text-lg font-semibold text-blue-600">Total Harga</p>
            <p class="text-2xl font-bold text-blue-700">Rp. {{ number_format($hargaTotal, 2, ',', '.') }}</p>
        </div>

        <!-- QR Code Section -->
        <div class="text-center mb-6">
            <p class="text-sm text-gray-500 mb-2">Scan the QR Code below to make the payment:</p>
            <div class="flex justify-center">
                <img src="{{ $qrCodeUrl }}" alt="QR Code for Payment" class="w-40 h-40">
            </div>
        </div>

        <!-- Payment Form -->
        <form action="{{ route('bayar.confirm', $pemesanan->id_pemesanan) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- File Input for Bukti Pembayaran -->
            <div class="mb-4">
                <label for="bukti_pembayaran" class="block text-sm font-semibold text-gray-600 mb-2">Bukti Pembayaran (Payment Proof)</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Payment Confirmation Button -->
            <button type="submit" class="text-white bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700 w-full">
                Confirm Payment
            </button>
        </form>

        <!-- Footer Note -->
        <p class="mt-4 text-center text-sm text-gray-500">Once payment is confirmed, your booking status will be updated to <span class="font-semibold">"Confirmed"</span>.</p>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg">
            <h1 class="text-2xl font-semibold mb-4 text-center">Confirm Payment for Booking #{{ $pemesanan->id_pemesanan }}</h1>

            <!-- Display QR Code for Payment with larger size -->
            <img src="https://via.placeholder.com/600x600.png?text=QR+Payment+Image" alt="QR Payment" class="w-full h-auto object-contain mb-4">

            <!-- Payment Form -->
            <form action="{{ route('bayar.confirm', $pemesanan->id_pemesanan) }}" method="POST">
                @csrf
                
                <!-- File input for Bukti Pembayaran (Payment Proof) -->
                <div class="mb-4">
                    <label for="bukti_pembayaran" class="block text-sm font-semibold mb-2">Bukti Pembayaran (Payment Proof)</label>
                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="border border-gray-300 rounded-lg p-2 w-full" disabled>
                </div>

                <!-- Payment Confirmation Button -->
                <button type="submit" class="text-white bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 w-full">
                    Confirm Payment
                </button>
            </form>

            <p class="mt-4 text-center">Once payment is confirmed, your booking status will be updated to "Confirmed".</p>
        </div>
    </div>
@endsection

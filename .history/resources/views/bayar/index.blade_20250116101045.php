@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg">
            <h1 class="text-2xl font-semibold mb-4 text-center">Confirm Payment for Booking #{{ $pemesanan->id_pemesanan }}</h1>

            <!-- Display QR Code for Payment (empty placeholder image) -->
            <img src="data:image/png;base64,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" alt="QR Payment" class="w-full h-40 object-cover mb-4">

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

@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Payment</h1>

    @if($pemesanan->status == 'confirmed')
        <div class="bg-white shadow-lg rounded-lg p-6 mb-4">
            <h2 class="text-xl font-bold mb-4">Please Make Payment</h2>

            <!-- Payment QR Code Section -->
            <div class="flex flex-col items-center mb-4">
                <img src="{{ asset('images/payment-qr.png') }}" alt="QR Code" class="w-48 h-48 mb-4">
                <p class="text-lg">Scan the QR code to complete your payment.</p>
            </div>

            <!-- Payment Form (File input for display) -->
            <form action="{{ route('bayar.update', $pemesanan->id_pemesanan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="payment_proof" class="block text-gray-700">Upload Payment Proof</label>
                    <input type="file" id="payment_proof" name="payment_proof" class="mt-2 p-2 border rounded-lg w-full" />
                </div>

                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    Confirm Payment
                </button>
            </form>
        </div>
    @elseif($pemesanan->status == 'cancelled')
        <div class="bg-gray-300 p-6 rounded-lg">
            <p class="text-lg">This booking has been cancelled. No payment is required.</p>
        </div>
    @else
        <div class="bg-gray-300 p-6 rounded-lg">
            <p class="text-lg">Your booking is in status: {{ $pemesanan->status }}. Payment not yet required.</p>
        </div>
    @endif
@endsection

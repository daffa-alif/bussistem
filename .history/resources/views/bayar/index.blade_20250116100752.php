@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Confirm Payment for Booking #{{ $pemesanan->id_pemesanan }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-4">
        <!-- Display QR Code for Payment (empty placeholder image) -->
        <img src="https://via.placeholder.com/500x300.png?text=QR+Payment+Image" alt="QR Payment" class="w-full h-40 object-cover mb-4">

        <form action="{{ route('bayar.confirm', $pemesanan->id_pemesanan) }}" method="POST">
            @csrf
            <!-- Payment Confirmation Button -->
            <button type="submit" class="text-white bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">
                Confirm Payment
            </button>
        </form>
    </div>

    <p class="mt-4">Once payment is confirmed, your booking status will be updated to "Confirmed".</p>
@endsection

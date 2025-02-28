@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f4;">
    <!-- Main Container -->
    <div style="width: 400px; background: #F4E2DE; box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1); border-radius: 20px; overflow: hidden;">
        <!-- Header -->
        <div style="width: 100%; height: 50px; display: flex; align-items: center; justify-content: center; background-color: #ECC2C0; font-weight: bold; font-size: 16px; color: #000;">
            CONFIRM PAYMENT
        </div>

        <!-- Content -->
        <div style="padding: 20px;">
            <!-- Booking Information -->
            <div style="margin-bottom: 20px;">
                <span style="font-size: 14px; font-weight: bold; color: #000;">BOOKING</span>
                <p style="font-size: 12px; color: #000; margin: 5px 0;">Booking ID: #{{ $pemesanan->id_pemesanan }}</p>
            </div>
            <hr style="border: 0; height: 1px; background-color: #E5C7C5; margin: 20px 0;">

            <!-- Total Price -->
            <div style="margin-bottom: 20px;">
                <span style="font-size: 14px; font-weight: bold; color: #000;">TOTAL PRICE</span>
                <p style="font-size: 16px; font-weight: bold; color: #000; margin: 5px 0;">Rp. {{ number_format($hargaTotal, 2, ',', '.') }}</p>
            </div>
            <hr style="border: 0; height: 1px; background-color: #E5C7C5; margin: 20px 0;">

            <!-- QR Code -->
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ asset('images/qr-code-example.png') }}" alt="QR Code" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <hr style="border: 0; height: 1px; background-color: #E5C7C5; margin: 20px 0;">

            <!-- File Upload -->
            <div style="margin-bottom: 20px;">
                <span style="font-size: 14px; font-weight: bold; color: #000;">UPLOAD PAYMENT PROOF</span>
                <form action="{{ route('bayar.confirm', $pemesanan->id_pemesanan) }}" method="POST" enctype="multipart/form-data" style="display: grid; grid-template-columns: 1fr auto; gap: 10px; margin-top: 10px;">
                    @csrf
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" style="height: 36px; padding: 0 10px; border: 1px solid #E5C7C5; border-radius: 5px; background-color: #F4E2DE;">
                    <button type="submit" style="background: #F3D2C9; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; font-size: 12px; color: #000;">Upload</button>
                </form>
            </div>
            <hr style="border: 0; height: 1px; background-color: #E5C7C5; margin: 20px 0;">

            <!-- Confirmation Message -->
            <div style="font-size: 12px; color: #000; text-align: center;">
                Once payment is confirmed, your booking will be updated to <strong>"Confirmed"</strong>.
            </div>
        </div>

        <!-- Footer -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #ECC2C0;">
            <span style="font-size: 18px; font-weight: bold; color: #2B2B2F;">Rp. {{ number_format($hargaTotal, 2, ',', '.') }}</span>
            <button type="submit" style="width: 120px; height: 36px; background: #F3D2C9; border: none; border-radius: 5px; font-weight: bold; font-size: 12px; color: #000;">Confirm Payment</button>
        </div>
    </div>
</div>
@endsection

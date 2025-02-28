@extends('layouts.app')

@section('title', 'Your Bookings')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Your Bookings</h1>

    <div class="grid grid-cols-1 gap-4">
        @forelse ($pemesanan as $item)
            <div class="border rounded-lg shadow p-4">
                <h2 class="text-xl font-bold mb-2">User: {{ $item->user->nama ?? 'N/A' }}</h2>
                <p><strong>Jadwal:</strong> {{ $item->jadwal->detail ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $item->status }}</p>
                <p><strong>Tanggal Pemesanan:</strong> {{ $item->tanggal_pemesanan }}</p>

                <div class="mt-4">
                    @if ($item->status !== 'cancelled' && $item->status !== 'confirmed' && $item->status !== 'booking')
                        <!-- Bayar Button: Redirects to bayar.index -->
                        <a href="{{ route('bayar.index', $item->id_pemesanan) }}" class="text-blue-500">Bayar</a>
                        <form action="{{ route('pemesanan.cancel.get', $item->id_pemesanan) }}" method="get" class="inline-block">
                            @csrf
                            <button type="submit" class="text-red-500 hover:underline">Cancel</button>
                        </form>
                    @elseif ($item->status === 'booking')
                        <b style="color: green">wait for it to be confirmed</b>

                    @elseif ($item->status === 'confirmed')
                        <!-- Show QR Code and File Input for confirmed -->
                        <div class="card mt-2">
                            <p class="mt-2 text-green-500">Payment Confirmed. Nikmati Perjalananmu!</p>
                        </div>
                    @elseif ($item->status === 'cancelled')
                        <!-- Cancelled status, no payment needed -->
                        <p class="text-gray-500">This booking was cancelled. No payment needed.</p>
                    @endif

                    @if ($item->status !== 'cancelled')
                        <a href="{{ route('detail_pemesanan.index', $item->id_pemesanan) }}" class="text-blue-500 ml-4">Detail Pemesanan</a>
                    @else
                        <span class="text-gray-500">Cancelled</span>
                    @endif
                </div>

                <!-- Countdown Timer for Pending Bookings -->
                @if ($item->status === 'pending')
                    <div class="mt-2 countdown-container" id="countdown-{{ $item->id_pemesanan }}" data-created-at="{{ $item->tanggal_pemesanan }}">
                        <p>Time remaining: <span class="countdown-timer">15:00</span> minutes</p>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500">No bookings found.</p>
        @endforelse
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownElements = document.querySelectorAll('.countdown-container');

            countdownElements.forEach(function(element) {
                const createdAt = new Date(element.dataset.createdAt);
                const countdownTimer = element.querySelector('.countdown-timer');

                function updateCountdown() {
                    const currentTime = new Date();
                    const timeDiff = currentTime - createdAt;
                    const minutesElapsed = Math.floor(timeDiff / 60000);  // Get minutes elapsed
                    const remainingMinutes = 15 - minutesElapsed;

                    if (remainingMinutes <= 0) {
                        countdownTimer.textContent = '00:00';
                        // Automatically cancel the booking
                        cancelBooking(element);
                    } else {
                        const minutes = String(remainingMinutes).padStart(2, '0');
                        countdownTimer.textContent = `${minutes}:00`;
                    }
                }

                function cancelBooking(element) {
                    const bookingId = element.id.replace('countdown-', '');
                    const cancelForm = document.createElement('form');
                    cancelForm.method = 'POST';
                    cancelForm.action = `/pemesanan/${bookingId}/cancel`;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    cancelForm.appendChild(csrfToken);

                    document.body.appendChild(cancelForm);
                    cancelForm.submit();
                }

                updateCountdown();  // Initial update
                setInterval(updateCountdown, 60000);  // Update every minute
            });
        });
    </script>
@endsection

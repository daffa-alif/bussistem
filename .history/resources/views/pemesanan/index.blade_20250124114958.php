@extends('layouts.app')

@section('title', auth()->user()->role === 'admin' ? 'Pemesanan List' : 'Your Bookings')

@section('content')
    @if (auth()->user()->role === 'admin')
        <h1 class="text-2xl font-semibold mb-4">Pemesanan List</h1>

        {{-- Delete All Cancelled Button --}}
        <div class="mb-4">
            <form action="{{ route('pemesanan.deleteCancelled') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-4 py-2">Delete All Cancelled</button>
            </form>
        </div>

        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Jadwal</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Tanggal Pemesanan</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanan as $key => $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $key + 1 }}</td>
                        <td class="border px-4 py-2">{{ $item->user->nama ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $item->jadwal->detail ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $item->status }}</td>
                        <td class="border px-4 py-2">{{ $item->tanggal_pemesanan }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('detail_pemesanan.create', $item->id_pemesanan) }}" class="btn btn-primary">Lanjut</a>
                            <a href="{{ route('detail_pemesanan.index', $item->id_pemesanan) }}" class="text-blue-500">Detail Pemesanan</a> |
                            <a href="{{ route('pemesanan.edit', $item->id_pemesanan) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('pemesanan.destroy', $item->id_pemesanan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                            @if ($item->status === 'booking')
                            <form action="{{ route('pemesanan.confirmPayment', $item->id_pemesanan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Confirm Payment</button>
                            </form>
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <h1 class="text-2xl font-semibold mb-4">Your Bookings</h1>

   <div class="grid grid-cols-1 gap-4">
    @forelse ($pemesanan as $item)
        <div class="border rounded-lg shadow p-4">
            <h2 class="text-xl font-bold mb-2">User: {{ $item->user->nama ?? 'N/A' }}</h2>
            <p><strong>Jadwal:</strong> {{ $item->jadwal->detail ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ $item->status }}</p>
            <p><strong>Tanggal Pemesanan:</strong> {{ $item->tanggal_pemesanan }}</p>
            
            <div class="mt-4">
                @if ($item->status === 'pending')
                    <!-- Countdown Timer for Pending Booking -->
                    <div id="countdown-{{ $item->id_pemesanan }}">
                        <span id="countdown-time-{{ $item->id_pemesanan }}"></span>
                    </div>
                    <script>
                        const deadline = new Date("{{ $item->tanggal_pemesanan }}").getTime() + 15 * 60 * 1000; // 15 minutes from pemesanan

                        function updateCountdown() {
                            const now = new Date().getTime();
                            const distance = deadline - now;

                            const minutes = Math.floor(distance / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            // Update countdown display
                            document.getElementById("countdown-time-{{ $item->id_pemesanan }}").innerHTML = minutes + "m " + seconds + "s ";

                            // If countdown ends, update status to cancelled and stop the countdown
                            if (distance <= 0) {
                                clearInterval(countdownInterval);
                                
                                // Optionally, you can use AJAX to update the status without page reload
                                window.location.reload();  // Reload page to reflect the change to "cancelled"
                            }
                        }

                        // Run countdown every second
                        const countdownInterval = setInterval(updateCountdown, 1000);
                    </script>
                @elseif ($item->status === 'booking')
                    <b style="color: green">Wait for it to be confirmed</b>

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
                    @if ($item->status !== 'confirmed' && $item->status !== 'booking')
                        <a href="{{ route('bayar.index', $item->id_pemesanan) }}" class="text-blue-500">Bayar</a>
                        <form action="{{ route('pemesanan.cancel.get', $item->id_pemesanan) }}" method="get" class="inline-block">
                            @csrf
                            <button type="submit" class="text-red-500 hover:underline">Cancel</button>
                        </form>
                    @endif
                @else
                    <span class="text-gray-500">Cancelled</span>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-500">No bookings found.</p>
    @endforelse
</div>

    
    @endif
@endsection

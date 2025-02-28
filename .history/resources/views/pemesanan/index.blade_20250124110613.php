@extends('layouts.app')

@section('title', auth()->user()->role === 'admin' ? 'Pemesanan List' : 'Your Bookings')

@section('content')
    @if (auth()->user()->role === 'admin')
        <h1 class="text-2xl font-semibold mb-4">Pemesanan List</h1>
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Jadwal</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Tanggal Pemesanan</th>
                    <th class="px-4 py-2">Actions</th>
                    <th class="px-4 py-2">Countdown</th> <!-- Added countdown column -->
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
                            <!-- Actions like edit, delete, etc. -->
                        </td>
                        <td class="border px-4 py-2">
                            <span class="countdown" data-created-at="{{ $item->created_at }}">{{ $item->remaining_time }} minutes left</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-2xl font-semibold mb-4">Your Bookings</h1>
        <div class="grid grid-cols-1 gap-4">
            @foreach ($pemesanan as $item)
                <div class="border rounded-lg shadow p-4">
                    <h2 class="text-xl font-bold mb-2">User: {{ $item->user->nama ?? 'N/A' }}</h2>
                    <p><strong>Jadwal:</strong> {{ $item->jadwal->detail ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $item->status }}</p>
                    <p><strong>Tanggal Pemesanan:</strong> {{ $item->tanggal_pemesanan }}</p>
                    <div class="mt-4">
                        <span class="countdown" data-created-at="{{ $item->created_at }}">{{ $item->remaining_time }} minutes left</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countdownElements = document.querySelectorAll('.countdown');

            countdownElements.forEach(function (element) {
                const createdAt = element.getAttribute('data-created-at');
                const createdAtTime = new Date(createdAt);
                const deadline = new Date(createdAtTime.getTime() + 15 * 60 * 1000); // 15 minutes after created_at

                // Update countdown every second
                setInterval(function () {
                    const now = new Date();
                    const remainingTime = deadline - now;
                    const remainingMinutes = Math.floor(remainingTime / 60000);
                    const remainingSeconds = Math.floor((remainingTime % 60000) / 1000);

                    if (remainingTime <= 0) {
                        element.innerHTML = 'Booking cancelled';
                        return; // Stop countdown when time is up
                    }

                    element.innerHTML = `${remainingMinutes}m ${remainingSeconds}s left`;
                }, 1000);
            });
        });
    </script>
@endsection

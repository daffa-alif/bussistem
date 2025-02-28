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
   public function index()
    {
        if (auth()->user()->role === 'admin') {
            $pemesanan = Pemesanan::with(['user', 'jadwal'])
                ->orderBy('tanggal_pemesanan', 'desc')
                ->get();
        } else {
            $pemesanan = Pemesanan::with(['user', 'jadwal'])
                ->where('id_pengguna', auth()->id())
                ->orderBy('tanggal_pemesanan', 'desc')
                ->get();
        }

        // Automatically update status to cancelled if booking is pending for more than 15 minutes
        Pemesanan::where('status', 'pending')
            ->where('tanggal_pemesanan', '<', Carbon::now()->subMinutes(15))
            ->update(['status' => 'cancelled']);

        return view('pemesanan.index', compact('pemesanan'));
    }
    </div>
    
    @endif
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Admin Panel - Confirm Payments</h1>

    <!-- Display success message -->
    @if(session('status'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('status') }}
        </div>
    @endif

    <!-- Table to show booking data -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="text-left p-3">Booking ID</th>
                    <th class="text-left p-3">User</th>
                    <th class="text-left p-3">Total Harga</th>
                    <th class="text-left p-3">Bukti Pembayaran</th>
                    <th class="text-left p-3">Status</th>
                    <th class="text-left p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanans as $pemesanan)
                <tr class="border-b">
                    <td class="p-3">{{ $pemesanan->id }}</td>
                    <td class="p-3">{{ $pemesanan->user->name }}</td>
                    <td class="p-3">Rp. {{ number_format($pemesanan->detail_pemesanans->sum('harga_kursi'), 2, ',', '.') }}</td>
                    
                    <!-- Bukti Pembayaran -->
                    <td class="p-3">
                        @if($pemesanan->bukti_pembayaran && $pemesanan->bukti_pembayaran->file_name)
                            <a href="{{ asset('storage/bukti_pembayaran/' . $pemesanan->bukti_pembayaran->file_name) }}" target="_blank">
                                <img src="{{ asset('storage/' . $pemesanan->bukti_pembayaran->file_name) }}" 
                                     alt="Bukti Pembayaran" class="w-20 h-20 object-cover rounded-lg border">
                            </a>
                        @else
                            <span class="text-gray-500">No proof uploaded</span>
                        @endif
                    </td>
                    
                    

                    <!-- Status -->
                    <td class="p-3">
                        <span class="px-2 py-1 text-sm font-semibold text-yellow-700 bg-yellow-100 rounded">
                            {{ ucfirst($pemesanan->status) }}
                        </span>
                    </td>

                    <!-- Confirm Button -->
                    <td class="p-3">
                        <form action="{{ route('admin.pembayaran.confirm', ['id_pemesanan' => $pemesanan->id_pemesanan]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Confirm
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

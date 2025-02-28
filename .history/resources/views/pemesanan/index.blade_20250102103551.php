@extends('layouts.app')

@section('title', 'Pemesanan List')

@section('content')
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
                        @if($item->detail_pemesanan->isEmpty())
                            <a href="{{ route('detail_pemesanan.create', $item->id_pemesanan) }}" class="btn btn-primary">Lanjut</a>
                        @else
                            <button type="button" class="text-blue-500" data-modal-toggle="detailModal{{ $item->id_pemesanan }}">View</button>
                        @endif
                        <a href="{{ route('pemesanan.edit', $item->id_pemesanan) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('pemesanan.destroy', $item->id_pemesanan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for Detail Pemesanan -->
                <div id="detailModal{{ $item->id_pemesanan }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                        <h2 class="text-xl font-semibold mb-4">Detail Pemesanan</h2>
                        <p><strong>Nama Penumpang:</strong> {{ $item->detail_pemesanan->nama_penumpang ?? 'N/A' }}</p>
                        <p><strong>Nomor Identitas:</strong> {{ $item->detail_pemesanan->nomor_identitas ?? 'N/A' }}</p>
                        <p><strong>Harga Kursi:</strong> {{ $item->detail_pemesanan->harga_kursi ?? 'N/A' }}</p>
                        <p><strong>Total Harga:</strong> {{ $item->detail_pemesanan->total_harga ?? 'N/A' }}</p>
                        <button type="button" class="mt-4 text-white bg-red-500 py-2 px-4 rounded-lg" data-modal-toggle="detailModal{{ $item->id_pemesanan }}">Close</button>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
    <script>
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-toggle');
                const modal = document.getElementById(modalId);
                modal.classList.toggle('hidden');
            });
        });
    </script>
@endsection

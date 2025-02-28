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
                    <td class="p-3">{{ $pemesanan->id_pemesanan }}</td>
                    <td class="p-3">{{ $pemesanan->user->nama }}</td>
                    <td class="p-3">Rp. {{ number_format($pemesanan->detail_pemesanans->sum('harga_kursi'), 2, ',', '.') }}</td>
                    
                    <!-- Bukti Pembayaran -->
                    <td class="p-3">
                        @if($pemesanan->bukti_pembayaran && $pemesanan->bukti_pembayaran->file_name)
                            <!-- Image thumbnail -->
                            <img src="{{ asset('storage/bukti_pembayaran/' . $pemesanan->bukti_pembayaran->file_name) }}" 
                                 alt="Bukti Pembayaran" class="w-20 h-20 object-cover rounded-lg border cursor-pointer" 
                                 onclick="openModal('{{ asset('storage/bukti_pembayaran/' . $pemesanan->bukti_pembayaran->file_name) }}')">
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

<!-- Modal for Image Zoom -->
<div id="imageModal" class="modal hidden">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="zoomImage" src="" alt="Bukti Pembayaran" class="zoomed-image">
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Basic Modal Styles */
    .modal {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5); /* Black with opacity */
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Adjust the modal width */
        position: relative;
    }

    /* Close Button */
    .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 25px;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Image Zoom Styles */
    .zoomed-image {
        max-width: 100%;
        max-height: 70vh;
        margin: 0 auto;
        display: block;
    }
</style>
@endpush

@push('scripts')
<script>
    // Open Modal with Image
    function openModal(imageSrc) {
        var modal = document.getElementById('imageModal');
        var modalImage = document.getElementById('zoomImage');
        modal.style.display = "block"; // Show the modal
        modalImage.src = imageSrc; // Set the image in the modal
    }

    // Close Modal
    function closeModal() {
        var modal = document.getElementById('imageModal');
        modal.style.display = "none"; // Hide the modal
    }

    // Close the modal if the user clicks outside of the modal content
    window.onclick = function(event) {
        var modal = document.getElementById('imageModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endpush

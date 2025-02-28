@extends('layouts.app')

@section('title', 'Add Harga')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Add Harga</h2>

        <form action="{{ route('harga.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_rute" class="block text-gray-700 font-bold mb-2">Rute:</label>
                <select name="id_rute" id="id_rute" class="w-full border rounded p-2">
                    <option value="">Select Rute</option>
                    @foreach($rutes as $rute)
                        <option value="{{ $rute->id_rute }}">{{ $rute->tujuan }}</option>
                    @endforeach
                </select>
                @error('id_rute')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_kelas" class="block text-gray-700 font-bold mb-2">Kelas:</label>
                <select name="id_kelas" id="id_kelas" class="w-full border rounded p-2">
                    <option value="">Select Kelas</option>
                    @foreach($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id_kelas }}">{{ $kelasItem->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('id_kelas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-gray-700 font-bold mb-2">Harga:</label>
                <input type="number" name="harga" id="harga" class="w-full border rounded p-2" value="{{ old('harga') }}">
                @error('harga')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
        </form>
    </div>
@endsection

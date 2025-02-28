@extends('layouts.app')

@section('title', 'Add Kelas')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Add Kelas</h2>
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_kelas" class="block text-gray-700 font-bold mb-2">Nama Kelas:</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="w-full border rounded p-2" value="{{ old('nama_kelas') }}">
                @error('nama_kelas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
        </form>
    </div>
@endsection

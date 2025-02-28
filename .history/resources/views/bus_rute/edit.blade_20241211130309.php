@extends('layouts.app')

@section('title', 'Edit Bus Rute')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Bus Rute</h2>
        <form action="{{ route('bus_rute.update', $busRute->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="bus_id" class="block text-gray-700 font-bold mb-2">Bus:</label>
                <select name="bus_id" id="bus_id" class="w-full border rounded p-2">
                    <option value="">Select a Bus</option>
                    @foreach($buses as $bus)
                        <option value="{{ $bus->id }}" {{ $busRute->bus_id == $bus->id ? 'selected' : '' }}>
                            {{ $bus->nama_bus }}
                        </option>
                    @endforeach
                </select>
                @error('bus_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="rute_id" class="block text-gray-700 font-bold mb-2">Rute:</label>
                <select name="rute_id" id="rute_id" class="w-full border rounded p-2">
                    <option value="">Select a Rute</option>
                    @foreach($rutes as $rute)
                        <option value="{{ $rute->id_rute }}" {{ $busRute->rute_id == $rute->id_rute ? 'selected' : '' }}>
                            {{ $rute->tujuan }}
                        </option>
                    @endforeach
                </select>
                @error('rute_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Bus')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Bus</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bus.update', $busRute->id_bus_rute) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="id_bus" class="block text-gray-700 font-bold mb-2">Bus:</label>
                <select name="id_bus" id="id_bus" class="w-full border rounded p-2">
                    <option value="">Select a Bus</option>
                    @foreach($buses as $bus)
                        <option value="{{ $bus->id_bus }}" @if($bus->id_bus == $busRute->id_bus) selected @endif>{{ $bus->nama_bus }}</option>
                    @endforeach
                </select>
                @error('id_bus')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="id_rute" class="block text-gray-700 font-bold mb-2">Route:</label>
                <select name="id_rute" id="id_rute" class="w-full border rounded p-2">
                    <option value="">Select a Route</option>
                    @foreach($rutes as $rute)
                        <option value="{{ $rute->id_rute }}" @if($rute->id_rute == $busRute->id_rute) selected @endif>{{ $rute->tujuan }}</option>
                    @endforeach
                </select>
                @error('id_rute')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
        </form>
        
    </div>
@endsection

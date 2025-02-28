@extends('layouts.app')

@section('title', 'Bus Rute List')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Bus Rute</h2>
        <a href="{{ route('bus_rute.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Bus Rute</a>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white shadow-md rounded mt-4">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Bus</th>
                    <th class="px-4 py-2 text-left">Rute</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($busRutes as $busRute)
    <tr>
        <td>{{ $busRute->bus->nama_bus }}</td>
        <td>{{ $busRute->rute->asal }} - {{ $busRute->rute->tujuan }}</td>
        <td>
            <!-- Ensure that the ID is passed to the edit route -->
            <a href="{{ route('bus_rute.edit', $busRute->id) }}" class="btn btn-primary">Edit</a>
            <!-- Similarly, you can add the delete link -->
        </td>
    </tr>
@endforeach

            </tbody>
        </table>
    </div>
@endsection

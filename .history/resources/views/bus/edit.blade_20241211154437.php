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

        <a href="{{ route('bus_rute.edit', $item->id_bus_rute) }}" class="text-blue-500 hover:text-blue-700">Edit</a>

    </div>
@endsection

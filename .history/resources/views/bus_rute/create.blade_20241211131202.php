<form action="{{ route('bus_rute.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label for="bus_id" class="block text-sm font-medium text-gray-700">Bus</label>
        <select name="bus_id" id="bus_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Select a Bus</option>
            @foreach($buses as $bus)
                <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                    {{ $bus->nama_bus }}
                </option>
            @endforeach
        </select>
        @error('bus_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="rute_id" class="block text-sm font-medium text-gray-700">Rute</label>
        <select name="rute_id" id="rute_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Select a Rute</option>
            @foreach($rutes as $rute)
                <option value="{{ $rute->id }}" {{ old('rute_id') == $rute->id ? 'selected' : '' }}>
                    {{ $rute->asal }} to {{ $rute->tujuan }}
                </option>
            @endforeach
        </select>
        @error('rute_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="submit" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            Create Bus Rute
        </button>
    </div>
</form>

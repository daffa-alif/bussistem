<form action="{{ route('bus_rute.store') }}" method="POST">
    @csrf
    <div>
        <label for="nama_bus">Nama Bus</label>
        <select name="nama_bus" id="nama_bus" required>
            <option value="">Select Bus</option>
            @foreach($buses as $bus)
                <option value="{{ $bus->nama_bus }}">{{ $bus->nama_bus }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="tujuan">Tujuan</label>
        <select name="tujuan" id="tujuan" required>
            <option value="">Select Tujuan</option>
            @foreach($rutes as $rute)
                <option value="{{ $rute->tujuan }}">{{ $rute->tujuan }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Create</button>
</form>

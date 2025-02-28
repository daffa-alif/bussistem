public function update(Request $request, $id)
{
    $request->validate([
        'bus_id' => 'required|exists:buses,id',
        'rute_id' => 'required|exists:rute,id_rute',
    ]);

    $busRute = BusRute::findOrFail($id);
    $busRute->update($request->all());
    return redirect()->route('bus_rute.index')->with('success', 'Bus Rute updated successfully!');
}

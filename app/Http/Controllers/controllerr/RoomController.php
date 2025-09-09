<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Room berhasil ditambahkan.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Hapus gambar lama jika ada
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        } else {
            // Pertahankan gambar lama jika tidak ada gambar baru
            $validated['image'] = $room->image;
        }

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Room berhasil diupdate.');
    }

    public function destroy(Room $room)
    {
        // Hapus gambar dari storage jika ada
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room berhasil dihapus.');
    }
}
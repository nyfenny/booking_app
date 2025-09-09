<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            // Admin lihat semua booking
            $bookings = Booking::with('room', 'user')->get();
        } else {
            // User hanya lihat booking miliknya sendiri
            $bookings = Booking::with('room')
                ->where('user_id', auth()->id())
                ->get();
        }
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = \App\Models\Room::all();   // ambil semua room
        return view('bookings.create', compact('rooms'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'nomor_hp' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Booking::create([
            'nama_pemesan'    => $request->nama_pemesan,
            'nomor_hp'        => $request->nomor_hp,
            'room_id'         => $request->room_id,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'user_id'         => auth()->id(),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil disimpan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $users = \App\Models\User::all();
        $rooms = \App\Models\Room::all();
        return view('bookings.edit', compact('booking', 'users', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
        'nama_pemesan' => 'required',
        'nomor_hp' => 'required',
        'room_id' => 'required|exists:rooms,id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus!');
    }
}

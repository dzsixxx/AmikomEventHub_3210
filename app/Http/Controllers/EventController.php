<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Menampilkan halaman detail event (Public)
     */
    public function show($id)
    {
        // Mencari event berdasarkan ID beserta data kategorinya.
        $event = Event::with('category')->findOrFail($id);
        
        // Mengirimkan variabel $event ke file event-detail.blade.php
        return view('event-detail', compact('event'));
    }

    /**
     * Menampilkan halaman checkout (sementara)
     */
    public function checkout(Request $request, $id = null)
    {
        return view('checkout');
    }

    /**
     * Menampilkan halaman tiket (sementara)
     */
    public function ticket()
    {
        return view('ticket');
    }
}
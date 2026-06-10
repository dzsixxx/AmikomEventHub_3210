<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class EventController extends Controller
{
    /**
     * Menampilkan halaman detail event menggunakan Route Model Binding (Modul 9.4.6)
     */
    public function show(Event $event)
    {
        // Mengambil daftar kategori untuk keperluan menu
        $categories = Category::all();
        
        // Mengirimkan variabel $event ke file event-detail.blade.php
        return view('event-detail', compact('event', 'categories'));
    }

    /**
     * Menampilkan halaman checkout
     */
    public function checkout(Request $request, $id = null)
    {
        return view('checkout');
    }

    /**
     * Menampilkan halaman tiket
     */
    public function ticket()
    {
        return view('ticket');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category; // Tambahkan baris ini untuk memanggil model Category
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event (Read)
     */
    public function index()
    {
        // Mengambil data event beserta relasi kategori, diurutkan dari yang terbaru, dibatasi 10 per halaman
        $events = Event::with('category')->latest()->paginate(10);
        
        return view('admin.events.index', compact('events'));
    }

    /**
     * Menampilkan form tambah event baru (Create)
     */
    public function create()
    {
        // Ambil semua data kategori untuk ditampilkan di dropdown (select)
        $categories = Category::all();
        
        return view('admin.events.create', compact('categories'));
    }

    /**
     * Menyimpan data event baru ke database (Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi data request dari pengguna
        $data = $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        // 2. Menyimpan data yang telah divalidasi ke dalam tabel
        Event::create($data);

        // 3. Mengembalikan pengguna ke halaman index dengan pesan sukses
        return redirect()->route('admin.events.index')
            ->with('success', 'Data Event berhasil ditambahkan.');
    }

    /**
     * Menghapus data event (Delete) - Tahap 3
     */
    public function destroy(Event $event)
    {
        $event->delete();
        
        return redirect()->route('admin.events.index')
            ->with('success', 'Data event berhasil dihapus secara permanen.');
    }

    /**
     * Menampilkan form edit event (Edit) - Tahap 4
     */
    public function edit(Event $event)
    {
        // Ambil semua kategori untuk dropdown
        $categories = Category::all();
        
        // Passing data event yang akan diedit dan data kategori ke view
        return view('admin.events.edit', compact('event', 'categories'));
    }

    /**
     * Menyimpan perubahan data event (Update) - Tahap 4
     */
    public function update(Request $request, Event $event)
    {
        // Validasi data sama seperti saat store
        $data = $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        // Update data event
        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Rincian data event berhasil diperbarui.');
    }
}
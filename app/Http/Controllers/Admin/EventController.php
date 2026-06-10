<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib ditambahkan untuk fitur hapus file

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi ketat (Mencegah input harga/stok minus dan membatasi ukuran gambar)
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0', // Tidak boleh minus
            'stock' => 'required|numeric|min:1', // Minimal 1
            'poster' => 'nullable|image|max:2048' // Validasi file gambar maks 2MB
        ]);

        // Proses Upload File Poster
        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Data Event berhasil ditambahkan beserta posternya.');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:1',
            'poster' => 'nullable|image|max:2048'
        ]);

        // Proses Update dan Hapus File Lama
        if ($request->hasFile('poster')) {
            // Hapus gambar lama dari folder storage jika ada (dan bukan link URL http)
            if ($event->poster_path && !filter_var($event->poster_path, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($event->poster_path)) {
                Storage::disk('public')->delete($event->poster_path);
            }
            // Simpan gambar baru
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'Rincian data event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        // Menghapus file gambar fisik sebelum menghapus data di database
        if ($event->poster_path && !filter_var($event->poster_path, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($event->poster_path)) {
            Storage::disk('public')->delete($event->poster_path);
        }
        
        $event->delete();
        return redirect()->route('admin.events.index')
            ->with('success', 'Data event dan posternya berhasil dihapus secara permanen.');
    }
}
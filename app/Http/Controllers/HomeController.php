<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category; // Wajib import model Category

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua kategori untuk ditampilkan di Tab Filter
        $categories = Category::all();

        // 2. Query dasar: Ambil event beserta relasi kategorinya,
        // yang tanggalnya hari ini atau ke depan, urutkan dari yang terdekat
        $query = Event::with('category')
            ->where('date', '>=', now())
            ->orderBy('date', 'asc');

        // 3. Filter query jika URL memiliki parameter pencarian spesifik (?category=...)
        if ($request->has('category') && $request->category != '') {
            // Saring berdasarkan relasi tabel rujukan melalui properti slug kategori.
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 4. Eksekusi query dan kirim data hasilnya ke template Blade
        $events = $query->get();

        return view('welcome', compact('events', 'categories'));
    }
}
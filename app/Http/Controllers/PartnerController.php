<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        // JAWABAN SOAL 3: Logika Fitur Pencarian (Search Basic)
        $query = Partner::query();

        // Jika admin mengetik sesuatu di kotak pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Ambil data (hasil filter pencarian ATAU semua data jika tidak ada pencarian)
        $partners = $query->latest()->get();
        
        // PERUBAHAN: Menyesuaikan dengan letak dan nama file partner.blade.php Anda
        return view('admin.partners', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo_url' => 'required|url',
        ]);

        Partner::create($request->all());

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan!');
    }

    // Fungsi Baru untuk Update (Edit)
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required',
            'logo_url' => 'required|url',
        ]);

        $partner->update($request->all());

        return redirect()->route('admin.partners.index')->with('success', 'Data partner berhasil diperbarui!');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil dihapus!');
    }
}
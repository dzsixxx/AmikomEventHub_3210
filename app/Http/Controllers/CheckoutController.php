<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // 1. Menampilkan halaman form checkout
    public function create(Event $event)
    {
        return view('checkout.create', compact('event'));
    }

    // 2. Memproses data dari form dan menyimpannya ke database
    public function store(Request $request, Event $event)
    {
        // Validasi Input Kredensial Pelanggan
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // Cegah Check-out Jika Tiket Habis
        if ($event->stock <= 0) {
            return back()->with('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
        }

        // Generate Kode TRX (Unik dan Acak)
        $orderId = 'TRX-' . time() . '-' . strtoupper(Str::random(5));
        
        // Kalkulasi Total (Harga tiket asli + Biaya Layanan Rp 5000)
        $totalPrice = $event->price + 5000; 

        // Merekam Transaksi ke Database
        Transaction::create([
            'event_id' => $event->id,
            'order_id' => $orderId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => 'Pending', // Status Awal sebelum dibayar
        ]);

        // Arahkan ke rute dummy halaman beranda (Akan diubah ke Midtrans di Modul 11)
        return redirect('/')->with('success', 'Pesanan berhasil dibuat! Silakan tunggu instruksi pembayaran selanjutnya.');
    }
}
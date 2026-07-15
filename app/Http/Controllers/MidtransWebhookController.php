<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Exception;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderId) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        // Mencari ID transaksi tersebut di database lokal kita
        $transaction = Transaction::with('event')->where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Cegah proses berulang jika status sudah lunas/sukses
        if ($transaction->status === 'Success' || $transaction->status === 'settlement') {
            return response()->json(['message' => 'Already processed']);
        }

        // Logika Penerjemahan Status Midtrans API
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $transaction->status = 'Challenge';
            } else if ($fraudStatus == 'accept') {
                $transaction->status = 'Success';
                $this->processSuccess($transaction); // Panggil fungsi potong stok & kirim email
            }
        } else if ($transactionStatus == 'settlement') {
            $transaction->status = 'Success';
            $this->processSuccess($transaction); // Panggil fungsi potong stok & kirim email
        } else if (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $transaction->status = 'Failed';
        } else if ($transactionStatus == 'pending') {
            $transaction->status = 'Pending';
        }

        $transaction->save();

        return response()->json(['message' => 'OK']);
    }

    /**
     * FUNGSI KHUSUS MODUL 13: Memotong Stok dan Mengirim Email Mailable
     */
    private function processSuccess(Transaction $transaction)
    {
        $event = $transaction->event;

        // Jika tiket masih ada dan terhubung dengan data event, kurangi jumlahnya sebanyak 1
        if ($event && $event->stock > 0) {
            $event->stock = $event->stock - 1;
            $event->save();

            // Mengirimkan email E-Ticket ke pelanggan
            try {
                \Illuminate\Support\Facades\Mail::to($transaction->customer_email)
                    ->send(new \App\Mail\EventTicketMail($transaction));
            } catch (Exception $e) {
                \Log::error('Gagal mengirim email E-Ticket: ' . $e->getMessage());
            }
        } else {
            \Log::warning('Stock habis setelah pembayaran berhasil (Perlu proses refund opsional). Order: ' . $transaction->order_id);
        }
    }
}
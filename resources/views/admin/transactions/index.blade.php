@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800">Laporan Transaksi</h1>
        <p class="text-slate-500 mt-2">Pantau arus kas dan penjualan tiket Anda.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-4">Order ID</th>
                        <th class="px-8 py-4">Detail Pembeli</th>
                        <th class="px-8 py-4">Event</th>
                        <th class="px-8 py-4">Tgl Transaksi</th>
                        <th class="px-8 py-4 text-center">Status</th>
                        <th class="px-8 py-4 text-right">Total Tagihan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-slate-50/50 transition {{ $trx->status == 'Pending' ? 'text-slate-500' : 'text-slate-800' }}">
                        <td class="px-8 py-6">
                            <span class="font-mono font-bold px-3 py-1.5 rounded-lg text-sm {{ $trx->status == 'Pending' ? 'bg-slate-100 text-slate-500' : 'bg-indigo-50 text-indigo-600' }}">
                                {{ $trx->order_id }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-bold text-slate-800 mb-1">{{ $trx->customer_name }}</p>
                            <p class="text-xs text-slate-500">{{ $trx->customer_email }}</p>
                            <p class="text-xs text-slate-500">{{ $trx->customer_phone }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-bold text-slate-700 line-clamp-2 max-w-[200px]">{{ $trx->event->title ?? '-' }}</p>
                        </td>
                        <td class="px-8 py-6 text-sm text-slate-500 font-medium">
                            {{ $trx->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($trx->status === 'Success' || $trx->status === 'settlement')
                                <span class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase tracking-wider">Success</span>
                            @elseif($trx->status === 'Pending' || $trx->status === 'pending')
                                <span class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-xs font-bold uppercase tracking-wider">Pending</span>
                            @else
                                <span class="px-3 py-1.5 bg-rose-100 text-rose-700 rounded-lg text-xs font-bold uppercase tracking-wider">{{ $trx->status }}</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right font-black text-lg {{ $trx->status == 'Pending' ? 'text-slate-400' : 'text-indigo-600' }}">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-16 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <p class="text-slate-500 font-medium">Belum ada transaksi pembelian tiket.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($transactions->hasPages())
        <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800">Dashboard Ringkasan</h1>
        <p class="text-slate-500 mt-2">Selamat datang kembali! Berikut ringkasan performa event Anda.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Card 1: Total Pendapatan -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3.895-3 2s1.343 2 3 2 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Total Pendapatan</p>
            <h3 class="text-2xl font-black text-slate-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>

        <!-- Card 2: Tiket Terjual -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
            </div>
            <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Tiket Lunas</p>
            <h3 class="text-2xl font-black text-slate-800">{{ number_format($ticketsSold, 0, ',', '.') }} Tiket</h3>
        </div>

        <!-- Card 3: Event Aktif -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Event Mendatang</p>
            <h3 class="text-2xl font-black text-slate-800">{{ $activeEvents }} Event</h3>
        </div>

        <!-- Card 4: Pesanan Pending -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition">
            <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Pesanan Tertunda</p>
            <h3 class="text-2xl font-black text-slate-800">{{ $pendingOrders }} Antrean</h3>
        </div>
    </div>

    <!-- Latest Sales Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-black text-xl text-slate-800">5 Transaksi Terakhir</h3>
            <a href="{{ route('admin.transactions.index') }}" class="text-indigo-600 font-bold hover:text-indigo-800 flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white text-slate-400 uppercase text-[10px] font-black tracking-widest border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-4 w-1/4">Tgl Transaksi</th>
                        <th class="px-8 py-4 w-1/4">Detail Pembeli</th>
                        <th class="px-8 py-4 w-1/4">Event</th>
                        <th class="px-8 py-4 w-[10%] text-center">Status</th>
                        <th class="px-8 py-4 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentTransactions as $trx)
                    <tr class="hover:bg-slate-50 transition {{ $trx->status == 'Pending' || $trx->status == 'pending' ? 'text-slate-500' : 'text-slate-800' }}">
                        <td class="px-8 py-6 text-sm">
                            <div class="font-medium mb-1">{{ $trx->created_at->format('d M Y - H:i') }}</div>
                            <span class="font-mono text-xs {{ $trx->status == 'Pending' || $trx->status == 'pending' ? 'text-slate-400' : 'text-indigo-600' }}">{{ $trx->order_id }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-bold tracking-wide text-sm truncate max-w-[150px] mb-1">{{ $trx->customer_name }}</p>
                            <p class="text-xs text-slate-400 truncate max-w-[150px]">{{ $trx->customer_email }}</p>
                        </td>
                        <td class="px-8 py-6 font-medium max-w-xs truncate">
                            {{ $trx->event->title ?? '-' }}
                        </td>
                        <td class="px-8 py-6 text-center whitespace-nowrap">
                            @if($trx->status === 'settlement' || $trx->status === 'Success' || $trx->status === 'success')
                                <span class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase tracking-wider">Success</span>
                            @elseif ($trx->status === 'pending' || $trx->status === 'Pending')
                                <span class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-xs font-bold uppercase tracking-wider">Pending</span>
                            @else
                                <span class="px-3 py-1.5 bg-rose-100 text-rose-700 rounded-lg text-xs font-bold uppercase tracking-wider">{{ $trx->status }}</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 font-black {{ $trx->status == 'Pending' || $trx->status == 'pending' ? 'text-slate-400' : 'text-indigo-600' }} whitespace-nowrap text-right text-lg">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center">
                            <p class="text-slate-500 font-medium">Belum ada transaksi sama sekali.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
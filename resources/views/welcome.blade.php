@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 space-y-8">
            <span
                class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1
                Event Platform</span>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
            </h1>
            <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
                Midtrans.
            </p>
            <div class="flex gap-4">
                <a href="#events"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                    Mulai Jelajah
                </a>
                <a href="#"
                    class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                    Cara Pesan
                </a>
            </div>
        </div>
        <div class="flex-1 relative">
            <div
                class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <img src="{{ asset('assets/concert.png') }}" alt="Concert"
                class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

            <div class="absolute -bottom-6 -left-6 bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-xl z-20 border border-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                        <p class="font-bold">Pembayaran Aman via Midtrans</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main id="explore" class="container mx-auto px-4 py-16">
        <div class="mb-10">
            <h2 class="text-2xl md:text-3xl font-extrabold mb-2 text-gray-900">Event Terdekat</h2>
            <p class="text-gray-500">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>

        <div class="flex flex-wrap gap-3 mb-12">
            <a href="{{ url('/#explore') }}" 
               class="px-5 py-2 rounded-lg text-sm font-semibold transition-all duration-200 
               {{ !request('category') ? 'bg-gray-800 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
               Semua Kategori
            </a>

            @foreach($categories as $cat)
            <a href="{{ url('/?category=' . $cat->slug . '#explore') }}" 
               class="px-5 py-2 rounded-lg text-sm font-semibold transition-all duration-200 
               {{ request('category') == $cat->slug ? 'bg-blue-100 text-blue-700 border border-blue-200 shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
               {{ $cat->name }}
            </a>
            @endforeach
        </div>

        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                    
                    <div class="h-40 bg-gray-100 flex items-center justify-center relative overflow-hidden">
                        <span class="absolute top-4 left-4 text-xs font-bold px-3 py-1 bg-white/90 backdrop-blur-sm text-gray-800 rounded-lg shadow-sm uppercase tracking-wide z-10">
                            {{ $event->category->name ?? 'Umum' }}
                        </span>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3 text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors" title="{{ $event->title }}">
                            {{ $event->title }}
                        </h3>
                        
                        <div class="space-y-2 mb-6 text-sm text-gray-500 font-medium">
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                            </p>
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $event->location ?? '-' }}
                            </p>
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-lg font-extrabold text-gray-900">
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('events.show', $event->id) }}" class="bg-gray-100 hover:bg-blue-600 hover:text-white text-gray-800 px-4 py-2 rounded-lg text-sm font-bold transition-colors duration-200">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-gray-50 rounded-2xl border border-gray-200 border-dashed max-w-3xl mx-auto">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Event Tidak Ditemukan</h3>
                <p class="text-gray-500 mb-6">Belum ada event yang tersedia untuk kategori ini.</p>
                <a href="{{ url('/') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition">Lihat Semua Event</a>
            </div>
        @endif
    </main>
@endsection
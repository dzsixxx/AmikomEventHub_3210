@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-10">
    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-3 text-gray-900">Jelajahi Event Mendatang</h1>
        <p class="text-gray-500">Temukan kegiatan edukatif, workshop, dan hiburan di sekitarmu.</p>
    </div>

    <!-- Tab Filter Kategori -->
    <div class="flex flex-wrap justify-center gap-3 mb-12">
        <!-- Tombol "Semua Kategori" -->
        <a href="{{ url('/') }}" 
           class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 
           {{ !request('category') ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
           Semua Kategori
        </a>

        <!-- Looping Kategori dari Database -->
        @foreach($categories as $cat)
        <a href="{{ url('/?category=' . $cat->slug) }}" 
           class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 
           {{ request('category') == $cat->slug ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
           {{ $cat->name }}
        </a>
        @endforeach
    </div>

    <!-- Grid Daftar Event -->
    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                
                <!-- Kategori Badge -->
                <div class="h-32 bg-gradient-to-r from-blue-50 to-indigo-50 flex items-center justify-center border-b border-gray-100">
                    <span class="text-xs font-bold px-3 py-1 bg-blue-600 text-white rounded-full uppercase tracking-wide">
                        {{ $event->category->name ?? 'Umum' }}
                    </span>
                </div>
                
                <!-- Detail Informasi Event -->
                <div class="p-5">
                    <h2 class="text-xl font-bold mb-3 text-gray-800 line-clamp-2" title="{{ $event->title }}">
                        {{ $event->title }}
                    </h2>
                    
                    <div class="space-y-2 mb-5 text-sm text-gray-500 font-medium">
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                        </p>
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $event->location ?? '-' }}
                        </p>
                    </div>
                    
                    <!-- Harga & Tombol -->
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                        <span class="text-lg font-extrabold text-blue-700">
                            Rp {{ number_format($event->price, 0, ',', '.') }}
                        </span>
                        <a href="{{ route('events.show', $event->id) }}" class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- State Jika Event Kosong -->
        <div class="text-center py-16 bg-white rounded-xl border border-gray-200 border-dashed max-w-2xl mx-auto">
            <p class="text-gray-500 text-lg mb-2">Ups, belum ada event yang tersedia untuk kategori ini.</p>
            <a href="{{ url('/') }}" class="text-blue-600 font-semibold hover:underline">Kembali ke semua event</a>
        </div>
    @endif
</main>
@endsection
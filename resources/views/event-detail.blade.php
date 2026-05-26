@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex flex-col lg:flex-row gap-10">
        
        <div class="w-full lg:w-1/3">
            <div class="sticky top-10">
                <img src="{{ $event->poster_path ?? asset('assets/concert.png') }}" alt="{{ $event->title }}" 
                     class="w-full rounded-3xl shadow-xl object-cover aspect-[3/4] border-4 border-white">
                
                <div class="mt-6 bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-black text-xl">
                        AH
                    </div>
                    <div>
                        <p class="font-bold text-slate-800">AmikomEventHub</p>
                        <p class="text-xs text-slate-500 font-semibold">Verified Organizer</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-2/3 flex flex-col">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full self-start mb-6 border border-indigo-100">
                {{ $event->category->name ?? 'Kategori Umum' }}
            </span>
            
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-8 leading-tight">
                {{ $event->title }}
            </h1>
            
            <div class="flex flex-wrap gap-6 mb-10 text-slate-600 font-medium">
                <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-xl border border-slate-100">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('l, d M Y - H:i') }} WIB</span>
                </div>
                <div class="flex items-center gap-3 bg-slate-50 px-4 py-3 rounded-xl border border-slate-100">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>{{ $event->location }}</span>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-slate-800 mb-4">Deskripsi Event</h2>
            <div class="text-slate-600 leading-relaxed space-y-4 mb-12 text-lg">
                <p>{{ $event->description }}</p>
            </div>
            
            <div class="bg-indigo-600 text-white p-8 rounded-3xl mt-auto shadow-2xl shadow-indigo-200">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <p class="text-indigo-200 font-bold uppercase tracking-wider text-sm mb-1">Harga Tiket</p>
                        <p class="text-4xl font-black">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('checkout', $event->id ?? 1) }}" 
                       class="w-full md:w-auto px-10 py-4 bg-white text-indigo-600 font-extrabold rounded-2xl hover:bg-slate-50 hover:scale-105 transition-all duration-300 text-center text-lg shadow-lg">
                        Pesan Sekarang
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection